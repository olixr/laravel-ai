<?php

namespace Laravel\Ai\Messages\Attachments;

class StoredImage extends Image
{
    public function __construct(public string $path, public ?string $disk = null) {}
}
