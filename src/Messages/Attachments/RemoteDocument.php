<?php

namespace Laravel\Ai\Messages\Attachments;

class RemoteDocument extends Document
{
    public function __construct(public string $url) {}
}
