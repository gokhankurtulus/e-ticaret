<?php

namespace App\Database;

use PDO;

class Builder extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    const CREATE = 1;
    const GET = 2;
    const SEARCH = 3;
    const UPDATE = 4;
    const DELETE = 5;

    public $query;
    public $pdo;
    public $table;
    public $operation;

    public function create()
    {
        $this->operation = self::CREATE;
        $this->query .= "INSERT INTO $this->table ";
        return $this;
    }

    public function get($keywords = "*")
    {
        $this->operation = self::GET;
        $this->query .= "SELECT $keywords FROM $this->table";
        return $this;
    }

    public function search($column)
    {
        $this->operation = self::SEARCH;
        $this->query .= "SELECT * FROM $this->table WHERE MATCH(`$column`) AGAINST(:search IN BOOLEAN MODE)";
        return $this;
    }

    public function update()
    {
        $this->operation = self::UPDATE;
        $this->query .= "UPDATE $this->table  SET ";
        return $this;
    }

    public function columns(array $columns)
    {
        if ($this->operation == self::CREATE) {
            $cols = "";
            $questionMarks = "";
            foreach ($columns as $column) {
                $cols .= $column != end($columns) ? "$column," : "$column";
                $questionMarks .= $column != end($columns) ? "?," : "?";
            }
            $this->query .= "($cols) VALUES ($questionMarks)";
        }
        if ($this->operation == self::UPDATE) {
            foreach ($columns as $column)
                $this->query .= $column != end($columns) ? "$column = ?," : "$column = ?";
        }
        return $this;
    }

    public function delete()
    {
        $this->operation = self::DELETE;
        $this->query .= "DELETE FROM $this->table";
        return $this;
    }

    public function where($where = [], $operator = "AND")
    {
        if ($where != []) {
            $this->query .= " WHERE";
            $identifierElements = "";
            foreach ($where as $key => $value)
                $value != end($where) ? $identifierElements .= " $key = '$value' $operator" : $identifierElements .= " $key = '$value'";
            $this->query .= $identifierElements;
        }
        return $this;
    }


    public function execute($params = [], $fetch = null, $lastInsertID = false)
    {
        $this->pdo = $this->_db->prepare($this->query);
        $this->pdo->execute($params);
        if ($fetch == "fetch")
            $this->pdo = $this->pdo->fetch();
        if ($fetch == "fetchAll")
            $this->pdo = $this->pdo->fetchAll();
        if ($fetch == "fetchObject")
            $this->pdo = $this->pdo->fetchObject();
        return !$lastInsertID ? $this->pdo : $this->_db->lastInsertId();
    }

    public function lastInsertId()
    {
    }

}