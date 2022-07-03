<?php

namespace App\Middleware\User;

use App\Models\User;

class CheckCredentialsExist
{
    protected static $status = true;

    public static function handle($request)
    {
        $checkExist = User::get(where: ['username' => $request['username'], 'mail' => $request['mail']], operator: 'OR');
        if ($checkExist)
            self::$status = true;
        else
            self::$status = false;
        return self::$status;
    }
}