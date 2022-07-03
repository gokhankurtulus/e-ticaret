<?php

namespace App\Providers;

enum Assets
{
    case BASE;
    case CSS;
    case JS;
    case IMG;
    case MEDIA;

    public function path(string $slug = ''): string
    {
        return match ($this) {
            self::BASE => Provider::BASEURL . "assets/$slug",
            self::CSS => Provider::BASEURL . "css/$slug",
            self::JS => Provider::BASEURL . "js/$slug",
            self::IMG => Provider::BASEURL . "img/$slug",
            self::MEDIA => Provider::BASEURL . "media/$slug",
        };
    }
}