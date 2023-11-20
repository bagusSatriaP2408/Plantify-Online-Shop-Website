<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

require_once("../base.php");
require_once(BASEPATH."/app/database.php");

// mengambil data order dengan id
$order = getOrderbyId($_SESSION['username'],$_GET['id']);

// megegecek status jika status 1 maka mengarah ke daftar transaksi
if($order['status'])
{
    header("Location: daftar_transaksi.php");
}else{  // jika tidak maka hapus transaksi
    deleteOrderbyId($_GET['id']);
}

