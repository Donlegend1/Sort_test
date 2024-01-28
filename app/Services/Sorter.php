<?php


namespace App\Services;

interface Sorter
{
    public function sort(array $products): array;
}