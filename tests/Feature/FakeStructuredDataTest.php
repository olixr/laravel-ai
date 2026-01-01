<?php

namespace Tests\Feature;

use Illuminate\JsonSchema\JsonSchemaTypeFactory;
use Illuminate\JsonSchema\Types\ObjectType;
use Tests\TestCase;

use function Laravel\Ai\fake;

class FakeStructuredDataTest extends TestCase
{
    public function test_structured_data_can_be_faked(): void
    {
        $schema = new JsonSchemaTypeFactory;

        $object = (new ObjectType([
            'name' => $schema->string()->required(),
            'age' => $schema->integer()->required()->min(1)->max(120),
            'address' => $schema->object([
                'line_one' => $schema->string(),
                'line_two' => $schema->string(),
            ])->withoutAdditionalProperties(),
            'role' => $schema->string()->required()->enum(['admin', 'editor']),
            'skills' => $schema->array()->required()->min(5)->items(
                $schema->string()->required(),
            ),
            'active' => $schema->boolean(),
        ]))->withoutAdditionalProperties();

        $fake = fake($object);

        $this->assertTrue(is_string($fake['name']));
        $this->assertTrue(is_numeric($fake['age']));
        $this->assertTrue(is_array($fake['address']));
        $this->assertTrue(in_array($fake['role'], ['admin', 'editor']));
        $this->assertTrue(array_is_list($fake['skills']));
        $this->assertTrue(is_bool($fake['active']));
    }
}
