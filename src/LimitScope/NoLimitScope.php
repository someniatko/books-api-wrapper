<?php

namespace BooksApi\LimitScope;

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