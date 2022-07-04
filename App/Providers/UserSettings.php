<?php

namespace App\Providers;

class UserSettings
{
    const UsernameMinChar = 6;
    const UsernameMaxChar = 20;
    const PasswordMinChar = 6;
    const PasswordMaxChar = 20;
    const NameMinChar = 2;
    const NameMaxChar = 20;
    const SurnameMinChar = 2;
    const SurnameMaxChar = 20;

    const LoginViaUsername = true;
    const LoginViaMail = true;
    const LoginViaPhone = true;
    const LoginViaFacebook = false;
    const LoginViaGmail = false;
}