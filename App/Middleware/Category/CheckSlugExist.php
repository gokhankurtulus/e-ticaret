<?php

namespace App\Middleware\Category;

use App\Models\Category;
use App\Providers\Error;

class CheckSlugExist
{
    public static function handle($request)
    {
        $checkExist = Category::getAll(where: ['slug' => $request['slug']]);
        return $checkExist ? Error::SLUG_EXIST : Error::SUCCESS;
    }
}