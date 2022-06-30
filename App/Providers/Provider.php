<?php

namespace App\Providers;
class Provider
{
    public static function boot()
    {
        /* User Roles */
        define('Banned', 0);
        define('User', 1);
        define('Editor', 2);
        define('Support', 3);
        define('Moderator', 4);
        define('Admin', 5);
    }
}