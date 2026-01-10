<?php

namespace Tests\Feature;

use Illuminate\Support\Collection;
use Laravel\Ai\Tools\Request;
use Laravel\Ai\Tools\SimilaritySearch;
use Tests\TestCase;

class SimilaritySearchTest extends TestCase
{
    public function test_search_results_are_returned(): void
    {
        $data = [
            [
                'id' => 1,
                'query' => 'Test query',
            ],
            [
                'id' => 2,
                'query' => 'Test query',
            ],
        ];

        $search = new SimilaritySearch(using: function (string $query) use ($data) {
            return $data;
        });

        $results = $search->handle(new Request([
            'query' => 'Test query',
        ]));

        $this->assertTrue(str_contains($results, json_encode($data, JSON_PRETTY_PRINT)));
    }

    public function test_using_model_creates_similarity_search(): void
    {
        $search = SimilaritySearch::usingModel(
            FakeVectorModel::class,
            'embedding',
            0.7
        );

        $results = $search->handle(new Request([
            'query' => 'search term',
        ]));

        $this->assertStringContainsString('Results found.', $results);
        $this->assertStringContainsString('First document', $results);
        $this->assertStringContainsString('Second document', $results);
    }

    public function test_using_model_applies_custom_query_closure(): void
    {
        $search = SimilaritySearch::usingModel(
            FakeVectorModel::class,
            'embedding',
            0.7,
            fn ($query) => $query->where('active', true)
        );

        $results = $search->handle(new Request([
            'query' => 'search term',
        ]));

        $this->assertStringContainsString('Results found.', $results);
    }
}

class FakeVectorModel
{
    public static function query(): FakeQueryBuilder
    {
        return new FakeQueryBuilder;
    }
}

class FakeQueryBuilder
{
    protected array $conditions = [];

    public function whereVectorSimilarTo(string $column, string $query): self
    {
        $this->conditions['vector'] = [$column, $query];

        return $this;
    }

    public function where(string $column, mixed $value): self
    {
        $this->conditions[$column] = $value;

        return $this;
    }

    public function get(): Collection
    {
        return collect([
            ['id' => 1, 'content' => 'First document'],
            ['id' => 2, 'content' => 'Second document'],
        ]);
    }
}
