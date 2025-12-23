<?php

namespace Laravel\Ai\Data;

class ToolResult
{
    public function __construct(
        public string $id,
        public string $name,
        public array $arguments,
        public $result,
        public ?string $resultId = null,
    ) {}
}
