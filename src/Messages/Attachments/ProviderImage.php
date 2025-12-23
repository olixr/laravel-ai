<?php

namespace Laravel\Ai\Messages\Attachments;

class ProviderImage extends Image
{
    public function __construct(public string $id) {}
}
