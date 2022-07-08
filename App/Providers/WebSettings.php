<?php

namespace App\Providers;

enum WebSettings
{
    case HOME;
    case MENU;
    case BASKET;
    case PANEL;

    case ACCOUNT;
    case LOGIN;
    case REGISTER;
    case FORGOT_PASSWORD;
    case LOGOUT;

    case USERNAME;
    case USERNAME_LONG;
    case USERNAME_ALLOWED_CHARS;
    case NAME;
    case NAME_LONG;
    case SURNAME;
    case SURNAME_LONG;
    case EMAIL;
    case PASSWORD;
    case PASSWORD_CHECK;
    case PASSWORD_LONG;
    case PASSWORD_ALLOWED_CHARS;
    case PHONE;
    case AGREE_TEXT;

    case SEARCH;
    case PROFILE;
    case SETTINGS;

    case SUBSCRIBE;
    case SUBSCRIBE_MESSAGE;

    case CHANGE_LANGUAGE;

    case HELP;
    case FAQ;
    case REFUND;
    case PAYMENT;

    case ABOUT_US;
    case PARTNERS;
    case STORES;
    case CAREER;
    case CONTACT;

    case POLICIES;
    case PRIVACY;
    case COOKIES;
    case AGREEMENT;

    public function name($language = 'tr')
    {
        if (in_array($language, $GLOBALS['allowed_languages'])) {
            $usernameMinChar = UserSettings::UsernameMinChar;
            $usernameMaxChar = UserSettings::UsernameMaxChar;
            $passwordMinChar = UserSettings::PasswordMinChar;
            $passwordMaxChar = UserSettings::PasswordMaxChar;
            $nameMinChar = UserSettings::NameMinChar;
            $nameMaxChar = UserSettings::NameMaxChar;
            $surnameMinChar = UserSettings::SurnameMinChar;
            $surnameMaxChar = UserSettings::SurnameMaxChar;
            if ($language === 'tr') {
                return match ($this) {
                    self::HOME => 'Anasayfa',
                    self::MENU => 'Menü',
                    self::BASKET => 'Sepet',
                    self::PANEL => 'Panel',

                    self::ACCOUNT => 'Hesap',
                    self::LOGIN => 'Giriş Yap',
                    self::REGISTER => 'Hesap Oluştur',
                    self::FORGOT_PASSWORD => 'Şifremi Unuttum',
                    self::LOGOUT => 'Çıkış Yap',

                    self::USERNAME => 'Kullanıcı Adı',
                    self::USERNAME_LONG =>  "$usernameMinChar-$usernameMaxChar karakter uzunluğunda",
                    self::USERNAME_ALLOWED_CHARS =>  "a-Z karakterler",
                    self::NAME => 'Ad',
                    self::NAME_LONG =>  "$nameMinChar-$nameMaxChar karakter uzunluğunda",
                    self::SURNAME => 'Soyad',
                    self::SURNAME_LONG =>  "$surnameMinChar-$surnameMaxChar karakter uzunluğunda",
                    self::EMAIL => 'E-mail',
                    self::PASSWORD => 'Şifre',
                    self::PASSWORD_CHECK => 'Şifre Kontrol',
                    self::PASSWORD_LONG =>  "$passwordMinChar-$passwordMaxChar karakter uzunluğunda",
                    self::PASSWORD_ALLOWED_CHARS =>  "a-Z, 0-9, !@#$%&*()=+.{}- karakterler",
                    self::PHONE =>  "Telefon",
                    self::AGREE_TEXT => 'Hesap Oluştur\'a tıklayarak Koşullarımızı, Veri Politikamızı ve Çerez Politikamızı kabul etmiş olursunuz. Bizden SMS bildirimleri alabilir ve istediğiniz zaman vazgeçebilirsiniz.',

                    self::SEARCH => 'Ara',
                    self::PROFILE => 'Profil',
                    self::SETTINGS => 'Ayarlar',

                    self::SUBSCRIBE => 'Abone Ol',
                    self::SUBSCRIBE_MESSAGE => 'Bültene abone olarak en yeni ürünler, indirimler ve fırsatlardan ilk siz haberdar olabilirsiniz.',
                    self::CHANGE_LANGUAGE => 'Dili Değiştir',

                    self::HELP => 'Yardım',
                    self::FAQ => 'Sıkça Sorulan Sorular',
                    self::REFUND => 'İade ve Değişim',
                    self::PAYMENT => 'Ödeme',

                    self::ABOUT_US => 'Hakkımızda',
                    self::PARTNERS => 'İş Ortaklarımız',
                    self::STORES => 'Mağazalar',
                    self::CAREER => 'Kariyer',
                    self::CONTACT => 'İletişim',

                    self::POLICIES => 'Politikalar',
                    self::PRIVACY => "Veri Gizliliği ve Güvenliği",
                    self::COOKIES => "Çerezler",
                    self::AGREEMENT => "Mesafeli Satış Sözleşmesi",
                };
            } else if ($language === 'en') {
                return match ($this) {
                    self::HOME => 'Home',
                    self::MENU => 'Menu',
                    self::BASKET => 'Basket',
                    self::PANEL => 'Panel',

                    self::ACCOUNT => 'Account',
                    self::LOGIN => 'Sign In',
                    self::REGISTER => 'Create Account',
                    self::FORGOT_PASSWORD => 'Forgot Password',
                    self::LOGOUT => 'Sign Out',

                    self::USERNAME => 'Username',
                    self::USERNAME_LONG =>  "$usernameMinChar-$usernameMaxChar character length",
                    self::USERNAME_ALLOWED_CHARS =>  "a-Z characters",
                    self::NAME => 'Name',
                    self::NAME_LONG =>  "$nameMinChar-$nameMaxChar character length",
                    self::SURNAME => 'Surname',
                    self::SURNAME_LONG =>  "$surnameMinChar-$surnameMaxChar character length",
                    self::EMAIL => 'E-mail',
                    self::PASSWORD => 'Password',
                    self::PASSWORD_CHECK => 'Password Check',
                    self::PASSWORD_LONG =>  "$passwordMinChar-$passwordMaxChar character length",
                    self::PASSWORD_ALLOWED_CHARS =>  "a-Z, 0-9, !@#$%&*()=+.{}- characters",
                    self::PHONE =>  "Mobile",
                    self::AGREE_TEXT => 'By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy. You may receive SMS notifications from us and can opt out at any time.',

                    self::SEARCH => 'Search',
                    self::PROFILE => 'Profile',
                    self::SETTINGS => 'Settings',

                    self::SUBSCRIBE => 'Subscribe',
                    self::SUBSCRIBE_MESSAGE => 'By subscribing to the newsletter, you can be the first to know about the latest products, discounts and opportunities.',
                    self::CHANGE_LANGUAGE => 'Change Language',

                    self::HELP => 'Help',
                    self::FAQ => 'FAQ',
                    self::REFUND => 'Refund',
                    self::PAYMENT => 'Payment',

                    self::ABOUT_US => 'About Us',
                    self::PARTNERS => 'Partners',
                    self::STORES => 'Stores',
                    self::CAREER => 'Career',
                    self::CONTACT => 'Contact',

                    self::POLICIES => 'Policies',
                    self::PRIVACY => "Privacy Policy",
                    self::COOKIES => "Cookies",
                    self::AGREEMENT => "Distance Sales Agreement",
                };
            } else if ($language === 'ru') {

                return match ($this) {

                    self::HOME => 'домашняя страница',
                    self::MENU => 'Меню',
                    self::BASKET => 'Корзина',
                    self::PANEL => 'Панель',

                    self::ACCOUNT => 'аккаунте',
                    self::LOGIN => 'авторизоваться',
                    self::REGISTER => 'Зарегистрироваться',
                    self::FORGOT_PASSWORD => 'Забыл пароль',
                    self::LOGOUT => 'выйти',

                    self::USERNAME => 'Имя пользователя',
                    self::USERNAME_LONG =>  "$usernameMinChar-$usernameMaxChar длина символа",
                    self::USERNAME_ALLOWED_CHARS =>  "a-Z персонажи",
                    self::NAME => 'Имя',
                    self::NAME_LONG =>  "$surnameMinChar-$surnameMaxChar длина символа",
                    self::SURNAME => 'Фамилия',
                    self::SURNAME_LONG =>  "$surnameMinChar-$surnameMaxChar длина символа",
                    self::EMAIL => 'Эл. адрес',
                    self::PASSWORD => 'Пароль',
                    self::PASSWORD_CHECK => 'Проверка пароля',
                    self::PASSWORD_LONG =>  "$passwordMinChar-$passwordMaxChar длина символа",
                    self::PASSWORD_ALLOWED_CHARS =>  "a-Z, 0-9, !@#$%&*()=+.{}- персонажи",
                    self::PHONE =>  "Телефон",
                    self::AGREE_TEXT => 'Нажимая «Зарегистрироваться», вы соглашаетесь с нашими Условиями, Политикой данных и Политикой использования файлов cookie. Вы можете получать от нас SMS-уведомления и в любой момент можете отказаться от них.',

                    self::SEARCH => 'Поиск',
                    self::PROFILE => 'Профиль',
                    self::SETTINGS => 'Настройки',

                    self::SUBSCRIBE => 'Подписывайся',
                    self::SUBSCRIBE_MESSAGE => 'Подписавшись на рассылку, вы сможете первыми узнавать о новинках, скидках и возможностях.',
                    self::CHANGE_LANGUAGE => 'Изменить язык',

                    self::HELP => 'Помощь',
                    self::FAQ => 'Часто задаваемые вопросы',
                    self::REFUND => 'Возврат',
                    self::PAYMENT => 'Оплата',

                    self::ABOUT_US => 'О нас',
                    self::PARTNERS => 'Партнеры',
                    self::STORES => 'магазины',
                    self::CAREER => 'карьера',
                    self::CONTACT => 'контакт',

                    self::POLICIES => 'политика',
                    self::PRIVACY => "Политика конфиденциальности",
                    self::COOKIES => "печенье",
                    self::AGREEMENT => "Соглашение о дистанционной продаже",
                };
            }
        }
        return $this->name($GLOBALS['default_language']);
    }
}