<?php
session_start();
require_once "App/User.php";
if (isset($_REQUEST['lgnUsername']) && isset($_REQUEST['lgnPassword'])) {
    $userForLogin = new User();
    if ($userForLogin->login($_REQUEST['lgnUsername'], $_REQUEST['lgnPassword'])) {
        $_SESSION['login'] = $userForLogin->getID();
        echo $userForLogin->getID();
    }
}