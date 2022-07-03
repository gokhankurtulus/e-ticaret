<?php

namespace App\Providers;

enum Route
{
    case LOGIN;
    case REGISTER;
    case PROFILE;
    case BASKET;
    case ORDERS;
    case PRODUCT;

    public function url(string $slug = ''): string
    {
        return match ($this) {
            self::LOGIN => Provider::BASEURL . "login",
            self::REGISTER => Provider::BASEURL . "register",
            self::PROFILE => Provider::BASEURL . "profile",
            self::BASKET => Provider::BASEURL . "basket",
            self::ORDERS => Provider::BASEURL . "orders",
            self::PRODUCT => Provider::BASEURL . "product/$slug",
        };
    }
}