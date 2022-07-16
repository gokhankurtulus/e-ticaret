<?php

namespace App\Providers;

enum Error
{
    case SUCCESS;
    case NULL_OR_EMPTY_STRING;
    case STRING_LENGHT_BETWEEN;
    case LETTERS_WITHOUT_WHITESPACE;
    case LETTERS_WITH_WHITESPACE;
    case TR_LETTERS_WITH_WHITESPACE;
    case AUTH_TYPE_MISSING;
    case FORM_PARAMETER_MISSING;
    case ID_MISSING;

    case NOT_ALLOWED_SEARCH;
    case NOT_ALLOWED_USERNAME;
    case NOT_ALLOWED_NAME;
    case NOT_ALLOWED_SURNAME;
    case NOT_ALLOWED_PASSWORD;
    case NOT_MATCHED_PASSWORD;
    case NOT_EMAIL;
    case NOT_FORMATTED_PHONE;
    case NOT_ID;
    case NOT_SLUG;
    case NOT_OBJECT;

    case USER_NOT_FOUND;
    case WRONG_PASSWORD;
    case PASSWORD_LENGHT;
    case USER_EXIST;
    case USERNAME_EXIST;
    case PASSIVE_ACCOUNT;
    case BANNED;

    case CATEGORY_NOT_FOUND;
    case CODE_START_EXIST;
    case SLUG_EXIST;

    case PRODUCT_NOT_FOUND;

    case NOTHING_CHANGED;
    case UPDATE_FAILED;

    public function message(): string
    {
        return match ($this) {
            self::SUCCESS => 'Hata bulunamadı',
            self::NULL_OR_EMPTY_STRING => 'Null veya boş string',
            self::STRING_LENGHT_BETWEEN => 'Karakter sayısı belirtilen değerler arasında değil',
            self::LETTERS_WITHOUT_WHITESPACE => 'Yanlızca ingilizce karakter içerebilir',
            self::LETTERS_WITH_WHITESPACE => 'Yanlızca ingilizce karakter ve boşluk içerebilir',
            self::TR_LETTERS_WITH_WHITESPACE => 'Yanlızca türkçe karakter ve boşluk içerebilir',
            self::AUTH_TYPE_MISSING => 'Authentication type bulunamadı',
            self::FORM_PARAMETER_MISSING => 'Form parametreleri eksik',
            self::ID_MISSING => 'ID yok',

            self::NOT_ALLOWED_SEARCH => 'Arama istenilen biçimde değil',
            self::NOT_ALLOWED_USERNAME => 'Kullanıcı adı istenilen biçimde değil',
            self::NOT_ALLOWED_NAME => 'Ad istenilen biçimde değil',
            self::NOT_ALLOWED_SURNAME => 'Soyad istenilen biçimde değil',
            self::NOT_ALLOWED_PASSWORD => 'Şifre istenilen biçimde değil',
            self::NOT_MATCHED_PASSWORD => 'Şifreler uyuşmuyor',
            self::NOT_EMAIL => 'Mail standartları karşılamıyor',
            self::NOT_FORMATTED_PHONE => 'Telefon numarası istenilen standartları karşılamıyor',
            self::NOT_ID => 'ID değil',
            self::NOT_SLUG => 'Slug değil',
            self::NOT_OBJECT => 'Obje değil',

            self::USER_NOT_FOUND => 'Kullanıcı bulunamadı',
            self::WRONG_PASSWORD => 'Yanlış şifre',
            self::PASSWORD_LENGHT => 'Şifre uzunluğu istenilen biçimde değil',
            self::USER_EXIST => 'Girilen kullanıcı adı veya mail ile daha önce hesap oluşturulmuş',
            self::USERNAME_EXIST => 'Kullanıcı adı mevcut',
            self::PASSIVE_ACCOUNT => 'Pasif hesap',
            self::BANNED => 'Kullanıcı yasaklı',

            self::CATEGORY_NOT_FOUND => 'Kategori bulunamadı',
            self::CODE_START_EXIST => 'Ürün başlangıç kodu mevcut',
            self::SLUG_EXIST => 'Slug mevcut',

            self::PRODUCT_NOT_FOUND => 'Ürün bulunamadı',

            self::NOTHING_CHANGED => 'Değerler aynı olduğu için değişiklik yapılmadı',
            self::UPDATE_FAILED => 'Update false döndürdü'
        };
    }
}