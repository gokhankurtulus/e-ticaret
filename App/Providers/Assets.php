<?php

namespace App\Providers;

enum Assets
{
    case BASE;
    case CSS;
    case JS;
    case IMG;
    case MEDIA;

    public function path(string $file = ""): string
    {
        return match ($this) {
            self::BASE => Provider::PUBLIC_URL . "assets/$file",
            self::CSS => self::BASE->path() . "css/$file",
            self::JS => self::BASE->path() . "js/$file",
            self::IMG => self::BASE->path() . "img/$file",
            self::MEDIA => self::BASE->path() . "media/$file",
        };
    }
}