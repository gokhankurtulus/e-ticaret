<?php

namespace App\Middleware\Auth;

use App\Providers\{Functions, UserSettings, Error};

class ValidateLoginCredentials
{

    public static function handle(array $request)
    {
        if ($request['type'] === 'LoginviaUsername') {
            if (!isset($request['username']) || !isset($request['password'])) return Error::FORM_PARAMETER_MISSING;
            if (!Functions::isLettersWithoutWhitespace($request['username']) || !Functions::isStringLenghtBetween($request['username'], UserSettings::UsernameMinChar, UserSettings::UsernameMaxChar)) return Error::NOT_ALLOWED_USERNAME;
            if (!Functions::isAllowedPassword($request['password']) || !Functions::isStringLenghtBetween($request['password'], UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::NOT_ALLOWED_PASSWORD;
        } else if ($request['type'] === 'LoginviaMail') {
            if (!isset($request['mail']) || !isset($request['password'])) return Error::FORM_PARAMETER_MISSING;
            if (!Functions::isEmail($request['mail'])) return Error::NOT_EMAIL;
            if (!Functions::isAllowedPassword($request['password']) || !Functions::isStringLenghtBetween($request['password'], UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::NOT_ALLOWED_PASSWORD;
        } else if ($request['type'] === 'LoginviaPhone') {
            if (!isset($request['phone']) || !isset($request['password'])) return Error::FORM_PARAMETER_MISSING;
            if (!Functions::isFormattedPhone($request['phone'])) return Error::NOT_FORMATTED_PHONE;
            if (!Functions::isAllowedPassword($request['password']) || !Functions::isStringLenghtBetween($request['password'], UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::NOT_ALLOWED_PASSWORD;
        } else
            return Error::AUTH_TYPE_MISSING;
        return Error::SUCCESS;
    }
}