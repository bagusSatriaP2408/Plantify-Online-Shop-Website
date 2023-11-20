<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

$title = "Keranjang";
require_once("../base.php");
require_once(BASEPATH . "/app/database.php");
require_once(BASEPATH."/app/templates/header.php");

$detail_order = getDetailOrder($_GET['order']);
?>

<div class="produk">
    <div class="judul">
        <h2>Detail</h2>
    </div>
    <div class="container a">
        <div class="card">
            <table>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
                <?php foreach($detail_order as $order): ?>
                    <tr>
                        <td>
                            <div class="produk-keranjang">
                                <div style="display: flex;">
                                    <img
                                    class="img-keranjang"
                                    src="<?= BASEURL ;?>/assets/img/produk/<?= $order['gambar_produk'] ?>"
                                    alt="gambar produk"
                                    />
                                </div>
                                <div class="caption">
                                    <h5><?= $order['nama_produk']?></h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5>Rp. <?= number_format($order["harga_produk"], 0, ',', '.')?>,-</h5>
                        </td>
                        <td>
                            <h5 class="jml"><?=$order['jumlah_produk']?> </h5>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
    <a class="btn-card" href="daftar_transaksi.php">Kembali</a>
</div>