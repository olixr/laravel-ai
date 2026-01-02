<?php

namespace Laravel\Ai\Files;

class RemoteDocument extends Document
{
    public function __construct(public string $url) {}
}
