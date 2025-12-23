<?php

namespace Laravel\Ai\Messages\Attachments;

use Illuminate\Support\Facades\Storage;

class StoredAudio extends Audio implements TranscribableAudio
{
    public function __construct(public string $path, public ?string $disk = null) {}

    /**
     * Get the Base64 representation of the audio for transcription.
     */
    public function toBase64ForTranscription(): string
    {
        return base64_encode(Storage::disk($this->disk)->get($this->path));
    }

    /**
     * Get the MIME type for transcription.
     */
    public function mimeTypeForTranscription(): ?string
    {
        return Storage::disk($this->disk)->mimeType($this->path);
    }
}
