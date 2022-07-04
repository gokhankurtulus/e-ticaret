<?php

namespace App\Providers;

class Provider
{
    const BASEURL = "http://localhost/e-ticaret/";
    const APP_URL = self::BASEURL . "App/";
    const PUBLIC_URL = self::BASEURL . "public/";
    const VIEW_URL = "public/views/";

    public static function boot()
    {
        date_default_timezone_set('Europe/Istanbul');
        setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'turkish');
    }
}