<?php

namespace App\Middleware\Auth;

use App\Providers\{Functions, UserSettings, Error};

class ValidateLoginCredentials
{

    public static function handle(array $request)
    {
        if ($request['type'] === 'LoginviaUsername' && isset($request['username']) && isset($request['password'])) {
            $username = $request['username'];
            $password = $request['password'];
            if (!Functions::isLettersWithoutWhitespace($username) || !Functions::isStringLenghtBetween($username, UserSettings::UsernameMinChar, UserSettings::UsernameMaxChar)) return Error::NOT_ALLOWED_USERNAME;
            if (!Functions::isAllowedPassword($password) || !Functions::isStringLenghtBetween($password, UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::NOT_ALLOWED_PASSWORD;
        } else if ($request['type'] === 'LoginviaMail' && isset($request['mail']) && isset($request['password'])) {
            $mail = $request['mail'];
            $password = $request['password'];
            if (!Functions::isEmail($mail)) return Error::NOT_EMAIL;
            if (!Functions::isAllowedPassword($password) || !Functions::isStringLenghtBetween($password, UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::NOT_ALLOWED_PASSWORD;
        } else if ($request['type'] === 'LoginviaPhone' && isset($request['phone']) && isset($request['password'])) {
            $phone = $request['phone'];
            $password = $request['password'];
            if (!Functions::isFormattedPhone($phone)) return Error::NOT_FORMATTED_PHONE;
            if (!Functions::isAllowedPassword($password) || !Functions::isStringLenghtBetween($password, UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::NOT_ALLOWED_PASSWORD;
        } else
            return Error::AUTH_TYPE_MISSING;
        return Error::SUCCESS;
    }
}