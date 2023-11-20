<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

require_once($_SERVER['DOCUMENT_ROOT']."/TA-tes/app/base.php");
require_once(BASEPATH . "/app/database.php");
require_once(BASEPATH.'/app/validations.php');
// mendapatkan data diri customer
$customer = getDataDiri($_SESSION['username']);

if (isset($_POST['register'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $tel = htmlspecialchars($_POST['tel']);
    $add = htmlspecialchars($_POST['address']);
    validateNama($errors, $nama);
    validateTel($errors, $tel);
    validateAlamat($errors, $add);
    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {
        try{

            $stat = DB->prepare("UPDATE customer SET nama=:nama, no_telepon=:no_telepon ,alamat=:alamat WHERE username=:username");
            $stat->bindValue(':nama',$nama);
            $stat->bindValue(':no_telepon',$tel);
            $stat->bindValue(':alamat',$add);
            $stat->bindValue(':username',$_SESSION['username']);
            $stat->execute();
		    header("Location: profile.php");
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/styles/style.css">
</head>
<body>    
    <div class="form-container">
        <form action="edit_profile.php" method="post">
            <div class="input-container">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= $_POST["nama"] ?? $customer['nama'] ?>">
                <span class="error-msg"><?= $errors["nama"] ?? '' ?></span>
            </div>
            <div class="input-container">
                <label for="tel">Nomor Telepon</label>
                <input type="text" id="tel" name="tel" value="<?= $_POST["tel"] ?? $customer['no_telepon'] ?>">
                <span class="error-msg"><?= $errors["tel"] ?? '' ?></span>
            </div>
            <div class="input-container">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" rows="1"><?= $_POST["address"] ?? $customer['alamat'] ?></textarea>
                <span class="error-msg"><?= $errors["address"] ?? '' ?></span>
            </div>
            <a href="profile.php" class="btn">Batal</a>
            <button type="submit" name="register">Edit</button>    
        </form>
    </div>
</body>
</html>