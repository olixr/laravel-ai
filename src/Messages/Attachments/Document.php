<?php

namespace Laravel\Ai\Messages\Attachments;

abstract class Document extends Attachment
{
    /**
     * Create a new provider document attachment using the document with the given ID.
     */
    public static function fromId(string $id): ProviderDocument
    {
        return new ProviderDocument($id);
    }

    /**
     * Create a new document attachment using the document at the given path.
     */
    public static function fromPath(string $path): LocalDocument
    {
        return new LocalDocument($path);
    }

    /**
     * Create a new remote document attachment using the document at the given URL.
     */
    public static function fromUrl(string $url): RemoteDocument
    {
        return new RemoteDocument($url);
    }

    /**
     * Create a new stored document attachment using the document at the given path on the given disk.
     */
    public static function fromStorage(string $path, ?string $disk = null): StoredDocument
    {
        return new StoredDocument($path, $disk);
    }
}
