<?php

namespace Laravel\Ai\Contracts\Gateway;

use Illuminate\Http\UploadedFile;
use Laravel\Ai\Messages\Attachments\TranscribableAudio;
use Laravel\Ai\Providers\Provider;
use Laravel\Ai\Responses\TranscriptionResponse;

interface TranscriptionGateway
{
    /**
     * Generate text from the given audio.
     */
    public function generateTranscription(
        Provider $provider,
        string $model,
        TranscribableAudio|UploadedFile $audio,
        ?string $language = null,
        bool $diarize = false,
    ): TranscriptionResponse;
}
