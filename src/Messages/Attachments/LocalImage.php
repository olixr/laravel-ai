<?php

namespace Laravel\Ai\Messages\Attachments;

class LocalImage extends Image
{
    public function __construct(public string $path, public ?string $mime = null) {}

    /**
     * Set the image's MIME type.
     *
     * @return $this
     */
    public function withMime(string $mime): static
    {
        $this->mime = $mime;

        return $this;
    }
}
