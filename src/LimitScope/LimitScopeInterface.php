<?php

namespace BooksApi\LimitScope;

interface LimitScopeInterface
{
    public function getLimit() :?int;
    public function getOffset() :?int;
}