<?php

namespace App\Providers;

enum Route: string
{
    case BASE = '';
    case INDEX = 'index';

    case FAQ = "faq";
    case REFUND = "refund";
    case PAYMENT = "payment";

    case ABOUT_US = "about";
    case PARTNERS = "partners";
    case STORES = "stores";
    case CAREER = "career";
    case CONTACT = "contact";

    case PRIVACY = "privacy";
    case COOKIES = "cookies";
    case AGREEMENT = "agreement";

    case LOGIN = "login";
    case REGISTER = "register";
    case PROFILE = "profile";
    case BASKET = "basket";
    case ORDERS = "orders";
    case PRODUCT = "product";

    public function url(string $slug = ''): string
    {
        return match ($this) {
            self::BASE => Provider::BASEURL . "",
            self::INDEX => Provider::BASEURL . "index",

            self::FAQ => Provider::BASEURL . "faq",
            self::REFUND => Provider::BASEURL . "refund",
            self::PAYMENT => Provider::BASEURL . "payment",

            self::ABOUT_US => Provider::BASEURL . "about",
            self::PARTNERS => Provider::BASEURL . "partners",
            self::STORES => Provider::BASEURL . "stores",
            self::CAREER => Provider::BASEURL . "career",
            self::CONTACT => Provider::BASEURL . "contact",

            self::PRIVACY => Provider::BASEURL . "privacy",
            self::COOKIES => Provider::BASEURL . "cookies",
            self::AGREEMENT => Provider::BASEURL . "agreement",

            self::LOGIN => Provider::BASEURL . "login",
            self::REGISTER => Provider::BASEURL . "register",
            self::PROFILE => Provider::BASEURL . "profile",
            self::BASKET => Provider::BASEURL . "basket",
            self::ORDERS => Provider::BASEURL . "orders",
            self::PRODUCT => Provider::BASEURL . "product/$slug",
        };
    }
}