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
?>
<style>
    .img-keranjang{
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
    }
td,tr{
        padding: 0px 60px 40px 60px;
        text-align: center;
    }
    th{
        text-align: left;
        padding: 0px 60px 20px 60px;
    }
    .produk-keranjang{
        display: flex;
        text-align: left;
    }
    .a{
        justify-content:flex-start;
    }
    .bayar{
        padding: 50px;
    }
    .total{
        padding: 20px 15px 20px 15px;
        margin: 0px 60px 30px 60px;;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #D9D9D9;
        border-radius: 20px;
    }
    .x{
        position: relative;
        top: -20px;
        color: #666666;
    }
    .jumlah-btn{
        color: #666666;
        border: 1px solid #666666;
        border-radius: 100px;
        padding: 0 7px 0 7px;
    }
    .jml{
        margin: 15px;
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
                <?php foreach ($dataKeranjang as $data ):?>
                    <tr>
                        <td>
                            <div class="produk-keranjang">
                                <div style="display: flex;">
                                    <img
                                    class="img-keranjang"
                                    src="<?= BASEURL ;?>/assets/img/<?= $data['gambar_produk'] ?>"
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
        <div class="card bayar">

                <h3>Info Pembayaran</h3>
                <label for="almt">Alamat Pengiriman</label>
                <input type="text" id="almt">
                <label for="pengirim">Opsi Pengiriman</label>
                <img src="<?= BASEURL?>/assets/img/icon-keranjang.png" style="width:50px" alt="">
                <label for="bayar">Tipe Pembayaran</label>
                <img src="<?= BASEURL?>/assets/img/icon-keranjang.png" style="width:50px" alt="">
            </div>
    </div>
</div>