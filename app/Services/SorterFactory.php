<?php

namespace App\Services;


class SorterFactory
{
    public static function createSorter($sortBy): Sorter
    {
        switch ($sortBy) {
            case 'price':
                return new PriceSorter();
            case 'sales_per_view':
                return new SalesPerViewSorter();
                // Add more cases for additional sorters as needed

            default:
                // Create a generic sorter that uses the provided parameter
                return new class($sortBy) implements Sorter
                {
                    protected $sortBy;

                    public function __construct($sortBy)
                    {
                        $this->sortBy = $sortBy;
                    }

                    public function sort(array $products): array
                    {
                        // Implement dynamic sorting based on the provided parameter
                        usort($products, function ($a, $b) {
                            return $a[$this->sortBy] <=> $b[$this->sortBy];
                        });

                        return $products;
                    }
                };
        }
    }
}