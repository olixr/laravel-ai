<?php

namespace Laravel\Ai\Responses;

use Laravel\Ai\Data\Meta;
use Laravel\Ai\Data\Usage;

class AgentResponse extends TextResponse
{
    public string $invocationId;

    public function __construct(string $invocationId, string $text, Usage $usage, Meta $meta)
    {
        $this->invocationId = $invocationId;

        parent::__construct($text, $usage, $meta);
    }
}
