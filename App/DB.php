<?php

class DB {
    public function __construct()
    {
        $serverName = "localhost";
        $dbName = "antikahayalim";
        $dbUsername = "root";
        $dbPassword = "";
        $db = new PDO("mysql:host=$serverName;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword);
        $this->_db = $db;
    }
}