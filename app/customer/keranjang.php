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

?>
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
        <form action="tambah_order.php" method="post">
        <div class="card bayar">

                <h3>Info Pembayaran</h3>
                <h4>Nama : </h4>
                <h5><?= $dataDiri['nama']?></h5>
                <h4>Alamat : </h4>
                <h5><?= $dataDiri['alamat']?></h5>
                    <label for="pengiriman">Opsi Pengiriman</label>
                    <select name="pengiriman" id="pengiriman">
                    <?php foreach($pengiriman as $kirim) :  ?> 
                        <option value="<?= $kirim['id_pengiriman']?>"><?= $kirim['nama_ekspedisi'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <label for="bank">Tipe Pembayaran</label>
                    <select name="bank" id="bank">
                        <?php foreach($bank as $b) :  ?> 
                            <option value="<?= $b['id_bank']?>"><?= $b['nama_bank'] ?></option>
                            <?php endforeach ?>
                        </select>
                    <label for="">No Rekening</label>
                    <input type="text" name="no_rekening">
                    <input type="submit" value="Pesan" name="submit">
                </div>
            </form>
    </div>
</div>