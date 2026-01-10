<?php

namespace Laravel\Ai\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;

class SimilaritySearch implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): string
    {
        //
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): string
    {
        //
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        //
    }
}
