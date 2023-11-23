<?php

$title = "Daftar Pesanan";

require_once("../base.php");// untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/database.php"); // menghubungkan dengan file database.php untuk mendapatkan function SQL
require_once(BASEPATH."/templates/header.php");

$pesanan =  getOrder($_SESSION['username']);
?>

<div class="produk">
    <div class="judul">
        <h2>Riwayat Transaksi</h2>
    </div>
    <div class="container a">
        <div class="card">
            <table>
                <tr>
                    <th>Tanggal Order</th>
                    <th>Total Order</th>
                    <th>No Rekening</th>
                    <th>Nama Bank</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach($pesanan as $order): ?>
                    <tr>
                        <td><?= $order['tanggal_order']?></td>
                        <td><?= $order['total_order']?></td>
                        <td><?= $order['no_rekening'] ?></td>
                        <td><?= $order['nama_bank']?></td>
                        <td><?= $order['status']==0 ? "Belum Dibayar" : "Sudah Dibayar"?></td>
                        <td>
                            <a class="btn-card" href="detail_transaksi.php?order=<?= $order['id_order']?>">Lihat Detail</a>
                            <?php if(!$order['status']):?>
                                <a class="btn-card" href="edit_pembayaran.php?id=<?= $order['id_order']?>">Ubah Pembayaran</a>
                                <a class="btn-card" href="hapus_transaksi.php?id=<?= $order['id_order']?>">Batalkan</a>
                            <?php endif?>
                        </td>
                    </tr>
                <?php endforeach?>
            </table>
        </div>
    </div>
</div>

