<?php

namespace Laravel\Ai\Messages\Attachments;

class ProviderDocument extends Document
{
    public function __construct(public string $id) {}
}
