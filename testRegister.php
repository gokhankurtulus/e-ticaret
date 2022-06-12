<link rel="stylesheet" href="assets/css/jquery-ui.css">
<form id="registerForm" name="register" method="post">
    <input type="text" name="rgsUsername" onkeypress="blockChars(this);" pattern=".{6,20}" title="6-20 karakter arasında olmalı"
           autocomplete="off"
           placeholder="Kullanıcı Adı" required>
    <input type="text" name="rgsName" onkeypress="blockChars(this,'tr');" pattern=".{2,20}" title="2-20 karakter arasında olmalı"
           autocomplete="off"
           placeholder="Ad" required>
    <input type="text" name="rgsSurname" onkeypress="blockChars(this, 'tr');" pattern=".{2,20}" title="1-20 karakter arasında olmalı"
           autocomplete="off"
           placeholder="Soyad" required>
    <input type="text" name="rgsIdentity" minlength="11" maxlength="11" pattern="[0-9]{11}" title="11 sayıdan oluşmalı"
           autocomplete="off"
           placeholder="TC Kimlik" required>
    <input type="email" pattern="[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+).*" name="rgsMail" autocomplete="off"
           placeholder="E-mail" required>
    <input type="password" name="rgsPassword" onkeypress="blockChars(this);" pattern=".{6,20}" title="6-20 karakter arasında olmalı"
           autocomplete="off"
           placeholder="Şifre" required>
    <input type="tel" id="phoneNumber" name="rgsPhone" onkeypress="blockChars(this, 'phone');" minlength="16" maxlength="16" title="16 karakter olmalı"
           autocomplete="off"
           placeholder="Telefon (123) 456 - 7890" required>
    <input type="text" id="datepicker" name="rgsBirth" autocomplete="off" placeholder="Doğum Günü" required>
    <input type="checkbox" id="_checkbox" value="1" required>
    <label for="_checkbox"><a target="_blank" href="terms">Kullanıcı sözleşmesini okudum, onaylıyorum</a></label>
    <input type="submit" name="rgs" value="Üye Ol">
</form>
<p id="successMsg" style="display: none;"></p>
<p id="errorMsg" style="display: none;"></p>
<img id="loader" style="display: none;" src="assets/css/ajax-loader.gif">
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="assets/js/login.js"></script>
