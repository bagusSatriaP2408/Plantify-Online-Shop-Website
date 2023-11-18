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
require_once(BASEPATH.'/app/validations.php');


$dataKeranjang = getKeranjang($_SESSION['username']);
$dataDiri = getDataDiri($_SESSION['username']);
$bank = getAllBank();
if(isset($_POST['submit'])){
    $no_rekening = htmlspecialchars($_POST['no_rekening']);
    if(!isset($_POST['bank']) ){
        $errors['bank'] = 'Mohon pilih bank';
    }
    validateTel($errors, $no_rekening);
    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }
    
    if (strlen($cek) == 0) {

    $dataKeranjang = getKeranjang($_SESSION['username']);
    $dataDiri = getDataDiri($_SESSION['username']);
    $bank = getAllBank();
    $total = 0;
    foreach ($dataKeranjang as $data) {
        $total += $data["harga_produk"] * $data["jml"];
    }

    $id_keranjang = $dataKeranjang[0]['id_keranjang'];
    
    $a = insertOrder($_SESSION['username'],$total,$_POST['no_rekening'],$_POST['bank'],$id_keranjang);
    foreach($dataKeranjang as $data)
    {
        insertOrderDetail($a,$data['id_produk'],$data['jml'],$data['jml']*$data['harga_produk']);
    }
    
    header("Location: ".BASEURL."/app/customer/konfirmasi_pembayaran.php?id=".$a);
}
}

?>
<style>
    h6{
        margin: 100px;
    }
</style>
<div class="produk">
    <div class="judul">

        <h2>Keranjang Belanja</h2>
    </div>
    <div class="container a">
        <div class="card">
            <table>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
                <?php if(empty($dataKeranjang)) : ?>
                    <tr>
                        <td colspan='3'>Keranjang belanja masih kosong</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td ><a class="btn-card" href="produk.php">Belanja</a></td>
                        <td></td>
                    </tr>
                <?php else :?>
                <?php foreach ($dataKeranjang as $data ):?>
                    <tr>
                        <td>
                            <div class="produk-keranjang">
                                <div style="display: flex;">
                                    <img
                                    class="img-keranjang"
                                    src="<?= BASEURL ;?>/assets/img/produk/<?= $data['gambar_produk'] ?>"
                                    alt="gambar produk"
                                    />
                                    <a href="hapus_produk_keranjang.php?pro=<?= $data['id_produk']?>&krjng=<?= $data['id_keranjang']?>" class="x">&#10006;</a>
                                </div>
                                <div class="caption">
                                    <h5><?= $data['nama_produk']?></h5>
                                    <small>Tersedia <?= $data['stok_produk']?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5>Rp. <?= number_format($data["harga_produk"], 0, ',', '.')?>,-</h5>
                        </td>
                        <td>
                            <div style="display: flex; align-items:center;">
                                <a type="button" class="jumlah-btn" href="kurang_jumlah_produk_keranjang.php?pro=<?=$data["id_produk"]?>&krjng=<?= $data['id_keranjang']?>">&minus;</a> 
                                    <h5 class="jml"><?=$data['jml']?> </h5>
                                <a type="button" class="jumlah-btn" href="tambah_jumlah_produk_keranjang.php?pro=<?=$data["id_produk"]?>&krjng=<?= $data['id_keranjang']?>">&plus;</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            </table>
            <div class="total">
                <?php
                    $total = 0;
                    foreach ($dataKeranjang as $data) {
                        $total += $data["harga_produk"] * $data["jml"];
                    }                            
                ?>
                <h4>Total Pembayaran</h4>
                <h4>Rp. <?= number_format($total, 0, ',', '.')?>,-</h4>
            </div>
        </div>
        <a class="btn-card" href="konfirmasi_pembayaran.php">Chekout</a>
        <?php endif ; ?>
</div>