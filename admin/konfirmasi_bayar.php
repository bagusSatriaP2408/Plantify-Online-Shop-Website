<?php 

$title = "Konfirmasi Bayar";
<<<<<<<< HEAD:admin/transaksi/index.php

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$pesanan =  getAllOrder();      // mengambil data semua pesanan

========
require_once('../base.php');
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");
$pesanan =  getAllOrder();
>>>>>>>> 9b1d9f1baf23f286f2dc379bc1e5ce55b12428d6:admin/konfirmasi_bayar.php
?>
    
        <!-- start konfirmasi -->
        <div class="wadah">
            <div class="judul">
                <h2>Supplier</h2>
            </div>
            <!-- start table -->
            <table>
                <tr>
                    <th>Tanggal Order</th>
                    <th>Username</th>
                    <th>Total Order</th>
                    <th>No Rekening</th>
                    <th>Nama Bank</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($pesanan as $order): ?>
                    <tr>
                        <td><?= $order['tanggal_order']?></td>
                        <td><?= $order['username']?></td>
                        <td><?= $order['total_order']?></td>
                        <td><?= $order['no_rekening'] ?></td>
                        <td><?= $order['nama_bank']?></td>
                        <td><?= $order['status']==0 ? "Belum Dibayar" : "Sudah Dibayar"?></td>
                        <td>
                            <?php if(!$order['status']==0) : ?>
                                <button class="hapus">Telah dikonfirmasi</button>
                            <?php else: ?>
<<<<<<<< HEAD:admin/transaksi/index.php
                                <a href="<?= BASEURL ?>/admin/transaksi/ubah_status_bayar.php?id=<?= $order['id_order']; ?>">
========
                                <a href="<?= BASEURL ?>/admin/ubah_status_bayar.php?id=<?= $order['id_order']; ?>">
>>>>>>>> 9b1d9f1baf23f286f2dc379bc1e5ce55b12428d6:admin/konfirmasi_bayar.php
                                    <button class="ubah">Konfirmasi</button>
                                </a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- end table -->
        </div>
        <!-- end konfirmasi -->
    </div>
    <!-- end container-kanan -->

</body>
</html>