<?php

namespace BooksApi\Transformer;

interface TransformerInterface
{
    /**
     * Transforms data of one entity from API response to model
     * @param array $entityFields
     * @return object
     */
    public function transformEntity(array $entityFields);
}