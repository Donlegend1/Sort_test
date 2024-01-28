<?php

namespace App\Services;

class Catalog
{
    protected $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function getProducts(Sorter $sorter): array
    {
        return $sorter->sort($this->products);
    }
}