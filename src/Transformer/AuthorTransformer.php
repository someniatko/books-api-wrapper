<?php

namespace BooksApi\Transformer;

use BooksApi\Model\Author;
use RuntimeException;

class AuthorTransformer implements TransformerInterface
{
    public function transformEntity(array $authorFields)
    {
        if (!isset($authorFields['id']))
            throw new RuntimeException('Missing "id" field for Author');

        if (!isset($authorFields['name']))
            throw new RuntimeException('Missing "name" field for Author');

        if (!is_int($authorFields['id']))
            throw new RuntimeException('"id" field for Author is not an integer');

        if (!is_string($authorFields['name']))
            throw new RuntimeException('"id" field for Author is not a string');

        return new Author($authorFields['id'], $authorFields['name']);
    }
}