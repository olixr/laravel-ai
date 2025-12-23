<?php

namespace Laravel\Ai\Contracts\Gateway;

use Laravel\Ai\Providers\Provider;
use Laravel\Ai\Responses\AudioResponse;

interface AudioGateway
{
    /**
     * Generate audio from the given text.
     */
    public function generateAudio(
        Provider $provider,
        string $model,
        string $text,
        string $voice,
        ?string $instructions = null,
    ): AudioResponse;
}
