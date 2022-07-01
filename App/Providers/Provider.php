<?php

namespace App\Providers;

class Provider
{
    public static function boot()
    {
        date_default_timezone_set('Europe/Istanbul');
        setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'turkish');
        /* User Roles */
        define('Banned', 0);
        define('User', 1);
        define('Editor', 2);
        define('Support', 3);
        define('Moderator', 4);
        define('Admin', 5);
    }
}