<?php
session_start();
require_once 'define.php';

require_once "App/User.php";
require_once "App/Product.php";

//$_SESSION['login'] = null;
try {
    if (isset($_SESSION['login']))
        var_dump($_SESSION);


} catch (Exception $ex) {
    echo $ex->getMessage();
}


?>