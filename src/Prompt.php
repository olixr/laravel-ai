<?php

namespace Laravel\Ai;

abstract class Prompt
{
    public function __construct(
        public string $prompt,
        public readonly string $provider,
        public readonly string $model
    ) {}
}
