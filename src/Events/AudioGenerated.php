<?php

namespace Laravel\Ai\Events;

use Laravel\Ai\Providers\Provider;
use Laravel\Ai\Responses\AudioResponse;

class AudioGenerated
{
    public function __construct(
        public string $invocationId,
        public Provider $provider,
        public string $model,
        public string $text,
        public string $voice,
        public ?string $instructions,
        public AudioResponse $response
    ) {}
}
