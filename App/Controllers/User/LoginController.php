<?php

namespace App\Controllers\User;

use App\Controllers\{Controller};
use App\Middleware\Auth\{ValidateLoginCredentials};
use App\Providers\{Error, UserSettings, Role};
use App\Models\{User};

class LoginController extends Controller
{
    public static function authenticate(array $credentials)
    {
        if (!isset($credentials['type']) ||
            (!UserSettings::LoginViaUsername && $credentials['type'] === 'LoginviaUsername') ||
            (!UserSettings::LoginViaMail && $credentials['type'] === 'LoginviaMail') ||
            (!UserSettings::LoginViaPhone && $credentials['type'] === 'LoginviaPhone'))
            return Error::AUTH_TYPE_MISSING;
        $status = self::middleware(ValidateLoginCredentials::class, $credentials);
        if ($status === Error::SUCCESS) {
            if ($credentials['type'] === 'LoginviaUsername')
                $user = User::get(where: ['BINARY username' => $credentials['username']]);
            else if ($credentials['type'] === 'LoginviaMail')
                $user = User::get(where: ['BINARY mail' => $credentials['mail']]);
            else if ($credentials['type'] === 'LoginviaPhone')
                $user = User::get(where: ['BINARY phone' => $credentials['phone']]);
            if (isset($user) && is_object($user)) {
                if ($user->getStatus() == Role::PASSIVE_ACCOUNT->value())
                    return Error::PASSIVE_ACCOUNT;
                if ($user->getRole() == Role::BANNED->value())
                    return Error::BANNED;
                if (password_verify($credentials['password'], $user->getPassword()))
                    return $user->getID();
                else
                    return Error::WRONG_PASSWORD;
            } else
                return Error::USER_NOT_FOUND;
        }

        return $status;
    }
}