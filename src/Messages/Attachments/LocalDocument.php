<?php

namespace Laravel\Ai\Messages\Attachments;

class LocalDocument extends Document
{
    public function __construct(public string $path) {}
}
