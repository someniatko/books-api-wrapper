<?php

namespace BooksApi\Core;

interface LimitScopeInterface
{
    public function getLimit() :?int;
    public function getOffset() :?int;
}