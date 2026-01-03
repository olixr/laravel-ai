<?php

namespace Laravel\Ai\Contracts\Files;

use Stringable;

interface StorableFile extends Stringable
{
    /**
     * Get the file's raw storable content.
     */
    public function storableContent(): string;

    /**
     * Get the displayable name of the file.
     */
    public function storableName(): ?string;

    /**
     * Get the file's MIME type.
     */
    public function storableMimeType(): ?string;
}
