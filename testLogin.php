<?php
session_start();
if (isset($_SESSION))
    var_dump($_SESSION);
?>
<form id="loginForm" name="login" method="post">
    <input type="text" name="lgnUsername" onkeypress="blockChars(this);" pattern=".{6,20}" title="6-20 karakter arasında olmalı" autocomplete="off"
           placeholder="Kullanıcı Adı" required>
    <input type="text" name="lgnPassword" onkeypress="blockChars(this,'pw');" pattern=".{6,20}" title="6-20 karakter arasında olmalı"
           autocomplete="off"
           placeholder="Şifre" required>
    <input type="submit" name="lgn" value="Giriş Yap">
</form>
<img id="loader" style="display: none;" src="assets/img/ajax-loader.gif">
<script src="assets/js/jquery.js"></script>
<script src="assets/js/login.js"></script>
