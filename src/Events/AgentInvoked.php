<?php

namespace Laravel\Ai\Events;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Providers\Provider;
use Laravel\Ai\Responses\AgentResponse;
use Laravel\Ai\Responses\StreamedAgentResponse;

class AgentInvoked
{
    public function __construct(
        public string $invocationId,
        public Provider $provider,
        public string $model,
        public Agent $agent,
        public string $prompt,
        public StreamedAgentResponse|AgentResponse $response
    ) {}
}
