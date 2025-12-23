<?php

namespace Laravel\Ai\Gateway\Prism;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Laravel\Ai\Messages\AssistantMessage;
use Laravel\Ai\Messages\Attachments\Attachment;
use Laravel\Ai\Messages\Attachments\LocalDocument;
use Laravel\Ai\Messages\Attachments\LocalImage;
use Laravel\Ai\Messages\Attachments\ProviderDocument;
use Laravel\Ai\Messages\Attachments\ProviderImage;
use Laravel\Ai\Messages\Attachments\RemoteDocument;
use Laravel\Ai\Messages\Attachments\RemoteImage;
use Laravel\Ai\Messages\Attachments\StoredDocument;
use Laravel\Ai\Messages\Attachments\StoredImage;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Messages\MessageRole;
use Laravel\Ai\Messages\ToolResultMessage;
use Laravel\Ai\Messages\UserMessage;
use Prism\Prism\ValueObjects\Media\Audio as PrismAudio;
use Prism\Prism\ValueObjects\Media\Document as PrismDocument;
use Prism\Prism\ValueObjects\Media\Image as PrismImage;
use Prism\Prism\ValueObjects\Messages\AssistantMessage as PrismAssistantMessage;
use Prism\Prism\ValueObjects\Messages\ToolResultMessage as PrismToolResultMessage;
use Prism\Prism\ValueObjects\Messages\UserMessage as PrismUserMessage;

class PrismMessages
{
    /**
     * Marshal the given Laravel AI SDK messages into Prism messages.
     */
    public static function fromLaravelMessages(Collection $messages): Collection
    {
        return $messages
            ->map(function ($message) {
                $message = Message::tryFrom($message);

                if ($message->role === MessageRole::User) {
                    return new PrismUserMessage(
                        $message->content,
                        additionalContent: static::fromLaravelAttachments($message->attachments ?? new Collection)->all(),
                    );
                }

                if ($message->role === MessageRole::Assistant) {
                    return new PrismAssistantMessage($message->content);
                }
            })->filter()->values();
    }

    /**
     * Marshal the given Laravel message attachments to Prism message attachments.
     */
    protected static function fromLaravelAttachments(Collection $attachments): Collection
    {
        return $attachments->map(function ($attachment) {
            if (! $attachment instanceof Attachment && ! $attachment instanceof UploadedFile) {
                throw new InvalidArgumentException(
                    'Unsupported attachment type ['.get_class($attachment).']'
                );
            }

            $prismAttachment = match (true) {
                $attachment instanceof ProviderImage => PrismImage::fromFileId($attachment->id),
                $attachment instanceof LocalImage => PrismImage::fromLocalPath($attachment->path, $attachment->mime),
                $attachment instanceof RemoteImage => PrismImage::fromUrl($attachment->url),
                $attachment instanceof StoredImage => PrismImage::fromStoragePath($attachment->path, $attachment->disk),
                $attachment instanceof ProviderDocument => PrismDocument::fromFileId($attachment->id),
                $attachment instanceof LocalDocument => PrismDocument::fromPath($attachment->path),
                $attachment instanceof RemoteDocument => PrismDocument::fromUrl($attachment->url),
                $attachment instanceof StoredDocument => PrismDocument::fromStoragePath($attachment->path, $attachment->disk),
                $attachment instanceof UploadedFile && static::isImage($attachment) => PrismImage::fromBase64(base64_encode($attachment->get()), $attachment->getClientMimeType()),
                $attachment instanceof UploadedFile && static::isAudio($attachment) => PrismAudio::fromBase64(base64_encode($attachment->get()), $attachment->getClientMimeType()),
                $attachment instanceof UploadedFile => PrismDocument::fromBase64(base64_encode($attachment->get()), $attachment->getClientMimeType()),
            };

            if ($attachment instanceof Attachment && $attachment->name) {
                $prismAttachment->as($attachment->name);
            }

            return $prismAttachment;
        });
    }

    /**
     * Determine if the given uploaded file attachment is an image.
     */
    protected static function isAudio(UploadedFile $attachment): bool
    {
        return in_array($attachment->getClientMimeType(), [
            'audio/mpeg',
            'audio/wav',
            'audio/x-wav',
            'audio/aac',
            'audio/opus',
        ]);
    }

    /**
     * Determine if the given uploaded file attachment is an image.
     */
    protected static function isImage(UploadedFile $attachment): bool
    {
        return in_array($attachment->getClientMimeType(), [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
        ]);
    }

    /**
     * Marshal the given Prism messages to Laravel AI SDK messages.
     */
    public static function toLaravelMessages(Collection $messages): Collection
    {
        return $messages->map(function ($message) {
            if ($message instanceof PrismUserMessage) {
                return new UserMessage($message->content);
            }

            if ($message instanceof PrismAssistantMessage) {
                return new AssistantMessage(
                    $message->content ?? '',
                    toolCalls: collect($message->toolCalls ?? [])
                        ->map(PrismTool::toLaravelToolCall(...))
                );
            }

            if ($message instanceof PrismToolResultMessage) {
                return new ToolResultMessage(
                    collect($message->toolResults)
                        ->map(PrismTool::toLaravelToolResult(...))
                );
            }

            return $message;
        })->values();
    }
}
