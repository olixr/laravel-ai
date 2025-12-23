<?php

namespace Laravel\Ai\Responses;

use ArrayAccess;
use Illuminate\Support\Collection;
use Laravel\Ai\Data\Meta;
use Laravel\Ai\Data\Usage;

class StructuredAgentResponse extends AgentResponse implements ArrayAccess
{
    use ProvidesStructuredResponse;

    public function __construct(string $invocationId, array $structured, string $text, Usage $usage, Meta $meta)
    {
        parent::__construct($invocationId, $text, $usage, $meta);

        $this->structured = $structured;
        $this->toolCalls = new Collection;
        $this->toolResults = new Collection;
    }

    /**
     * Get the string representation of the object.
     */
    public function __toString(): string
    {
        return json_encode($this->structured);
    }
}
