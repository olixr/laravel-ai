<?php

namespace Tests\Feature;

use Closure;
use Laravel\Ai\AgentPrompt;
use Laravel\Ai\Responses\StreamableAgentResponse;
use Tests\Feature\Agents\AssistantAgent;
use Tests\TestCase;

class AgentMiddlewareTest extends TestCase
{
    public function test_agent_middleware_is_invoked(): void
    {
        $response = (new AssistantAgent)->withMiddleware([
            new class
            {
                public function handle(AgentPrompt $prompt, Closure $next)
                {
                    return $next($prompt->revise('New prompt'));
                }
            },
        ])->prompt(
            'Test prompt',
            provider: 'loopback',
        );

        $this->assertEquals('New prompt', $response->text);
    }

    public function test_agent_middleware_is_invoked_when_streaming(): void
    {
        $response = (new AssistantAgent)->withMiddleware([
            new class
            {
                public function handle(AgentPrompt $prompt, Closure $next)
                {
                    return $next($prompt->revise('New prompt'));
                }
            },
        ])->stream(
            'Test prompt',
            provider: 'loopback',
        );

        $response
            ->each(fn () => true)
            ->then(function (StreamableAgentResponse $response) {
                $this->assertEquals('New prompt', $response->text);
            });
    }
}
