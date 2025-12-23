<?php

namespace Laravel\Ai;

use Closure;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;

/**
 * Get an ad-hoc agent instance.
 */
function agent(
    string $instructions = '',
    iterable $messages = [],
    iterable $tools = [],
    ?Closure $schema = null,
): Agent {
    if ($schema) {
        return new class($instructions, $messages, $tools, $schema) extends AnonymousAgent implements HasStructuredOutput
        {
            public function __construct(
                public string $instructions,
                public iterable $messages,
                public iterable $tools,
                public ?Closure $schema = null) {}

            public function schema(JsonSchema $schema): array
            {
                return call_user_func($this->schema, $schema);
            }
        };
    } else {
        return new class($instructions, $messages, $tools) extends AnonymousAgent {};
    }
}
