<?php

namespace Laravel\Ai\Providers\Concerns;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Laravel\Ai\Events\EmbeddingsGenerated;
use Laravel\Ai\Events\GeneratingEmbeddings;
use Laravel\Ai\Responses\EmbeddingsResponse;

trait GeneratesEmbeddings
{
    /**
     * Get embedding vectors representing the given inputs.
     *
     * @param  string[]  $input
     */
    public function embeddings(array $inputs, ?int $dimensions = null, ?string $model = null): EmbeddingsResponse
    {
        if (! is_null($model) && is_null($dimensions)) {
            throw new InvalidArgumentException('Dimensions must be provided when model is specified.');
        }

        $invocationId = (string) Str::uuid7();

        $model ??= $this->defaultEmbeddingsModel();
        $dimensions ??= $this->defaultEmbeddingsDimensions();

        $this->events->dispatch(new GeneratingEmbeddings(
            $invocationId, $this, $model, $inputs, $dimensions
        ));

        return tap($this->gateway->generateEmbeddings(
            $this,
            $model,
            $inputs,
            $dimensions
        ), fn (EmbeddingsResponse $response) => $this->events->dispatch(new EmbeddingsGenerated(
            $invocationId, $this, $model, $inputs, $dimensions, $response
        )));
    }
}
