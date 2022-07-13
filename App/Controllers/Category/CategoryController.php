<?php

namespace App\Controllers\Category;

use App\Controllers\Controller;
use App\Middleware\Category\ValidateGetCategory;
use App\Models\Category;
use App\Providers\Error;

class CategoryController extends Controller
{
    public static function get($where = [], $operator = 'AND')
    {
        $status = self::middleware(ValidateGetCategory::class, $where);
        if ($status === Error::SUCCESS) {
            $category = Category::get(where: $where, operator: $operator);
            if (!is_null($category)) //TODO check here
                return $category;
            else
                return Error::CATEGORY_NOT_FOUND;
        } else
            return $status;
    }
    public static function getAll($where = [], $operator = 'AND')
    {
        $status = self::middleware(ValidateGetCategory::class, $where);
        if ($status === Error::SUCCESS) {
            $category = Category::getAll(where: $where, operator: $operator);
            if (!is_null($category)) //TODO check here
                return $category;
            else
                return Error::CATEGORY_NOT_FOUND;
        } else
            return $status;
    }
}