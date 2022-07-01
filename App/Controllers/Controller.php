<?php

namespace App\Controllers;

class Controller
{
    protected static $response = null;
    public static function middleware($middleware, $request = null)
    {
        self::$response = $middleware::handle($request);
        return self::$response;
    }
}