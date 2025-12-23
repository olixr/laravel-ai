<?php

namespace Laravel\Ai;

use Laravel\Ai\PendingResponses\PendingImageGeneration;

class Image
{
    /**
     * Generate an image.
     */
    public static function of(string $prompt): PendingImageGeneration
    {
        return new PendingImageGeneration($prompt);
    }
}
