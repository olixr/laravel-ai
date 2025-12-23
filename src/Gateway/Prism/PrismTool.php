<?php

namespace Laravel\Ai\Gateway\Prism;

use Illuminate\Support\Traits\Conditionable;
use Laravel\Ai\Data\ToolCall;
use Laravel\Ai\Data\ToolResult;
use Prism\Prism\Exceptions\PrismException;
use Prism\Prism\Tool;
use Prism\Prism\ValueObjects\ToolCall as PrismToolCall;
use Prism\Prism\ValueObjects\ToolResult as PrismToolResult;
use Throwable;
use TypeError;

class PrismTool extends Tool
{
    use Conditionable;

    /**
     * {@inheritdoc}
     */
    public function handle(...$args): string
    {
        try {
            $value = call_user_func($this->fn, $args);

            if (! is_string($value)) {
                throw PrismException::invalidReturnTypeInTool($this->name, new TypeError('Return value must be of type string'));
            }

            return $value;
        } catch (Throwable $e) {
            return $this->handleToolException($e, $args);
        }
    }

    /**
     * Convert a Prism tool call value object into a Laravel AI SDK tool call value object.
     */
    public static function toLaravelToolCall(PrismToolCall $toolCall): ToolCall
    {
        return new ToolCall(
            $toolCall->id,
            $toolCall->name,
            $toolCall->arguments()['schema_definition'] ?? [],
            $toolCall->resultId,
            $toolCall->reasoningId,
            $toolCall->reasoningSummary,
        );
    }

    /**
     * Convert a Prism tool result value object into a Laravel AI SDK tool result value object.
     */
    public static function toLaravelToolResult(PrismToolResult $toolResult): ToolResult
    {
        return new ToolResult(
            $toolResult->toolCallId,
            $toolResult->toolName,
            $toolResult->args['schema_definition'] ?? [],
            $toolResult->result,
            $toolResult->toolCallResultId,
        );
    }
}
