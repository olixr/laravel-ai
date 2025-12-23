<?php

namespace Laravel\Ai\Contracts;

use Illuminate\Broadcasting\Channel;
use Laravel\Ai\Responses\AgentResponse;
use Laravel\Ai\Responses\StreamableAgentResponse;

interface Agent
{
    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): string;

    /**
     * Invoke the agent with a given prompt.
     */
    public function prompt(
        string $prompt,
        array $attachments = [],
        ?string $provider = null,
        ?string $model = null
    ): AgentResponse;

    /**
     * Invoke the agent with a given prompt and return a streamable response.
     */
    public function stream(
        string $prompt,
        ?string $provider = null,
        ?string $model = null
    ): StreamableAgentResponse;

    /**
     * Invoke the agent with a given prompt and broadcast the streamed events.
     */
    public function broadcast(
        string $prompt,
        Channel|array $channels,
        bool $now = false,
        ?string $provider = null,
        ?string $model = null
    ): StreamableAgentResponse;

    /**
     * Invoke the agent with a given prompt and broadcast the streamed events immediately.
     */
    public function broadcastNow(
        string $prompt,
        Channel|array $channels,
        ?string $provider = null,
        ?string $model = null
    ): StreamableAgentResponse;
}
