<?php

namespace App\Providers;

enum Role
{
    case ACTIVE_ACCOUNT;
    case PASSIVE_ACCOUNT;
    case VERIFIED_ACCOUNT;
    case NOT_VERIFIED_ACCOUNT;
    case BANNED;
    case USER;
    case EDITOR;
    case SUPPORT;
    case MODERATOR;
    case ADMIN;

    public function value(): int
    {
        return match ($this) {
            self::ACTIVE_ACCOUNT => 1,
            self::PASSIVE_ACCOUNT => 0,
            self::VERIFIED_ACCOUNT => 1,
            self::NOT_VERIFIED_ACCOUNT => 0,
            self::BANNED => 0,
            self::USER => 1,
            self::EDITOR => 2,
            self::SUPPORT => 3,
            self::MODERATOR => 4,
            self::ADMIN => 5
        };
    }

    public function definition(): string
    {
        return match ($this) {
            self::ACTIVE_ACCOUNT => "Aktif hesap",
            self::PASSIVE_ACCOUNT => "Pasif hesap",
            self::VERIFIED_ACCOUNT => "Onaylanmış hesap",
            self::NOT_VERIFIED_ACCOUNT => "Onaylanmamış hesap",
            self::BANNED => "Yasaklı kullanıcı",
            self::USER => "Onaylanmamış kullanıcı",
            self::EDITOR => "Editör yetkileri verilmiş kullanıcı",
            self::SUPPORT => "Destek birimi yetkileri verilmiş kullanıcı",
            self::MODERATOR => "Moderatör yetkileri verilmiş kullanıcı",
            self::ADMIN => "Tam yetkilendirilmiş kullanıcı"
        };
    }
}