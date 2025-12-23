<?php

namespace Laravel\Ai\Messages\Attachments;

class LocalAudio extends Audio implements TranscribableAudio
{
    public function __construct(public string $path, public ?string $mime = null) {}

    /**
     * Get the Base64 representation of the audio for transcription.
     */
    public function toBase64ForTranscription(): string
    {
        return base64_encode(file_get_contents($path));
    }

    /**
     * Get the MIME type for transcription.
     */
    public function mimeTypeForTranscription(): ?string
    {
        return $this->mime;
    }

    /**
     * Set the audio's MIME type.
     */
    public function withMime(string $mime): static
    {
        $this->mime = $mime;

        return $this;
    }
}
