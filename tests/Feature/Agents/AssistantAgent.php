<?php

namespace Tests\Feature\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;

class AssistantAgent implements Agent
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): string
    {
        return 'You are a helpful assistant that responds extremely concisely to all queries.';
    }
}
