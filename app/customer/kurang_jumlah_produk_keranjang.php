<?php
session_start();
/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'customer' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

require_once("../base.php");// untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/app/database.php"); // menghubungkan dengan file database.php untuk mendapatkan function SQL
// fungsi untuk mengurangi jumlah produk di keranjang 1/1
deleteProductInCart($_GET['pro'],$_GET['krjng'],0);