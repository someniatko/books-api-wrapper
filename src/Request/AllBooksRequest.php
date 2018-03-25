<?php

namespace BooksApi\Request;

use BooksApi\Transformer\BookTransformer;
use BooksApi\Transformer\TransformerInterface;

class AllBooksRequest extends AbstractRequest implements RequestInterface
{
    protected function getMainUri() :string
    {
        return '/books';
    }

    public function getExpectedResponseField() :string
    {
        return 'books';
    }

    public function getTransformer() :TransformerInterface
    {
        return new BookTransformer;
    }
}