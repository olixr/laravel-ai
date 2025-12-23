<?php

namespace Laravel\Ai\Data;

class Meta
{
    public function __construct(
        public ?string $provider = null,
        public ?string $model = null,
    ) {}
}
