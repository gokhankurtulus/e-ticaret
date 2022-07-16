<?php

namespace App\Middleware\Category;

use App\Models\Category;
use App\Providers\Error;

class CheckCodeExist
{
    public static function handle($request)
    {
        $checkExist = Category::getAll(where: ['code' => $request['code']]);
        return $checkExist ? Error::CODE_START_EXIST : Error::SUCCESS;
    }
}