<?php

namespace Laravel\Ai;

use Laravel\Ai\PendingResponses\PendingEmbeddingsGeneration;

class Embeddings
{
    /**
     * Get embedding vectors representing the given inputs.
     *
     * @param  string[]  $inputs
     */
    public static function for(array $inputs): PendingEmbeddingsGeneration
    {
        return new PendingEmbeddingsGeneration($inputs);
    }
}
