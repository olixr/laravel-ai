<?php

namespace Laravel\Ai;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;
use Laravel\Ai\Contracts\Agent;

/**
 * Get an ad-hoc agent instance.
 */
function agent(
    string $instructions = '',
    iterable $messages = [],
    iterable $tools = [],
    ?Closure $schema = null,
): Agent {
    return $schema
        ? new StructuredAnonymousAgent($instructions, $messages, $tools, $schema)
        : new AnonymousAgent($instructions, $messages, $tools);
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
