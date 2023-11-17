<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../base.php");
require_once(BASEPATH."/app/database.php");

$order = getOrderbyId($_SESSION['username'],$_GET['id']);
if($order['status']){
    header("Location: daftar_transaksi.php");
}else{
    deleteOrderbyId($_GET['id']);
}

