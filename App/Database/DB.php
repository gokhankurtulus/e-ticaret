<?php

namespace App\Database;
class DB {
    public function __construct()
    {
        $serverName = "localhost";
        $dbName = "xxx";
        $dbUsername = "xxx";
        $dbPassword = "xxx";
        $db = new \PDO("mysql:host=$serverName;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword);
        $this->_db = $db;
    }
}