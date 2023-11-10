<?php 

require 'functions.php';

$roles = $_POST['roles'] ?? '';
$kode_ref = array("admin" => "123456", "manajer" => "654321");
$errors = array();
$next = false;
$success = false;

if (isset($_POST['next'])) {
    $ref = $_POST['ref'];
    
    validateRef($errors, $ref, $roles, $kode_ref);

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }
    if (strlen($cek) == 0) {
        $next = true;
    }
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $nama = $_POST['nama'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $add = $_POST['address'] ?? '';

    if ($roles == 'admin' || $roles == 'manajer') {
        validateUsername($errors, $username);
        validatePassword($errors, $password);
        validateConfirmPassword($errors, $password, $password2);
    } else {
        validateUsername($errors, $username);
        validatePassword($errors, $password);
        validateConfirmPassword($errors, $password, $password2);
        validateNama($errors, $nama);
        validateTel($errors, $tel);
        validateAlamat($errors, $add);
    }

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }
    if (strlen($cek) == 0) {
        $success = true;
    }
}

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
        <form action="<?php echo $success ? "login.php" : "register2.php"?>" method="post">
            <h2>Register Now</h2>

            <!-- menampilkan inputan untuk admin dan manajer -->
            <?php if (isset($_POST['next']) && ($_POST['roles'] == "admin" || $_POST['roles'] == "manajer") && $next == true) {?>
                <div class="input-container">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $_POST["username"] ?? '' ?>">
                    <span class="error-msg"><?php echo $errors["username"] ?? '' ?></span>
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo $_POST["password"] ?? '' ?>">
                    <span class="error-msg"><?php echo $errors["password"] ?? '' ?></span>
                </div>
                <div class="input-container">
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" id="password2" name="password2" value="<?php echo $_POST["password2"] ?? '' ?>">
                    <span class="error-msg"><?php echo $errors["password2"] ?? '' ?></span>
                </div>
                <button type="submit" name="register">Register</button>

            <!-- menampilkan inputan untuk customer -->
            <?php } else if (isset($_POST['next']) && ($_POST['roles'] == "customer") && $next == true) { ?>
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
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" id="password2" name="password2">
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
                <button type="submit" name="register">Register</button>

            <!-- menampilkan inputan pilih role dan kode refferal -->
            <?php } else {?>
                <div class="input-container">
                    <label for="roles">Pilih Role</label>
                    <select name="roles" id="roles">
                        <option value="admin">Admin</option>
                        <option value="manajer" <?php echo (isset($_POST["roles"]) && $_POST["roles"] === "manajer") ? "selected" : ''?>>Manajer</option>
                        <option value="customer" <?php echo (isset($_POST["roles"]) && $_POST["roles"] === "customer") ? "selected" : ''?>>Customer</option>
                    </select>
                </div>
                <div class="input-container">
                    <label for="ref">Kode Refferal</label>
                    <input type="text" name="ref" id="ref" value="<?php echo $_POST["ref"] ?? '' ?>">
                    <span class="error-msg"><?php echo $errors["ref"] ?? '' ?></span>
                    <span class="roles-note">*isi jika memilih admin atau manajer</span>
                </div>
            <?php } ?>
            <button class="next" name="next" style="<?php echo $next ? 'display: none;' : ''; ?>">Selanjutnya</button>
        </form>
    </div>

</body>
</html>
