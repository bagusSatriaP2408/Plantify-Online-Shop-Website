<?php 

require 'functions.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/styles/style.css">
</head>
<body>
    
    <div class="form-container">
        <form action="register.php" method="post">
            <h2>Register Now</h2>
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
                <span class="error-msg">errormsg</span>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <span class="error-msg">errormsg</span>
            </div>
            <div class="input-container">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama">
                <span class="error-msg">errormsg</span>
            </div>
            <div class="input-container">
                <label for="tel">Nomor Telepon</label>
                <input type="text" id="tel" name="tel">
                <span class="error-msg">errormsg</span>
            </div>
            <div class="input-container">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" rows="1"></textarea>
                <span class="error-msg">errormsg</span>
            </div>
            <div class="input-container">
                <label for="role">Pilih Role</label>
                <select name="role" id="role">
                    <option value="admin">Admin</option>
                    <option value="manajer">Manajer</option>
                    <option value="customer">Customer</option>
                </select>
                <span class="error-msg">errormsg</span>
            </div>
            <div class="input-container">
                <label for="ref">Kode Refferal</label>
                <input type="text" name="ref" id="ref">
                <span class="error-msg">errormsg</span>
                <span class="role-note">*isi jika memilih admin atau manajer</span>
            </div>
            <button type="submit" name="login">Register</button>
        </form>
    </div>

</body>
</html>
