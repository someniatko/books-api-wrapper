<?php

namespace BooksApi\Model;

class Author
{
    private $id;
    private $fullName;

    public function __construct(int $id, string $fullName)
    {
        $this->id = $id;
        $this->fullName = $fullName;
    }

    public function getId() :int
    {
        return $this->id;
    }

    public function getFullName() :string
    {
        return $this->fullName;
    }
}