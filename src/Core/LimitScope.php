<?php

namespace BooksApi\Core;

use SebastianBergmann\Timer\RuntimeException;

class LimitScope implements LimitScopeInterface
{
    private $limit;
    private $offset;

    /**
     * LimitScope constructor.
     * @param int|null $limit Null for no limit, or non-negative value for specifying a
     * limit of count of results
     * @param int|null $offset Null for no offset, or non-negative value for specifying
     * an offset
     */
    public function __construct(?int $limit = null, ?int $offset = null)
    {
        $this->validateUnsigned($limit, 'limit');
        $this->validateUnsigned($offset, 'offset');

        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * Returns null in case of no limit, or
     * @return int|null
     */
    public function getLimit() :?int
    {
        return $this->limit;
    }

    public function getOffset() :?int
    {
        return $this->offset;
    }

    private function validateUnsigned(?int $val, string $name) :void
    {
        if (is_null($val))
            return;

        if ($val < 0)
            throw new RuntimeException("\"$name\" must be a non-negative integer or null");
    }
}