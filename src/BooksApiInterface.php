<?php

namespace BooksApi;

use BooksApi\LimitScope\LimitScopeInterface;
use BooksApi\Response\ResponseInterface;

interface BooksApiInterface
{
    public function fetchBooks(LimitScopeInterface $limitScope = null) :ResponseInterface;
    public function fetchAuthors(LimitScopeInterface $limitScope = null)
    :ResponseInterface;
    public function fetchBooksByAuthor(int $authorId, LimitScopeInterface $limitScope =
    null)
    :ResponseInterface;
}