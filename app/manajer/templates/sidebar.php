<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/TA-tes/app/base.php");
require_once(BASEPATH . "/app/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager | <?= $title ?></title>
    <link rel="stylesheet" href="<?= BASEURL ?>/app/assets/styles/style_manajer.css" />
</head>
<body>

    <div class="sidebar">
        <div class="profil">
            <img src="<?= BASEURL ?>/app/assets/img/icon-profile.png" alt="profil">
            <div class="manajer">
                <span>Manajer</span>
                <p><?= $_SESSION['username']; ?></p>
            </div>
        </div>
        <div class="menu-container">
            <menu>
                <a href="<?= BASEURL ?>/app/manajer/index.php" class="<?= $title === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="<?= BASEURL ?>/app/manajer/belum_bayar.php" class="<?= $title === 'Belum Bayar' ? 'active' : '' ?>">Belum Bayar</a>
                <a href="<?= BASEURL ?>/app/manajer/sudah_bayar.php" class="<?= $title === 'Sudah Bayar' ? 'active' : '' ?>">Sudah Bayar</a>
            </menu>
        </div>
        <a href="<?= BASEURL ?>/app/logout.php">Logout</a>
    </div>