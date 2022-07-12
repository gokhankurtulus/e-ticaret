<?php

namespace App\Middleware\Product;

use App\Providers\{Functions, Error};

class ValidateGetProduct
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