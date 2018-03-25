<?php

namespace BooksApi\Response;

use RuntimeException;

class Status
{
    public const OK = 1;
    public const INVALID_REQUEST = 2;
    public const NOT_FOUND = 3;

    private $status;
    private $description;

    public function __construct(int $status, string $description)
    {
        $this->validateStatus($status);
        $this->status = $status;
        $this->description = $description;
    }

    /**
     * Returns one of the constants defined in the Status interface.
     * @return int
     */
    public function getValue() :int
    {
        return $this->status;
    }

    public function getDescription() :string
    {
        return $this->description;
    }

    private function validateStatus(int $status) :void
    {
        if (!in_array($status, [self::OK, self::INVALID_REQUEST, self::NOT_FOUND]))
            throw new RuntimeException("Invalid status \"$status\"");
    }
}