<?php

namespace Laravel\Ai\Files;

use Illuminate\Filesystem\Filesystem;
use Laravel\Ai\Contracts\Files\StorableFile;
use Laravel\Ai\Files\Concerns\CanBeUploadedToProvider;

class LocalImage extends Image implements StorableFile
{
    use CanBeUploadedToProvider;

    public function __construct(public string $path, public ?string $mime = null) {}

    /**
     * Get the raw representation of the file.
     */
    public function content(): string
    {
        return file_get_contents($this->path);
    }

    /**
     * Get the displayable name of the file.
     */
    public function name(): ?string
    {
        return $this->name ?? basename($this->path);
    }

    /**
     * Get the file's MIME type.
     */
    public function mimeType(): ?string
    {
        return $this->mime ?? (new Filesystem)->mimeType($this->path);
    }

    /**
     * Set the image's MIME type.
     *
     * @return $this
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
