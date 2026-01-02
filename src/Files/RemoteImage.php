<?php

namespace Laravel\Ai\Files;

class RemoteImage extends Image
{
    public function __construct(public string $url) {}
}
