<?php

namespace App\Middleware\Auth;

use App\Providers\{Functions, UserSettings, Error};

class ValidateRegisterCredentials
{
    public static function handle(array $request)
    {
        if ($request['type'] === 'Register') {
            if (!isset($request['username']) ||
                !isset($request['name']) ||
                !isset($request['surname']) ||
                !isset($request['mail']) ||
                !isset($request['password']) ||
                !isset($request['passwordCheck']))
                return Error::FORM_PARAMETER_MISSING;

            if (!Functions::isLettersWithoutWhitespace($request['username']) || !Functions::isStringLenghtBetween($request['username'], UserSettings::UsernameMinChar, UserSettings::UsernameMaxChar)) return Error::NOT_ALLOWED_USERNAME;
            if (!Functions::isTurkishLettersWithWhitespace($request['name']) || !Functions::isStringLenghtBetween($request['name'], UserSettings::NameMinChar, UserSettings::NameMaxChar)) return Error::NOT_ALLOWED_NAME;
            if (!Functions::isTurkishLettersWithWhitespace($request['surname']) || !Functions::isStringLenghtBetween($request['surname'], UserSettings::SurnameMinChar, UserSettings::SurnameMaxChar)) return Error::NOT_ALLOWED_SURNAME;
            if (!Functions::isEmail($request['mail'])) return Error::NOT_EMAIL;
            if (!Functions::isPasswordsMatch($request['password'], $request['passwordCheck'])) return Error::NOT_MATCHED_PASSWORD;
        } else
            return Error::AUTH_TYPE_MISSING;

        return Error::SUCCESS;
    }
}