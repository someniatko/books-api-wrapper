<?php

namespace BooksApi\Transformer;

use BooksApi\Model\Book;
use RuntimeException;

class BookTransformer implements TransformerInterface
{
    public function transformEntity(array $bookFields)
    {
        $this->validateFields($bookFields);

        $authorTransformer = new AuthorTransformer;
        $author = $authorTransformer->transformEntity($bookFields['author']);
        return new Book($bookFields['id'], $bookFields['title'], $author);
    }

    private function validateFields(array $bookFields) :void
    {
        foreach ([ 'id', 'title', 'author' ] as $field)
            if (!isset($bookFields[$field]))
                throw new RuntimeException("Missing \"{$field}\" field for Book");

        if (!is_int($bookFields['id']))
            throw new RuntimeException('"id" field for Book is not an integer');

        if (!is_string($bookFields['title']))
            throw new RuntimeException('"title" field for Book is not a string');

        if (!is_array($bookFields['author']))
            throw new RuntimeException('"author" field for Book is not an Author');
    }
}