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

$pesanan =  getOrder($_SESSION['username']);

?>

    

<div class="produk">
    <div class="judul">

        <h2>Daftar Transaksi</h2>
    </div>
    <div class="container a">
        <div class="card">
            <table>
                <tr>
                    <th>Tanggal Order</th>
                    <th>Total Order</th>
                    <th>No Rekening</th>
                    <th>Nama Ekspedisi</th>
                    <th>Nama Bank</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach($pesanan as $order): ?>
                    <tr>
                        <td><?= $order['tanggal_order']?></td>
                        <td><?= $order['total_order']?></td>
                        <td><?= $order['no_rekening'] ?></td>
                        <td><?= $order['nama_ekspedisi'] ?></td>
                        <td><?= $order['nama_bank']?></td>
                        <td><?= $order['status']?></td>
                        <td><a class="btn-card" href="detail_transaksi.php?order=<?= $order['id_order']?>">Lihat Detail</a></td>
                    </tr>
                <?php endforeach?>
            </table>
        </div>
    </div>
</div>

