<?php

namespace App\Providers;

enum Error
{
    case SUCCESS;
    case NULL_OR_EMPTY_STRING;
    case STRING_LENGHT_BETWEEN;
    case LETTERS_WITHOUT_WHITESPACE;
    case TR_LETTERS_WITH_WHITESPACE;
    case NOT_ALLOWED_USERNAME;
    case NOT_ALLOWED_PASSWORD;
    case NOT_EMAIL;
    case NOT_FORMATTED_PHONE;

    case AUTH_TYPE_MISSING;
    case USER_NOT_FOUND;
    case NOT_OBJECT;
    case WRONG_PASSWORD;
    case PASSWORD_LENGHT;
    case BANNED;

    public function message(): string
    {
        return match ($this) {
            self::SUCCESS => 'Hata bulunamadı',
            self::NULL_OR_EMPTY_STRING => 'Null veya boş string',
            self::STRING_LENGHT_BETWEEN => 'Karakter sayısı belirtilen değerler arasında değil',
            self::LETTERS_WITHOUT_WHITESPACE => 'Yanlızca ingilizce karakter içerebilir',
            self::TR_LETTERS_WITH_WHITESPACE => 'Yanlızca türkçe karakter ve boşluk içerebilir',
            self::NOT_ALLOWED_USERNAME => 'Kullanıcı adı istenilen biçimde değil',
            self::NOT_ALLOWED_PASSWORD => 'Şifre istenilen biçimde değil',
            self::NOT_EMAIL => 'Mail standartları karşılamıyor',
            self::NOT_FORMATTED_PHONE => 'Telefon numarası istenilen standartları karşılamıyor',

            self::AUTH_TYPE_MISSING => 'Authentication type bulunamadı',
            self::USER_NOT_FOUND => 'Kullanıcı bulunamadı',
            self::NOT_OBJECT => 'Obje değil',
            self::WRONG_PASSWORD => 'Yanlış şifre',
            self::PASSWORD_LENGHT => 'Şifre uzunluğu istenilen biçimde değil',
            self::BANNED => 'Kullanıcı Yasaklı'
        };
    }
}