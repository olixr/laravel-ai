<?php

namespace Laravel\Ai\Messages\Attachments;

class RemoteImage extends Image
{
    public function __construct(public string $url) {}
}
