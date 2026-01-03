<?php

namespace Laravel\Ai\Files;

use Laravel\Ai\Contracts\Files\StorableFile;
use Laravel\Ai\Files\Concerns\CanBeUploadedToProvider;

class Base64Document extends Document implements StorableFile
{
    use CanBeUploadedToProvider;

    public function __construct(public string $base64, public ?string $mime = null) {}

    /**
     * Get the raw representation of the file.
     */
    public function content(): string
    {
        return base64_decode($this->base64);
    }

    /**
     * Get the file's MIME type.
     */
    public function mimeType(): ?string
    {
        return $this->mime;
    }

    /**
     * Set the document's MIME type.
     */
    public function withMimeType(string $mime): static
    {
        $this->mime = $mime;

        return $this;
    }

    public function __toString(): string
    {
        return $this->content();
    }
}
