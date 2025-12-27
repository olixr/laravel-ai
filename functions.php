<?php

namespace Laravel\Ai;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;
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

/**
 * Get a new pipeline instance.
 */
function pipeline(): Pipeline
{
    return new Pipeline(Container::getInstance());
}

/**
 * Generate a new ULID.
 */
function ulid(): string
{
    return strtolower((string) Str::ulid());
}
