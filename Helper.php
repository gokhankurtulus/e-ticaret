<?php

use App\Providers\Provider;

class Helper
{
    public static function boot()
    {
        spl_autoload_register(function ($class) {
            if (is_file($class . '.php')) {
                require_once($class . '.php');
            }
        });
        Provider::boot();

    }

}

function view($path)
{
    if (is_file(Provider::VIEW_URL . "$path"))
        include Provider::VIEW_URL . "$path";
}