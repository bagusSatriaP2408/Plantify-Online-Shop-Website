<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

$title = "Keranjang";
require_once("../base.php");
require_once(BASEPATH . "/app/database.php");
require_once(BASEPATH."/app/templates/header.php");


$dataKeranjang = getKeranjang($_SESSION['username']);
$dataDiri = getDataDiri($_SESSION['username']);
$bank = getAllBank();
$pengiriman = getAllPengiriman();
$total = 0;
foreach ($dataKeranjang as $data) {
    $total += $data["harga_produk"] * $data["jml"];
}

$id_keranjang = $dataKeranjang[0]['id_keranjang'];

 $a = insertOrder($_SESSION['username'],$total,$_POST['pengiriman'],$_POST['no_rekening'],$_POST['bank'],$id_keranjang);
 foreach($dataKeranjang as $data)
 {
    insertOrderDetail($a,$data['id_produk'],$data['jml'],$data['jml']*$data['harga_produk']);
 }

 header("Location: ".BASEURL."/app/customer/daftar_transaksi.php");