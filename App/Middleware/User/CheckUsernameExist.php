<?php

namespace App\Middleware\User;

use App\Models\User;
use App\Providers\Error;

class CheckUsernameExist
{

    public static function handle($request)
    {
        $checkExist = User::getAll(where: ['username' => $request['username']]);
        return $checkExist ? Error::USERNAME_EXIST : Error::SUCCESS;
    }

}