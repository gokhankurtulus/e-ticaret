<?php

namespace App\Middleware\Category;

use App\Providers\{Functions, Error};

class ValidateGetCategory
{
    public static function handle(array $request)
    {
        if (isset($request['id']))
            if (!Functions::isContainNumbers($request['id'])) return Error::NOT_ID;
        if (isset($request['slug']))
            if (!Functions::isAllowedSlug($request['slug'])) return Error::NOT_SLUG;
        return Error::SUCCESS;
    }
}