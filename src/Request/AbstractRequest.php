<?php

namespace BooksApi\Request;

use BooksApi\Core\LimitScopeInterface;
use BooksApi\Core\NoLimitScope;
use function http_build_query;

abstract class AbstractRequest implements RequestInterface
{
    private $limitScope;

    public function __construct(LimitScopeInterface $limitScope = null)
    {
        $this->limitScope = $limitScope ?? new NoLimitScope;
    }

    public function getUri() :string
    {
        return rtrim($this->getMainUri().'?'.$this->buildParams(), '?');
    }

    private function buildParams() :string
    {
        $params = [];
        if (!is_null($this->limitScope->getLimit()))
            $params['limit'] = $this->limitScope->getLimit();

        if (!is_null($this->limitScope->getOffset()))
            $params['offset'] = $this->limitScope->getOffset();

        return http_build_query($params);
    }

    abstract protected function getMainUri() :string;
}