<?php

namespace Laravel\Ai\Files;

use Laravel\Ai\Files\Concerns\CanBeRetrievedOrDeletedFromProvider;

class ProviderDocument extends Document
{
    use CanBeRetrievedOrDeletedFromProvider;

    public function __construct(public string $id) {}
}
