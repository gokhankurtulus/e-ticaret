<?php

namespace App\Models;

use App\Database\Builder;

abstract class Model
{

    protected abstract static function getTable();

    protected abstract static function getClass();


    /**
     * @param $where
     * @param $operator
     * @param $fetch
     * @return mixed
     */
    public static function get($where = [], $operator = "AND", $fetch = 'fetchAll'): mixed
    {
        $query = new Builder();
        $query->table = static::getTable();
        if ($where != []) $result = $query->get()->where($where, $operator)->execute(fetch: $fetch);
        if ($where == []) $result = $query->get()->execute(fetch: $fetch);
        $result = self::loadFromResult($result);
        return $result;
    }

    /**
     * @param $column
     * @param $text
     * @return mixed
     */
    public static function search($column, $search_text)
    {
        $query = new Builder();
        $query->table = static::getTable();
        $result = $query->search($column)->execute(params: [':search' => "+$search_text*"], fetch: 'fetchAll');
        $result = self::loadFromResult($result);
        return $result;
    }

    /**
     * @param $result
     * @return mixed
     */
    public static function loadFromResult($result): mixed
    {
        $classArray = [];
        if (count($result) > 1) {
            foreach ($result as $resource) {
                $newClass = new (static::getClass());
                $newClass->load($resource);
                $classArray[$newClass->getID()] = $newClass;
            }
            return $classArray;
        }
        if (count($result) == 1) {
            $newClass = new (static::getClass());
            $newClass->load($result[0]);
            return $newClass;
        }
        return false;
    }

    /**
     * @param $identifier
     * @param $where
     * @param $operator
     * @return array|false|mixed|object|\PDOStatement
     */
    public static function set($identifier, $where = [], $operator = "AND",)
    {
        $columns = [];
        $values = [];
        foreach ($identifier as $column => $value) {
            array_push($columns, $column);
            array_push($values, $value);
        }
        $query = new Builder();
        $query->table = static::getTable();
        $result = $query->update()->columns($columns)->where($where, $operator)->execute(params: $values);
        return $result;
    }

    /**
     * @param $where
     * @return array|false|mixed|object|\PDOStatement
     */
    public static function delete($where)
    {
        $query = new Builder();
        $query->table = static::getTable();
        $result = $query->delete()->where($where)->execute();
        return $result;
    }
}