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
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/styles/style_manajer.css" />
</head>
<body>

    <div class="sidebar">
        <div class="profil">
            <img src="<?= BASEURL ?>/assets/img/icon-profile.png" alt="profil">
            <div class="manajer">
                <span>Manajer</span>
                <p><?= $_SESSION['username']; ?></p>
            </div>
        </div>
        <div class="menu-container">
            <menu>
                <a href="<?= BASEURL ?>/app/manajer/index.php" class="<?= $title === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="<?= BASEURL ?>/app/manajer/rekap.php" class="<?= $title === 'Rekap' ? 'active' : '' ?>">Rekap</a>
                <a href="<?= BASEURL ?>/app/manajer/grafik.php" class="<?= $title === 'Grafik' ? 'active' : '' ?>">Grafik</a>
            </menu>
        </div>
        <a href="<?= BASEURL ?>/app/logout.php">Logout</a>
    </div>