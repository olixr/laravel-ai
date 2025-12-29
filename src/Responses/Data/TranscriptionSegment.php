<?php

namespace Laravel\Ai\Responses\Data;

class TranscriptionSegment
{
    public function __construct(
        public string $text,
        public string $speaker,
        public float $startSeconds,
        public float $endSeconds,
    ) {}
}
