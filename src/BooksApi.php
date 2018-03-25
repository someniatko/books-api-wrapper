<?php

namespace BooksApi;

use BooksApi\LimitScope\LimitScopeInterface;
use BooksApi\Request\AllAuthorsRequest;
use BooksApi\Request\AllBooksRequest;
use BooksApi\Request\BooksByAuthorRequest;
use BooksApi\RequestPerformer\RequestPerformer;
use BooksApi\RequestPerformer\RequestPerformerInterface;
use BooksApi\Response\ResponseInterface;
use Buzz\Browser;

class BooksApi implements BooksApiInterface
{
    private $requestPerformer;
    private $uri;

    public function __construct(
        string $uri = 'http://94.254.0.188:4000',
        RequestPerformerInterface $requestPerformer = null)
    {
        $this->requestPerformer = $requestPerformer
            ?? new RequestPerformer(new Browser);

        $this->uri = $uri;
    }

    public function fetchBooks(LimitScopeInterface $limitScope = null) :ResponseInterface
    {
        return $this->requestPerformer->performRequest(
            $this->uri, new AllBooksRequest($limitScope)
        );
    }

    public function fetchAuthors(LimitScopeInterface $limitScope = null)
    :ResponseInterface
    {
        return $this->requestPerformer->performRequest(
            $this->uri, new AllAuthorsRequest($limitScope)
        );
    }

    public function fetchBooksByAuthor(
        int $authorId,
        LimitScopeInterface $limitScope = null
    ) :ResponseInterface
    {
        return $this->requestPerformer->performRequest(
            $this->uri, new BooksByAuthorRequest($authorId, $limitScope)
        );
    }
}