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
            if (!Functions::isLettersWithoutWhitespace($username)) return Error::LETTERS_WITHOUT_WHITESPACE;
            if (!Functions::isStringLenghtBetween($username, UserSettings::UsernameMinChar, UserSettings::UsernameMaxChar)) return Error::STRING_LENGHT_BETWEEN;
            if (!Functions::isAllowedPassword($password)) return Error::NOT_ALLOWED_PASSWORD;
            if (!Functions::isStringLenghtBetween($password, UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::STRING_LENGHT_BETWEEN;
        } else if ($request['type'] === 'LoginviaMail' && isset($request['mail']) && isset($request['password'])) {
            $mail = $request['mail'];
            $password = $request['password'];
            if (!Functions::isEmail($mail)) return Error::NOT_EMAIL;
            if (!Functions::isAllowedPassword($password)) return Error::NOT_ALLOWED_PASSWORD;
            if (!Functions::isStringLenghtBetween($password, UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::STRING_LENGHT_BETWEEN;
        } else if ($request['type'] === 'LoginviaPhone' && isset($request['phone']) && isset($request['password'])) {
            $phone = $request['phone'];
            $password = $request['password'];
            if (!Functions::isFormattedPhone($phone)) return Error::NOT_FORMATTED_PHONE;
            if (!Functions::isAllowedPassword($password)) return Error::NOT_ALLOWED_PASSWORD;
            if (!Functions::isStringLenghtBetween($password, UserSettings::PasswordMinChar, UserSettings::PasswordMaxChar)) return Error::STRING_LENGHT_BETWEEN;
        } else
            return Error::AUTH_TYPE_MISSING;
        return Error::SUCCESS;
    }
}