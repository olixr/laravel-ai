<?php

namespace Laravel\Ai\Files;

class StoredImage extends Image
{
    public function __construct(public string $path, public ?string $disk = null) {}
}
