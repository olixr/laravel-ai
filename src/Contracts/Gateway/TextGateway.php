<?php

namespace Laravel\Ai\Contracts\Gateway;

use Closure;
use Generator;
use Laravel\Ai\Providers\Provider;
use Laravel\Ai\Responses\TextResponse;

interface TextGateway
{
    /**
     * Generate text representing the next message in a conversation.
     *
     * @param  array<string, \Illuminate\JsonSchema\Types\Type>|null  $schema
     */
    public function generateText(
        Provider $provider,
        string $model,
        ?string $instructions,
        array $messages = [],
        array $tools = [],
        ?array $schema = null
    ): TextResponse;

    /**
     * Stream text representing the next message in a conversation.
     *
     * @param  array<string, \Illuminate\JsonSchema\Types\Type>|null  $schema
     */
    public function streamText(
        string $invocationId,
        Provider $provider,
        string $model,
        ?string $instructions,
        array $messages = [],
        array $tools = [],
        ?array $schema = null
    ): Generator;

    /**
     * Specify callbacks that should be invoked when tools are invoking / invoked.
     */
    public function onToolInvocation(Closure $invoking, Closure $invoked): self;
}
