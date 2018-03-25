<?php

namespace BooksApi\Request;

use BooksApi\Transformer\TransformerInterface;

interface RequestInterface
{
    public function getUri() :string;
    public function getExpectedResponseField() :string;
    public function getTransformer() :TransformerInterface;
}