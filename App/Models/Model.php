<?php

namespace App\Models;

use App\Database\Builder;

abstract class Model
{

    protected abstract static function getTable();

    protected abstract static function getClass();

    /**
     * @param array $attributes
     * @param $lastInsertID
     * @param $fetch
     * @return array|false|mixed|object|\PDOStatement|string
     */
    public static function create(array $attributes, $lastInsertID = true, $fetch = 'fetch')
    {
        $columns = [];
        $values = [];
        foreach ($attributes as $column => $value) {
            $columns[] = $column;
            $values[] = $value;
        }
        $query = new Builder();
        $query->table = static::getTable();
        $result = $query->create()->columns(columns: $columns)->execute(params: $values, fetch: $fetch, lastInsertID: $lastInsertID);
        return $result;
    }

    /**
     * @param $where
     * @param $operator
     * @param $fetch
     * @return mixed
     */
    public static function get($where = [], $operator = "AND", $fetch = 'fetchAll'): mixed
    {
        $columns = [];
        $values = [];
        foreach ($where as $column => $value) {
            $columns[] = $column;
            $values[] = $value;
        }
        $query = new Builder();
        $query->table = static::getTable();
        if ($where != []) $result = $query->get()->where($columns, $operator)->execute(params: $values, fetch: $fetch);
        if ($where == []) $result = $query->get()->execute(fetch: $fetch);
        $result = self::loadFromResult($result);
        return $result;
    }

    /**
     * @param $result
     * @return mixed
     */
    public static function loadFromResult($result): mixed
    {
        if (count($result) == 1) {
            $newClass = new (static::getClass());
            $newClass->load($result[0]);
            return $newClass;
        }
        $classArray = [];
        if (count($result) > 1) {
            foreach ($result as $resource) {
                $newClass = new (static::getClass());
                $newClass->load($resource);
                $classArray[$newClass->getID()] = $newClass;
            }
            return $classArray;
        }
        return false;
    }

    /**
     * @param $column
     * @param $text
     * @return mixed
     */
    public static function search($column, $search_text): mixed
    {
        $query = new Builder();
        $query->table = static::getTable();
        $result = $query->search($column)->execute(params: [':search' => "+$search_text*"], fetch: 'fetchAll');
        $result = self::loadFromResult($result);
        return $result;
    }

    /**
     * @param array $identifier
     * @param array $where
     * @param string $operator
     * @return array|false|mixed|object|\PDOStatement
     */
    public static function update(array $attributes, array $where, $operator = "AND",): mixed
    {
        $settingColumns = [];
        $whereColumns = [];
        $values = [];
        foreach ($attributes as $column => $value) {
            $settingColumns[] = $column;
            $values[] = $value;
        }
        foreach ($where as $column => $value) {
            $whereColumns[] = $column;
            $values[] = $value;
        }
        $query = new Builder();
        $query->table = static::getTable();
        $result = $query->update()->columns($settingColumns)->where($whereColumns, $operator)->execute(params: $values)->rowCount();
        return $result;
    }

    /**
     * @param array $where
     * @return array|false|mixed|object|\PDOStatement
     */
    public static function delete(array $where): mixed
    {
        $query = new Builder();
        $query->table = static::getTable();
        $result = $query->delete()->where($where)->execute();
        return $result;
    }
}