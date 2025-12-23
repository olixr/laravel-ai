<?php

namespace Laravel\Ai\Messages\Attachments;

abstract class Image extends Attachment
{
    /**
     * Create a new provider image attachment using the image with the given ID.
     */
    public static function fromId(string $id): ProviderImage
    {
        return new ProviderImage($id);
    }

    /**
     * Create a new image attachment using the image at the given path.
     */
    public static function fromPath(string $path, ?string $mime = null): LocalImage
    {
        return new LocalImage($path, $mime);
    }

    /**
     * Create a new remote image attachment using the image at the given URL.
     */
    public static function fromUrl(string $url): RemoteImage
    {
        return new RemoteImage($url);
    }

    /**
     * Create a new stored image attachment using the image at the given path on the given disk.
     */
    public static function fromStorage(string $path, ?string $disk = null): StoredImage
    {
        return new StoredImage($path, $disk);
    }
}
