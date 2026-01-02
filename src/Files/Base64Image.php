<?php

namespace Laravel\Ai\Files;

class Base64Image extends Image
{
    public function __construct(public string $base64, public ?string $mime = null) {}

    /**
     * Set the image's MIME type.
     */
    public function withMime(string $mime): static
    {
        $this->mime = $mime;

        return $this;
    }
}
