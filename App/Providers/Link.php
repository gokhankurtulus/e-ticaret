<?php

namespace App\Providers;


enum Link: string
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

    case SEARCH = "search";
    case LOGIN = "login";
    case LOGOUT = "logout";
    case REGISTER = "register";
    case FORGOT_PASSWORD = "forgot-password";
    case PROFILE = "profile";
    case BASKET = "basket";
    case ORDERS = "orders";
    case CATEGORY = "category";
    case PRODUCT = "product";


    case PANEL_BASE = 'panel/';
    case PANEL_SEARCH = "panel/search";

    public function url(string $slug = '', string $language = 'tr'): string
    {
        return match ($this) {
            self::BASE => Provider::BASEURL . "$language/",
            self::INDEX => Provider::BASEURL . "$language/index",

            self::FAQ => Provider::BASEURL . "$language/faq",
            self::REFUND => Provider::BASEURL . "$language/refund",
            self::PAYMENT => Provider::BASEURL . "$language/payment",

            self::ABOUT_US => Provider::BASEURL . "$language/about",
            self::PARTNERS => Provider::BASEURL . "$language/partners",
            self::STORES => Provider::BASEURL . "$language/stores",
            self::CAREER => Provider::BASEURL . "$language/career",
            self::CONTACT => Provider::BASEURL . "$language/contact",

            self::PRIVACY => Provider::BASEURL . "$language/privacy",
            self::COOKIES => Provider::BASEURL . "$language/cookies",
            self::AGREEMENT => Provider::BASEURL . "$language/agreement",

            self::SEARCH => Provider::BASEURL . "$language/search",
            self::LOGIN => Provider::BASEURL . "$language/login/$slug",
            self::LOGOUT => Provider::BASEURL . "$language/logout",
            self::REGISTER => Provider::BASEURL . "$language/register",
            self::FORGOT_PASSWORD => Provider::BASEURL . "$language/forgot-password",
            self::PROFILE => Provider::BASEURL . "$language/profile",
            self::BASKET => Provider::BASEURL . "$language/basket",
            self::ORDERS => Provider::BASEURL . "$language/orders",
            self::CATEGORY => Provider::BASEURL . "$language/category/$slug",
            self::PRODUCT => Provider::BASEURL . "$language/product/$slug",


            self::PANEL_BASE => Provider::BASEURL . "$language/panel/",
            self::PANEL_SEARCH => Provider::BASEURL . "$language/panel/search",
        };
    }
}