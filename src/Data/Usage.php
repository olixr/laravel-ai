<?php

namespace Laravel\Ai\Data;

class Usage
{
    public function __construct(
        public int $promptTokens = 0,
        public int $completionTokens = 0,
        public int $cacheWriteInputTokens = 0,
        public int $cacheReadInputTokens = 0,
        public int $reasoningTokens = 0,
    ) {}

    /**
     * Convert the usage to its array representation.
     */
    public function toArray(): array
    {
        return [
            'prompt_tokens' => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
            'cache_write_input_tokens' => $this->cacheWriteInputTokens,
            'cache_read_input_tokens' => $this->cacheReadInputTokens,
            'reasoning_tokens' => $this->reasoningTokens,
        ];
    }

    /**
     * Add the given usage to the current usage and return a new usage instance.
     */
    public function add(Usage $usage): Usage
    {
        return new Usage(
            $this->promptTokens + $usage->promptTokens,
            $this->completionTokens + $usage->completionTokens,
            $this->cacheWriteInputTokens + $usage->cacheWriteInputTokens,
            $this->cacheReadInputTokens + $usage->cacheReadInputTokens,
            $this->reasoningTokens + $usage->reasoningTokens,
        );
    }
}
