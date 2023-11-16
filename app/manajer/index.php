<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}
require_once('../base.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/styles/style_manajer.css" />
</head>
<body>
    <div class="header">
        <div class="profile">
            <img class="pfl" src="<?= BASEURL ?>/assets/img/icon-profile.png" alt="profile">
        </div>
        <div class="logo">
            <img src="logo.png" alt="logo">
        </div>
        <div class="search">
            <img class="src" src="search.png" alt="search">
        </div>
    </div>
    <div class="grafik">
        GRAFIK
    </div>
    <div class="rekap">
        <table border="1" class="table" width="1000">
            <tr>
                <td>No.</td>
                <td>Nama</td>
                <td>Keterangan</td>
            </tr>
            <tr>
                <td>p</td>
                <td>p</td>
                <td>p</td>
            </tr>
            <tr>
                <td>p</td>
                <td>p</td>
                <td>p</td>
            </tr>
            <tr>
                <td>p</td>
                <td>p</td>
                <td>p</td>
            </tr>
            <tr>
                <td>p</td>
                <td>p</td>
                <td>p</td>
            </tr>
        </table>
    </div>
    <a href="<?= BASEURL ?>/app/logout.php">logout</a>
</body>
</html>