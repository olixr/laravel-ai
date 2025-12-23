<?php

namespace Tests\Feature;

use Laravel\Ai\Ai;
use Laravel\Ai\Providers\OpenAiProvider;
use LogicException;
use Tests\TestCase;

class AiManagerTest extends TestCase
{
    public function test_can_get_an_openai_provider_instance(): void
    {
        $this->assertInstanceOf(OpenAiProvider::class, Ai::textProvider('openai'));
    }

    public function test_provider_type_is_ensured(): void
    {
        $this->expectException(LogicException::class);

        Ai::audioProvider('anthropic');
    }
}
