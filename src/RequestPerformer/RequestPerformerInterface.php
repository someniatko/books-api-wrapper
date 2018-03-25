<?php

namespace BooksApi\RequestPerformer;

use BooksApi\Request\RequestInterface;
use BooksApi\Response\ResponseInterface;

interface RequestPerformerInterface
{
    public function performRequest(
        string $mainUri, RequestInterface $request
    ) :ResponseInterface;
}