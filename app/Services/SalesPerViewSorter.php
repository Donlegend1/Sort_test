<?php

namespace App\Services;

class SalesPerViewSorter implements Sorter
{
    public function sort(array $products): array
    {
        // Implement sorting logic by sales per view ratio
        usort($products, function ($a, $b) {
            $ratioA = $a['sales_count'] / $a['views_count'];
            $ratioB = $b['sales_count'] / $b['views_count'];

            return $ratioA <=> $ratioB;
        });

        return $products;
    }
}