<?php

namespace App\Middleware\User;

use App\Providers\Error;
use App\Providers\Functions;
use App\Providers\UserSettings;

class GetUserMiddleware
{
    public static function handle($request)
    {
        if (isset($request['id']))
            if (!Functions::isContainNumbers($request['id'])) return Error::NOT_ID;
        if (isset($request['username']))
            if (!Functions::isLettersWithoutWhitespace($request['username']) || !Functions::isStringLenghtBetween($request['username'], UserSettings::UsernameMinChar, UserSettings::UsernameMaxChar)) return Error::NOT_ALLOWED_USERNAME;
        return Error::SUCCESS;
    }

}