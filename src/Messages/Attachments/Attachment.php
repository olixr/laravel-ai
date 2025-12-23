<?php

namespace Laravel\Ai\Messages\Attachments;

abstract class Attachment
{
    public ?string $name = null;

    /**
     * Set the attachment's name.
     */
    public function as(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
