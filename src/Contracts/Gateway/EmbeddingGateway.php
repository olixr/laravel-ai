<?php

namespace Laravel\Ai\Contracts\Gateway;

use Laravel\Ai\Providers\Provider;
use Laravel\Ai\Responses\EmbeddingsResponse;

interface EmbeddingGateway
{
    /**
     * Generate embedding vectors representing the given inputs.
     *
     * @param  string[]  $inputs
     */
    public function generateEmbeddings(Provider $provider, string $model, array $inputs, int $dimensions): EmbeddingsResponse;
}
