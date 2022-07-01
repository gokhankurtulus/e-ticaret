<?php

namespace App\Database;

use PDO;

class Builder extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public $query;
    public $pdo;
    public $table;

    public function get($keywords = "*")
    {
        $this->query .= "SELECT $keywords FROM $this->table";
        return $this;
    }

    public function update()
    {
        $this->query .= "UPDATE $this->table";
        return $this;
    }

    public function columns($columns)
    {
        $cols = "";
        foreach ($columns as $key => $value)
            $value != end($columns) ? $cols .= " $value = ?," : $cols .= " $value = ?";
        $this->query .= ' SET ' . $cols;
        return $this;
    }

    public function delete()
    {
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

    public function search($column)
    {
        $this->query .= "SELECT * FROM $this->table WHERE MATCH(`$column`) AGAINST(:search IN BOOLEAN MODE)";
        return $this;
    }

    public function execute($params = [], $fetch = null)
    {
        $this->pdo = $this->_db->prepare($this->query);
        $this->pdo->execute($params);
        if ($fetch == "fetch")
            $this->pdo = $this->pdo->fetch();
        if ($fetch == "fetchAll")
            $this->pdo = $this->pdo->fetchAll();
        if ($fetch == "fetchObject")
            $this->pdo = $this->pdo->fetchObject();
        return $this->pdo;
    }

}