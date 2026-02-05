<?php

namespace Laravel\Ai\Prompts;

use Countable;
use Illuminate\Support\Str;
use Laravel\Ai\Enums\AiProvider;

class QueuedEmbeddingsPrompt implements Countable
{
    public function __construct(
        public readonly array $inputs,
        public readonly ?int $dimensions,
        public readonly AiProvider|array|string|null $provider,
        public readonly ?string $model,
    ) {}

    /**
     * Determine if any of the inputs contain the given string.
     */
    public function contains(string $string): bool
    {
        foreach ($this->inputs as $input) {
            if (Str::contains($input, $string)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the number of inputs in the prompt.
     */
    public function count(): int
    {
        return count($this->inputs);
    }
}
