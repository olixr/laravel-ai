<?php

namespace Laravel\Ai\Messages\Attachments;

interface TranscribableAudio
{
    public function toBase64ForTranscription(): string;

    public function mimeTypeForTranscription(): ?string;
}
