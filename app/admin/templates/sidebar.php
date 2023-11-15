<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/TA-tes/app/base.php");
require_once(BASEPATH . "/app/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | <?= $title ?></title>
    <link rel="stylesheet" href="<?= BASEURL ;?>/assets/styles/style_admin.css" />
</head>
<body>
    
    <!-- Start Sidebar -->
    <div class="sidebar">
        <img class="logo" src="<?= BASEURL ;?>/assets/img/logo.png" alt="logo" />
        <div class="menu-container">
            <menu>
                <a href="<?= BASEURL ?>/app/admin/index.php" class="<?= $title === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="<?= BASEURL ?>/app/admin/produk.php" class="<?= $title === 'Produk' ? 'active' : '' ?>">Produk</a>
                <a href="<?= BASEURL ?>/app/admin/supplier.php" class="<?= $title === 'Supplier' ? 'active' : '' ?>">Supplier</a>
                <a href="<?= BASEURL ?>/app/admin/customer.php" class="<?= $title === 'Customer' ? 'active' : '' ?>">Customer</a>
            </menu>
            <a href="<?= BASEURL ;?>/app/logout.php" class="logout"><div>Logout</div></a>
        </div>
    </div>
    <!-- End Sidebar -->

    