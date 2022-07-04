<?php

namespace App\Providers;

enum Assets
{
    case BASE;
    case CSS;
    case JS;
    case IMG;
    case MEDIA;

    public function path(string $slug = ""): string
    {
        return match ($this) {
            self::BASE => Provider::PUBLIC_URL . "assets/$slug",
            self::CSS => self::BASE->path() . "css/$slug",
            self::JS => self::BASE->path() . "js/$slug",
            self::IMG => self::BASE->path() . "img/$slug",
            self::MEDIA => self::BASE->path() . "media/$slug",
        };
    }
}