<?php

namespace BooksApi\Response;

use BooksApi\LimitScope\LimitScopeInterface;

interface ResponseInterface
{
    public function getPayload() :array;
    public function getStatus() :Status;
    public function getTotalRowsCount() :int;
    public function getLimitScope() :LimitScopeInterface;
}