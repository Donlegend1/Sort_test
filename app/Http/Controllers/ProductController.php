<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\Catalog;
use App\Sorters\PriceSorter;
use App\Sorters\SalesPerViewSorter;
use App\Services\SorterFactory;
use Illuminate\Http\Response;

class ProductController extends Controller
{
   public function index(Request $request)
    {
        $sortBy = $request->query('sort_by');
        $products = [
            [
                'id' => 1,
                'name' => 'Alabaster Table',
                'price' => 12.99,
                'created' => '2019-01-04',
                'sales_count' => 32,
                'views_count' => 730,
            ],
            [
                'id' => 2,
                'name' => 'Zebra Table',
                'price' => 44.49,
                'created' => '2012-01-04',
                'sales_count' => 301,
                'views_count' => 3279,
            ],
            [
                'id' => 3,
                'name' => 'Coffee Table',
                'price' => 10.00,
                'created' => '2014-05-28',
                'sales_count' => 1048,
                'views_count' => 20123,
            ]
            ];

        if (isset($sortBy)) {
            $sorter = SorterFactory::createSorter($sortBy);
            $sortedProducts = (new Catalog($products))->getProducts($sorter);

            return response(
                [
                    'success' => true,
                    'message' => "Sorted by $sortBy",
                    'data' => $sortedProducts,
                ],
                Response::HTTP_OK
            );
        }

        return response(
            [
                'success' => true,
                'message' => 'Data fetched but not sorted',
                'data' => $products,
            ],
            Response::HTTP_OK
        );
    }

}