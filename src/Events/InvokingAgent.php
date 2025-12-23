<?php

namespace Laravel\Ai\Events;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Providers\Provider;

class InvokingAgent
{
    public function __construct(
        public string $invocationId,
        public Provider $provider,
        public string $model,
        public Agent $agent,
        public string $prompt,
    ) {}
}
