<?php

namespace App\Providers;


class Functions
{
    public static function IsNullOrEmptyString($str): bool
    {
        return (is_null($str) || empty(trim($str)));
    }

    public static function isContainNumbers(string $str): bool
    {
        return (preg_match("/^[0-9]*$/", $str) && !self::IsNullOrEmptyString($str));
    }

    public static function isStringLenghtBetween(string $str, int $min, int $max): bool
    {
        return (strlen($str) >= $min && strlen($str) <= $max);
    }

    public static function isLettersWithoutWhitespace($str): bool
    {
        return (preg_match("/^[a-zA-Z]*$/", $str) && !self::IsNullOrEmptyString($str) && is_string($str));
    }

    public static function isLettersWithWhitespace($str): bool
    {
        return (preg_match("/^[a-zA-Z ]*$/", $str) && !self::IsNullOrEmptyString($str) && is_string($str));
    }

    public static function isTurkishLettersWithWhitespace($str): bool
    {
        return (preg_match("/^[a-zA-ZığüşöçİĞÜŞÖÇ ]*$/", $str) && !self::IsNullOrEmptyString($str) && is_string($str));
    }

    public static function isEmail($str): bool
    {
        return (filter_var($str, FILTER_VALIDATE_EMAIL) && !self::IsNullOrEmptyString($str) && is_string($str));
    }

    public static function isFormattedPhone($str): bool
    {
        return (preg_match("/^\([0-9]{3}\) [0-9]{3} - [0-9]{4}$/", $str) && !self::IsNullOrEmptyString($str) && is_string($str));
    }

    public static function isAllowedPassword($str)
    {
        return (preg_match("/^[\w!@#$%&*()=+.{}-]*$/", $str) && !self::IsNullOrEmptyString($str) && is_string($str));
    }

    public static function isPasswordsMatch(string $password, string $passwordCheck)
    {
        return ($password === $passwordCheck);
    }

    public static function isAllowedSearch($str): bool
    {
        return (preg_match("/^[a-zA-ZığüşöçİĞÜŞÖÇ'\" ]*$/", $str) && !self::IsNullOrEmptyString($str) && is_string($str));
    }

    public static function isAllowedSlug($str): bool
    {
        return (preg_match("/^[a-zA-Z0-9-]*$/", $str) && !self::IsNullOrEmptyString($str) && is_string($str));
    }

    public static function createSlug(string $str, $delimiter = '-'): string
    {
        $turkish = array("ı", "İ", "ğ", "Ğ", "ü", "Ü", "ş", "Ş", "ö", "Ö", "ç", "Ç");
        $english = array("i", "I", "g", "G", "u", "U", "s", "S", "o", "O", "c", "C");
        $str = str_replace($turkish, $english, $str);
        $str = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $str;
    }

    public static function generateProductCode($code_start)
    {
        return $code_start . '-' . rand(100000, 999999);
    }

    public static function showDiscount($discount, $type)
    {
        return $type . $discount;
    }

    public static function showPrice($money_str, $type)
    {
        return number_format($money_str, 2, ',', '.') . ' ' . $type;
    }
}