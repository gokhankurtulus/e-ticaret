<?php

namespace App\Middleware\User;

use App\Models\User;
use App\Providers\Error;

class CheckCredentialsExist
{
    protected static $status = true;

    public static function handle($request)
    {
        $checkExist = User::getAll(where: ['username' => $request['username'], 'mail' => $request['mail']], operator: 'OR');
        if ($checkExist)
            return Error::USER_EXIST;
        else
            return Error::SUCCESS;
    }
}