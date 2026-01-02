<?php

namespace Laravel\Ai\Files;

class ProviderImage extends Image
{
    public function __construct(public string $id) {}
}
