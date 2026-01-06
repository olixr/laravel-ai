<?php

namespace Laravel\Ai\Providers\Tools;

class FileSearch extends ProviderTool
{
    public function __construct(
        public array $storeIds,
    ) {}
}
