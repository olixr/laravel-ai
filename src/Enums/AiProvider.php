<?php

namespace Laravel\Ai\Enums;

enum AiProvider: string
{
    case ANTHROPIC = 'anthropic';
    case COHERE = 'cohere';
    case ELEVEN_LABS = 'eleven';
    case GEMINI = 'gemini';
    case GROQ = 'groq';
    case JINA = 'jina';
    case OPENAI = 'openai';
    case OPEN_ROUTER = 'openrouter';
    case XAI = 'xai';
}
