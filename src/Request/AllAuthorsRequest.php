<?php

namespace BooksApi\Request;

use BooksApi\Transformer\AuthorTransformer;
use BooksApi\Transformer\TransformerInterface;

class AllAuthorsRequest extends AbstractRequest implements RequestInterface
{
    protected function getMainUri() :string
    {
        return '/authors';
    }

    public function getExpectedResponseField() :string
    {
        return 'authors';
    }

    public function getTransformer() :TransformerInterface
    {
        return new AuthorTransformer;
    }
}