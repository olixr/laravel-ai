<?php

namespace Tests\Feature;

use Laravel\Ai\Gateway\TextGenerationOptions;
use Tests\Feature\Agents\AssistantAgent;
use Tests\Feature\Agents\AttributeAgent;
use Tests\TestCase;

class AgentAttributeTest extends TestCase
{
    public function test_text_generation_options_can_be_created_from_agent_attributes(): void
    {
        $options = TextGenerationOptions::forAgent(new AttributeAgent);

        $this->assertSame(10, $options->maxSteps);
        $this->assertSame(4096, $options->maxTokens);
        $this->assertSame(0.7, $options->temperature);
    }

    public function test_text_generation_options_are_null_when_agent_has_no_attributes(): void
    {
        $options = TextGenerationOptions::forAgent(new AssistantAgent);

        $this->assertNull($options->maxSteps);
        $this->assertNull($options->maxTokens);
        $this->assertNull($options->temperature);
    }
}
