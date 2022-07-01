<?php

namespace App\Middleware\User;

use App\Models\User;

class CheckUsernameExist
{
    protected static $status = true;

    public static function handle($request)
    {
        $checkExist = User::get(where: ['username' => $request['username']]);
        if (!$checkExist)
            self::$status = false;
        else
            self::$status = true;
        return self::$status;
    }

}