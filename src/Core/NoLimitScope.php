<?php

namespace BooksApi\Core;

class NoLimitScope implements LimitScopeInterface
{
    public function getLimit() :?int
    {
        return null;
    }

    public function getOffset() :?int
    {
        return null;
    }
}