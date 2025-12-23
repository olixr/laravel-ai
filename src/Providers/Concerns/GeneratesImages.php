<?php

namespace Laravel\Ai\Providers\Concerns;

use Illuminate\Support\Str;
use Laravel\Ai\Events\GeneratingImage;
use Laravel\Ai\Events\ImageGenerated;
use Laravel\Ai\Responses\ImageResponse;

trait GeneratesImages
{
    /**
     * Generate an image.
     *
     * @param  array<ImageAttachment>  $attachments
     * @param  '3:2'|'2:3'|'1:1'  $size
     * @param  'low'|'medium'|'high'  $quality
     */
    public function image(
        string $prompt,
        array $attachments = [],
        ?string $size = null,
        ?string $quality = null,
        ?string $model = null,
    ): ImageResponse {
        $invocationId = (string) Str::uuid7();

        $model ??= $this->defaultImageModel();

        $this->events->dispatch(new GeneratingImage(
            $invocationId, $this, $model, $prompt, $attachments,
        ));

        return tap($this->imageGateway()->generateImage(
            $this, $model, $prompt, $attachments, $size, $quality,
        ), function (ImageResponse $response) use ($invocationId, $prompt, $attachments, $model) {
            $this->events->dispatch(new ImageGenerated(
                $invocationId, $this, $model, $prompt, $attachments, $response
            ));
        });
    }
}
