<?php

namespace App\Controllers\User;

use App\Providers\Functions;
use App\Controllers\{Controller};
use App\Middleware\{User\GetUserMiddleware, User\CheckUsernameExist};
use App\Models\User;
use App\Providers\Error;

class UserController extends Controller
{
    public static function create(array $attributes)
    {
        $user = User::create($attributes);
        return $user;
    }

    public static function get($where = [], $operator = 'AND')
    {
        $response = self::middleware(GetUserMiddleware::class, $where);
        if ($response === Error::SUCCESS) {
            $user = User::get(where: $where, operator: $operator);
            if (isset($user) && is_object($user))
                return $user;
            else
                return Error::USER_NOT_FOUND;
        } else
            return $response;
    }

    public static function getAll($where = [], $operator = 'AND')
    {
        $response = self::middleware(GetUserMiddleware::class, $where);
        if ($response === Error::SUCCESS) {
            $user = User::getAll(where: $where, operator: $operator);
            if (isset($user) && is_object($user))
                return $user;
            else
                return Error::USER_NOT_FOUND;
        } else
            return $response;
    }

    public static function search($column, $search_text)
    {
        if (!Functions::isLettersWithWhitespace($column))
            return Error::LETTERS_WITH_WHITESPACE;
        if (!Functions::isAllowedSearch($search_text))
            return Error::NOT_ALLOWED_SEARCH;
        $result = User::search($column, $search_text);
        return $result;
    }

    public static function update(array $attributes, $where = [], $operator = "AND")
    {
        $getUser = self::get(where: $where);
        if (!is_a($getUser, Error::class)) {
            if (isset($attributes['username']) && $attributes['username'] != $getUser->getUsername())
                if (self::middleware(CheckUsernameExist::class, $attributes) === Error::USERNAME_EXIST) return Error::USERNAME_EXIST;
            $updatingUser = $getUser->update(attributes: $attributes, where: $where, operator: $operator);
            if ($updatingUser)
                return $updatingUser;
            if (!$updatingUser)
                return Error::NOTHING_CHANGED;
        } else
            return $getUser;
        return Error::UPDATE_FAILED;
    }

    public static function delete($where)
    {
        $response = self::middleware(GetUserMiddleware::class, $where);
        if ($response === Error::SUCCESS) {
            User::delete($where);
            return $where['id'];
        } else
            return $response;
    }
}