<?php
require_once "App/User.php";
session_start();
//unset($_SESSION['login']);
if (isset($_SESSION['login'])):
    $loginedUser = new User();
    $loginedUser->load($_SESSION['login']);
    echo '
    <pre>';
    print_r($loginedUser);
    echo '</pre>';
else: ?>
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <form id="loginForm" name="login" method="post">
        <input type="text" name="lgnUsername" onkeypress="blockChars(this);" pattern=".{6,20}" title="6-20 karakter arasında olmalı" autocomplete="off"
               placeholder="Kullanıcı Adı" required>
        <input type="text" name="lgnPassword" onkeypress="blockChars(this,'pw');" pattern=".{6,20}" title="6-20 karakter arasında olmalı"
               autocomplete="off"
               placeholder="Şifre" required>
        <input type="submit" name="lgn" value="Giriş Yap">
    </form>
    <p id="successMsg" style="display: none;"></p>
    <p id="errorMsg" style="display: none;"></p>
    <img id="loader" style="display: none;" src="assets/css/ajax-loader.gif">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/login.js"></script>
<?php
endif;
?>
