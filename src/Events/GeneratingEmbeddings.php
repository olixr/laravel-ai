<?php

namespace Laravel\Ai\Events;

use Laravel\Ai\Providers\Provider;

class GeneratingEmbeddings
{
    public function __construct(
        public string $invocationId,
        public Provider $provider,
        public string $model,
        public array $inputs,
        public int $dimensions
    ) {}
}
