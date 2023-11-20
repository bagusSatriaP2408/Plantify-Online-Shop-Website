<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

$title = "Profile";
require_once("../base.php");
require_once(BASEPATH."/app/templates/header.php");
$customer = getDataDiri($_SESSION['username']);


?>

<div class="produk">

    <div class="container">
        
    <div class=" card">
            <div class="caption">
                <h2>Nama : <?= $customer['nama']?></h2>
                <h2>Username : <?= $customer['username']?></h2>
                <h2>No Telp : <?= $customer['no_telepon']?></h2>
                <h2>Alamat : <?= $customer['alamat']?></h2>
                <a href="<?= BASEURL ?>/app/logout.php">
                    <div class="btn-card">Logout</div>
                </a>
                <a href="<?= BASEURL ?>/app/customer/edit_profile.php">
                    <div class="btn-card">Edit Profie</div>
                </a>
            </div>
        </div>
        </div>
        
        
    </div>
