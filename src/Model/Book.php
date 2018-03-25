<?php

namespace BooksApi\Model;

class Book
{
    private $id;
    private $title;
    private $author;

    public function __construct(
        int $id, string $title, Author $author
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
    }

    public function getId() :int
    {
        return $this->id;
    }

    public function getTitle() :string
    {
        return $this->title;
    }

    public function getAuthor() :Author
    {
        return $this->author;
    }
}