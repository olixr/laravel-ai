<?php

namespace Laravel\Ai\Providers\Concerns;

use Illuminate\Support\Str;
use Laravel\Ai\Events\AudioGenerated;
use Laravel\Ai\Events\GeneratingAudio;
use Laravel\Ai\Responses\AudioResponse;

trait GeneratesAudio
{
    /**
     * Generate audio from the given text.
     */
    public function audio(
        string $text,
        string $voice = 'default-female',
        ?string $instructions = null,
        ?string $model = null,
    ): AudioResponse {
        $invocationId = (string) Str::uuid7();

        $model ??= $this->defaultAudioModel();

        $this->events->dispatch(new GeneratingAudio(
            $invocationId, $this, $model, $text, $voice, $instructions
        ));

        return tap($this->audioGateway()->generateAudio(
            $this, $model, $text, $voice, $instructions,
        ), function (AudioResponse $response) use ($invocationId, $model, $text, $voice, $instructions) {
            $this->events->dispatch(new AudioGenerated(
                $invocationId, $this, $model, $text, $voice, $instructions, $response
            ));
        });
    }
}
