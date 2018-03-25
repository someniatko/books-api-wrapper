<?php

namespace BooksApi\Response;

use BooksApi\Core\LimitScope;
use BooksApi\Core\LimitScopeInterface;

class Response implements ResponseInterface
{
    private $payload;
    private $status;
    private $rowsCount;
    private $limitScope;

    public function __construct(
        array $payload,
        Status $status,
        int $rowsCount,
        LimitScopeInterface $limitScope
    )
    {
        $this->payload = $payload;
        $this->status = $status;
        $this->rowsCount = $rowsCount;
        $this->limitScope = $limitScope;
    }

    public function getPayload() :array
    {
        return $this->payload;
    }

    public function getStatus() :Status
    {
        return $this->status;
    }

    public function getTotalRowsCount() :int
    {
        return $this->rowsCount;
    }

    public function getLimitScope() :LimitScopeInterface
    {
        return $this->limitScope;
    }
}