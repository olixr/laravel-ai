<?php

namespace Laravel\Ai\Files;

class LocalDocument extends Document
{
    public function __construct(public string $path) {}
}
