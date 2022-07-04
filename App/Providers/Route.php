<?php

namespace App\Providers;

enum Route: string
{
    case LOGIN = "login";
    case REGISTER = "register";
    case PROFILE = "profile";
    case BASKET = "basket";
    case ORDERS = "orders";
    case PRODUCT = "product";

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