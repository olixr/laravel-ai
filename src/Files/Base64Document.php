<?php

namespace Laravel\Ai\Files;

class Base64Document extends Document
{
    public function __construct(public string $base64, public ?string $mime = null) {}

    /**
     * Set the document's MIME type.
     */
    public function withMime(string $mime): static
    {
        $this->mime = $mime;

        return $this;
    }
}
