<?php

namespace Laravel\Ai\Events;

use Illuminate\Http\UploadedFile;
use Laravel\Ai\Messages\Attachments\TranscribableAudio;
use Laravel\Ai\Providers\Provider;

class GeneratingTranscription
{
    public function __construct(
        public string $invocationId,
        public Provider $provider,
        public string $model,
        public TranscribableAudio|UploadedFile $audio,
        public ?string $language,
        public bool $diarize = false,
    ) {}
}
