<?php

namespace Laravel\Ai\Messages\Attachments;

abstract class Audio extends Attachment
{
    /**
     * Create a new audio attachment from Base64 data.
     */
    public static function fromBase64(string $base64, ?string $mime = null): Base64Audio
    {
        return new Base64Audio($base64, $mime);
    }

    /**
     * Create a new audio attachment using the audio at the given path.
     */
    public static function fromPath(string $path, ?string $mime = null): LocalAudio
    {
        return new LocalAudio($path, $mime);
    }

    /**
     * Create a new stored audio attachment using the audio at the given path on the given disk.
     */
    public static function fromStorage(string $path, ?string $disk = null): StoredAudio
    {
        return new StoredAudio($path, $disk);
    }
}
