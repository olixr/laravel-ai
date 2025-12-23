<?php

namespace Laravel\Ai\Events;

use Laravel\Ai\Providers\Provider;

class GeneratingImage
{
    public function __construct(
        public string $invocationId,
        public Provider $provider,
        public string $model,
        public string $prompt,
        public array $attachments,
    ) {}
}
