<?php

namespace Laravel\Ai\Files;

use Laravel\Ai\Files\Concerns\CanBeRetrievedOrDeletedFromProvider;

class ProviderImage extends Image
{
    use CanBeRetrievedOrDeletedFromProvider;

    public function __construct(public string $id) {}
}
