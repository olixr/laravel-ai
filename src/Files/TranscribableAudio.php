<?php

namespace Laravel\Ai\Files;

interface TranscribableAudio
{
    public function toBase64ForTranscription(): string;

    public function mimeTypeForTranscription(): ?string;
}
