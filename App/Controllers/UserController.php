<?php

namespace App\Controllers;

use App\Middleware\User\UserControlMiddleware;
use App\Middleware\User\CheckUsernameExist;
use App\Models\User;

class UserController extends Controller
{

    public static function get($where = [])
    {
        $response = parent::middleware(UserControlMiddleware::class, $where);
        if ($response) {
            $user = User::get(where: $where);
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

    public static function set($identifier, $where = [], $operator = "AND",)
    {
        $user = User::get(where: $where);
        if ($user) {
            if (isset($identifier['username']) && isset($where['username']) && ($identifier['username'] != $user->getUsername())) {
                $exist = parent::middleware(CheckUsernameExist::class, $identifier);
                if (!$exist) {
                    $user = User::set(identifier: $identifier, where: $where, operator: $operator);
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