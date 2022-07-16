<?php

namespace App\Controllers\Category;

use App\Controllers\Controller;
use App\Providers\Functions;
use App\Middleware\Category\{CheckCodeExist, CheckSlugExist, ValidateGetCategory};
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

    public static function getAll($where = [], $operator = 'AND', $order = '')
    {
        $status = self::middleware(ValidateGetCategory::class, $where);
        if ($status === Error::SUCCESS) {
            $category = Category::getAll(where: $where, operator: $operator, order: $order);
            if (!is_null($category)) //TODO check here
                return $category;
            else
                return Error::CATEGORY_NOT_FOUND;
        } else
            return $status;
    }

    public static function update(array $attributes, $where = [], $operator = "AND")
    {
        //TODO make it simple and safer
        if (!Functions::isContainNumbers($where['id'])) return Error::NOT_ID;
        $getCategory = self::get(where: $where);
        if (!is_a($getCategory, Error::class)) {
            if (isset($attributes['slug']) && !Functions::IsNullOrEmptyString($attributes['slug']))
                $attributes['slug'] = Functions::createSlug($attributes['slug']);
            else
                $attributes['slug'] = Functions::createSlug($attributes['name']);
            if (isset($attributes['slug']) && $attributes['slug'] != $getCategory->getSlug())
                if (self::middleware(CheckSlugExist::class, $attributes) === Error::SLUG_EXIST) return Error::SLUG_EXIST;
            if (isset($attributes['code']) && $attributes['code'] != $getCategory->getCode())
                if (self::middleware(CheckCodeExist::class, $attributes) === Error::CODE_START_EXIST) return Error::CODE_START_EXIST;
            if (isset($attributes['parent']) && Functions::IsNullOrEmptyString($attributes['parent']))
                $attributes['parent'] = NULL;
            $updatingCategory = $getCategory->update(attributes: $attributes, where: $where, operator: $operator);
            if ($updatingCategory)
                return $updatingCategory;
            if (!$updatingCategory)
                return Error::NOTHING_CHANGED;
        } else
            return $getCategory;
        return Error::UPDATE_FAILED;
    }
}