<?php

namespace Laravel\Ai\Messages\Attachments;

class StoredDocument extends Document
{
    public function __construct(public string $path, public ?string $disk = null) {}
}
