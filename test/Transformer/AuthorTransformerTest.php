<?php

namespace BooksApi\Tests\Transformer;

use BooksApi\Model\Author;
use BooksApi\Transformer\AuthorTransformer;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * This tests exists in order to show I am familiar with PHPUnit ;)
 * Unfortunately, providing good test coverage goes far beyond 1h time estimation
 * (Yes, I know a good developer should work by TDD)
 */
class AuthorTransformerTest extends TestCase
{
    public function testTransformEntityReturnsCorrectEntity() :void
    {
        $data = [
            'id' => 1,
            'name' => 'Johnny Catsvill',
        ];

        $this->assertInstanceOf(
            Author::class, (new AuthorTransformer)->transformEntity($data));
    }

    public function testTransformEntitySetsCorrectData() :void
    {
        $data = [
            'id' => 2,
            'name' => 'Linus Torvalds',
        ];

        /** @var Author $author */
        $author = (new AuthorTransformer)->transformEntity($data);

        $this->assertEquals(2, $author->getId());
        $this->assertEquals('Linus Torvalds', $author->getFullName());
    }

    /**
     * @dataProvider invalidFieldsProvider
     * @param $data
     */
    public function testTransformEntityFailsOnInvalidFields(array $data) :void
    {
        $this->expectException(RuntimeException::class);
        (new AuthorTransformer)->transformEntity($data);
    }

    public function invalidFieldsProvider() :array
    {
        return [
            [[
                'id' => null,
                'name' => 'Linus Torvalds',
            ]],
            [[
                'name' => 'Linus Torvalds',
            ]],
            [[
                'id' => 2,
            ]],
            [[
                'id' => 2,
                'name' => null,
            ]]
        ];
    }
}