<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../../assets/styles/style_admin.css" />
</head>
<body>
    <div class="khusus">
        <div class="kiri">
            <div>
                <img class="logo" src="logo.png" alt="logo">
            </div>
            <div class="profile">
                <img src="profile.png" alt="profile">
                <h3>Admin</h3>
            </div>
            <div class="dashboard"><h3>Dashboard</h3></div>
            <div class="infoakun"><h3>Info Akun</h3></div>
            <div class="infobarang"><h3>Info Barang</h3></div>    
            <div class="transaksi"><h3>Info Transaksi</h3></div>
        </div>
        <div class="kanan">

        </div>
    </div>
</body>
</html>