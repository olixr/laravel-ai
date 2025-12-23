<?php

namespace Laravel\Ai\Data;

class ToolCall
{
    public function __construct(
        public string $id,
        public string $name,
        public array $arguments,
        public ?string $resultId = null,
        public ?string $reasoningId = null,
        public ?array $reasoningSummary = null,
    ) {}
}
