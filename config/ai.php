<?php

use Laravel\Ai\Enums\AiProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Default AI Provider Names
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the AI providers below should be the
    | default for AI operations when no explicit provider is provided
    | for the operation. This should be any provider defined below.
    |
    */

    'default' => AiProvider::OPENAI,
    'default_for_images' => AiProvider::GEMINI,
    'default_for_audio' => AiProvider::OPENAI,
    'default_for_transcription' => AiProvider::OPENAI,
    'default_for_embeddings' => AiProvider::OPENAI,
    'default_for_reranking' => AiProvider::COHERE,

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Below you may configure caching strategies for AI related operations
    | such as embedding generation. You are free to adjust these values
    | based on your application's available caching stores and needs.
    |
    */

    'caching' => [
        'embeddings' => [
            'cache' => false,
            'store' => env('CACHE_STORE', 'database'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | AI Providers
    |--------------------------------------------------------------------------
    |
    | Below are each of your AI providers defined for this application. Each
    | represents an AI provider and API key combination which can be used
    | to perform tasks like text, image, and audio creation via agents.
    |
    */

    'providers' => [
        'anthropic' => [
            'driver' => AiProvider::ANTHROPIC,
            'key' => env('ANTHROPIC_API_KEY'),
        ],

        'cohere' => [
            'driver' => AiProvider::COHERE,
            'key' => env('COHERE_API_KEY'),
        ],

        'eleven' => [
            'driver' => AiProvider::ELEVEN_LABS,
            'key' => env('ELEVENLABS_API_KEY'),
        ],

        'gemini' => [
            'driver' => AiProvider::GEMINI,
            'key' => env('GEMINI_API_KEY'),
        ],

        'groq' => [
            'driver' => AiProvider::GROQ,
            'key' => env('GROQ_API_KEY'),
        ],

        'jina' => [
            'driver' => AiProvider::JINA,
            'key' => env('JINA_API_KEY'),
        ],

        'openai' => [
            'driver' => AiProvider::OPENAI,
            'key' => env('OPENAI_API_KEY'),
        ],

        'openrouter' => [
            'driver' => AiProvider::OPEN_ROUTER,
            'key' => env('OPENROUTER_API_KEY'),
        ],

        'xai' => [
            'driver' => AiProvider::XAI,
            'key' => env('XAI_API_KEY'),
        ],
    ],

];
