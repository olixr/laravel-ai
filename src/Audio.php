<?php

namespace Laravel\Ai;

use Laravel\Ai\PendingResponses\PendingAudioGeneration;

class Audio
{
    /**
     * Generate audio from the given text.
     */
    public static function of(string $text): PendingAudioGeneration
    {
        return new PendingAudioGeneration($text);
    }
}
