<?php

namespace App\Controllers;

use App\Middleware\User\UserControlMiddleware;
use App\Middleware\User\CheckUsernameExist;
use App\Models\User;

class UserController extends Controller
{
    public static function create(array $attributes)
    {
        $user = User::create($attributes);
        return $user;
    }

    public static function get($where = [], $operator = 'AND')
    {
        $response = parent::middleware(UserControlMiddleware::class, $where);
        if ($response) {
            $user = User::get(where: $where, operator: $operator);
            return $user;
        } else {
            return false;
        }
    }

    public static function search($column, $search_text)
    {
        $result = User::search($column, $search_text);
        return $result;
    }

    public static function set(array $attributes, $where = [], $operator = "AND")
    {
        $user = User::get(where: $where);
        if ($user) {
            if (isset($attributes['username']) && isset($where['username']) && ($attributes['username'] != $user->getUsername())) {
                $exist = parent::middleware(CheckUsernameExist::class, $attributes);
                if (!$exist) {
                    $user = User::update(attributes: $attributes, where: $where, operator: $operator);
                    if ($user)
                        return $user;
                }
            }
        }
        return false;
    }

    public static function delete($where)
    {
        if (isset($where['id']) && preg_match("/^[0-9']*$/", $where['id'])) {
            User::delete($where);
            return true;
        }
        return false;
    }
}