<?php

namespace App\Controllers\Product;

use App\Controllers\Controller;
use App\Middleware\Product\ValidateGetProduct;
use App\Models\Product;
use App\Providers\Error;
use App\Providers\Functions;

class ProductController extends Controller
{
    public static function get($where = [], $operator = 'AND')
    {
        $status = self::middleware(ValidateGetProduct::class, $where);
        if ($status === Error::SUCCESS) {
            $product = Product::get(where: $where, operator: $operator);
            if ($product) //TODO check here
                return $product;
            else
                return Error::PRODUCT_NOT_FOUND;
        } else
            return $status;
    }

    public static function search($column, $search_text, $where = [])
    {
        if (!Functions::isAllowedSearch($search_text))
            return Error::NOT_ALLOWED_SEARCH;
        $result = Product::search(column: $column, where: $where, search_text: $search_text);
        if (!$result)
            return Error::PRODUCT_NOT_FOUND;
        return $result;
    }
}