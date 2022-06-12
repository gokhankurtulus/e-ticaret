<?php
session_start();
require_once "App/User.php";
if (isset($_REQUEST['lgnUsername']) && isset($_REQUEST['lgnPassword'])) {
    try {
        $userForLogin = new User();
        if ($userForLogin->login($_REQUEST['lgnUsername'], $_REQUEST['lgnPassword'])) {
            $_SESSION['login'] = $userForLogin->getID();
            $loginInfo = array("id" => $userForLogin->getID());
            echo json_encode($loginInfo);
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_REQUEST['rgsUsername']) && isset($_REQUEST['rgsPassword'])) {
    try {
        $userForRegister = new User();
        $userForRegister->setUsername = $_REQUEST['rgsUsername'];
        $userForRegister->setName = $_REQUEST['rgsName'];
        $userForRegister->setSurname = $_REQUEST['rgsSurname'];
        $userForRegister->setPassword = $_REQUEST['rgsPassword'];
        $userForRegister->setStatus = User;
        $userForRegister->setMail = $_REQUEST['rgsMail'];
        $userForRegister->setPhone = $_REQUEST['rgsPhone'];
        $userForRegister->setIdentity = $_REQUEST['rgsIdentity'];
        $userForRegister->setBirthDate = $_REQUEST['rgsBirth'];
        $userForRegister->parseBirthDate();
        $userForRegister->validateInputs();
        $registerResult = $userForRegister->register();
        if ($registerResult) {
            $registerInfo = array("id" => $registerResult);
            echo json_encode($registerInfo);
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}