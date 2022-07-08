<?php

namespace App\Controllers\User;

use App\Controllers\{Controller};
use App\Middleware\Auth\{ValidateRegisterCredentials};
use App\Providers\{Error, UserSettings, Role};
use App\Models\{User};

class RegisterController extends Controller
{
    public static function authenticate(array $credentials)
    {
        if (!isset($credentials['type'])) return Error::AUTH_TYPE_MISSING;

        $status = self::middleware(ValidateRegisterCredentials::class, $credentials);
        if ($status === Error::SUCCESS) {
            $checkExist = User::get(where: ['username' => $credentials['username'], 'mail' => $credentials['mail']], operator: 'OR');
            if ($checkExist)
                return Error::USER_EXIST;
            else {
                $createUser = User::create(
                    [
                        'username' => $credentials['username'],
                        'name' => $credentials['name'],
                        'surname' => $credentials['surname'],
                        'mail' => $credentials['mail'],
                        'password' => password_hash($credentials['password'], PASSWORD_DEFAULT),
                        'status' => Role::ACTIVE_ACCOUNT->value(),
                        'verified' => Role::NOT_VERIFIED_ACCOUNT->value(),
                        'role' => Role::USER->value()
                    ]);
                return $createUser;
            }
        }
        return $status;
    }
}