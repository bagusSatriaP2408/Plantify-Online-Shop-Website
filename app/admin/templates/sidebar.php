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
                <a href="" class="<?= $title === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="" class="<?= $title === 'Product' ? 'active' : '' ?>">Product</a>
                <a href="" class="<?= $title === 'Supplier' ? 'active' : '' ?>">Supplier</a>
                <a href="" class="<?= $title === 'Customer' ? 'active' : '' ?>">Customer</a>
            </menu>
            <a href="<?= BASEURL ;?>/app/logout.php" class="logout"><div>Logout</div></a>
        </div>
    </div>
    <!-- End Sidebar -->

    