<?php

namespace Laravel\Ai\Contracts\Files;

interface TranscribableAudio
{
    public function transcribableContent(): string;

    public function transcribableMimeType(): ?string;
}
