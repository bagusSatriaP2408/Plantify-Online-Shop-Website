<?php 
session_start();
/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'customer' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}


require_once($_SERVER['DOCUMENT_ROOT']."/TA-tes/app/base.php"); // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/app/database.php"); // menghubungkan dengan file database.php untuk mendapatkan function SQL
// mendapatkan produk yang ada di keranjang customer  
$keranjang = getKeranjang($_SESSION['username']); 
// perulangan untuk menghitung total produk yang ada di keranjang
$total = 0;
foreach($keranjang as $krnjg){
  $total+=1;
};
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plantify | <?= $title ?></title> <!--menampilakan title sesuai dengan halaman -->
    <link rel="stylesheet" href="<?= BASEURL ;?>/app/assets/styles/style_customer.css" />
  </head>
  <body>
    <!----------------------------------- START HEADER ------------------------------------>
    <header>
      <div class="menu">
        <img class="logo" src="<?= BASEURL ;?>/app/assets/img/logo.png" alt="logo" />
        <!--kondisi jika title sesuai dengan halaman maka diberikan class active-->
        <a class="<?= $title == 'Beranda' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/index.php" ?>">Beranda</a>
        <a class="<?= $title == 'Produk' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/produk.php" ?>">Produk</a>
        <a class="<?= $title == 'Daftar Pesanan' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/daftar_transaksi.php" ?>">Daftar Pesanan</a>
      </div>
      <div class="icon-menu">
        <a href="">
          <img src="<?= BASEURL ;?>/app/assets/img/icon-search.png" alt="icon" />
        </a>
        <a href="<?= BASEURL ;?>/app/customer/keranjang.php">
          <?php if($total > 0):?> <!--jika total yang telah dihitung lebih besar dari nol maka tampilkan-->
            <div class="con" >
              <h4 class="abs"><?= $total?></h4> <!--menampilkan total produk di keranjang-->
            </div>
          <?php endif ;?>
          <img src="<?= BASEURL ;?>/app/assets/img/<?= $title == 'Keranjang' ? 'icon-keranjang-active.png': 'icon-keranjang.png'?>" alt="icon" />
        </a>
        <a href="<?= BASEURL ;?>/app/customer/profile.php">
          <img src="<?= BASEURL ;?>/app/assets/img/<?= $title == 'Profile' ? 'icon-profile-active.png': 'icon-profile.png'?>" alt="icon" />
        </a>
      </div>
    </header>
    <!----------------------------------- END HEADER --------------------------------------------->