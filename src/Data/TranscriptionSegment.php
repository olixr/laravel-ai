<?php

namespace Laravel\Ai\Data;

class TranscriptionSegment
{
    public function __construct(
        public string $text,
        public string $speaker,
        public float $startSeconds,
        public float $endSeconds,
    ) {}
}
