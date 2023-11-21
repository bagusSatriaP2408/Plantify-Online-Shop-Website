<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/TA-tes/app/base.php");
require_once(BASEPATH . "/app/database.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plantify | <?= $title ?></title>
    <link rel="stylesheet" href="<?= BASEURL ;?>/assets/styles/style_customer.css" />
  </head>
  <body>
    <!-- Start Header -->
    <header>
      <div class="menu">
        <img class="logo" src="<?= BASEURL ;?>/assets/img/logo.png" alt="logo" />
        <a class="<?= $title == 'Beranda' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/index.php" ?>">Beranda</a>
        <a class="<?= $title == 'Produk' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/produk.php" ?>">Produk</a>
        <a class="<?= $title == 'Daftar Pesanan' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/daftar_transaksi.php" ?>">Daftar Pesanan</a>
      </div>
      <div class="icon-menu">
        <a href="">
          <img src="<?= BASEURL ;?>/assets/img/icon-search.png" alt="icon" />
        </a>
        <a href="<?= BASEURL ;?>/app/customer/keranjang.php">
          <img src="<?= BASEURL ;?>/assets/img/<?= $title == 'Keranjang' ? 'icon-keranjang-active.png': 'icon-keranjang.png'?>" alt="icon" />
        </a>
        <a href="<?= BASEURL ;?>/app/customer/profile.php">
          <img src="<?= BASEURL ;?>/assets/img/<?= $title == 'Profile' ? 'icon-profile-active.png': 'icon-profile.png'?>" alt="icon" />
        </a>
      </div>
    </header>
    <!-- End Header -->