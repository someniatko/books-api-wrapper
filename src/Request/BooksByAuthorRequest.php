<?php

namespace BooksApi\Request;

use BooksApi\LimitScope\LimitScopeInterface;
use BooksApi\Transformer\BookTransformer;
use BooksApi\Transformer\TransformerInterface;

class BooksByAuthorRequest extends AbstractRequest implements RequestInterface
{
    private $id;

    public function __construct(int $authorId, LimitScopeInterface $limitScope = null)
    {
        $this->id = $authorId;
        parent::__construct($limitScope);
    }

    protected function getMainUri() :string
    {
        return "/authors/{$this->id}/books";
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