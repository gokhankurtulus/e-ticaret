<?php
session_start();
require_once 'define.php';

require_once "App/User.php";
require_once "App/Product.php";

//$_SESSION['login'] = null;
try {
 var_dump($_SESSION);
    /*$user = new User();

    $test = $user->getUsersWithSearch("test");

    echo '<pre>';
    var_dump($test);
    echo '</pre>';
    echo $test[23]->getUsername();*/
    $productClass = new Product();
    $user = new User();
    /*
    $product->loadProductWithUrl('timeless-unisex-basic-oversize-t-shirt-bs-859728');
    echo '<pre>';
    print_r($product);
    echo '</pre>';
    echo $product->createSlug($product->getName() . "-" . $product->getCode());*/

} catch (Exception $ex) {
    echo $ex->getMessage();
}


?>

<form id="loginForm" name="login" method="post">
    <input type="text" name="lgnUsername" onkeypress="blockChars(this);" pattern=".{6,20}" title="6-20 karakter arasında olmalı" autocomplete="off"
           placeholder="Kullanıcı Adı" required>
    <input type="password" name="lgnPassword" onkeypress="blockChars(this);" pattern=".{6,20}" title="6-20 karakter arasında olmalı"
           autocomplete="off"
           placeholder="Şifre" required>
    <input type="submit" name="lgn" value="Giriş Yap">
</form>
<img id="loader" style="display: none;" src="assets/img/ajax-loader.gif">
<script src="assets/js/jquery.js"></script>
<script src="assets/js/login.js"></script>

