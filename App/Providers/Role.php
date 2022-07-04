<?php

namespace App\Providers;

enum Role
{
    case BANNED;
    case USER;
    case VERIFIED_USER;
    case EDITOR;
    case SUPPORT;
    case MODERATOR;
    case ADMIN;

    public function value(): int
    {
        return match ($this) {
            self::BANNED => 0,
            self::USER => 1,
            self::VERIFIED_USER => 2,
            self::EDITOR => 3,
            self::SUPPORT => 4,
            self::MODERATOR => 5,
            self::ADMIN => 6
        };
    }

    public function definition(): string
    {
        return match ($this) {
            self::BANNED => "Yasaklı kullanıcı",
            self::USER => "Onaylanmamış kullanıcı",
            self::VERIFIED_USER => "Onaylanmış kullanıcı",
            self::EDITOR => "Editör yetkileri verilmiş kullanıcı",
            self::SUPPORT => "Destek birimi yetkileri verilmiş kullanıcı",
            self::MODERATOR => "Moderatör yetkileri verilmiş kullanıcı",
            self::ADMIN => "Tam yetkilendirilmiş kullanıcı"
        };
    }
}