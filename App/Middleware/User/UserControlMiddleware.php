<?php

namespace App\Middleware\User;

class UserControlMiddleware
{
    protected static $status = true;

    public static function handle($request)
    {
        if (is_null($request)) {
            self::$status = false;
        }
        if (isset($request['id']))
            if (!preg_match("/^[0-9]*$/", $request['id']) ||
                is_null($request['id']) ||
                empty($request['id']))
                self::$status = false;
        if (isset($request['username']))
            if (!preg_match("/^[a-zA-Z0-9]*$/", $request['username']) ||
                is_null($request['username']) ||
                empty($request['username']) ||
                !is_string($request['username']))
                self::$status = false;
        return self::$status;
    }

}