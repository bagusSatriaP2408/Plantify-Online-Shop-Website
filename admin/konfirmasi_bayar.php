<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$title = "Konfirmasi Bayar";
require_once('../base.php');
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");
$pesanan =  getAllOrder();
?>
    
        <!-- start konfirmasi -->
        <div class="wadah">
            <div class="judul">
                <h2>Supplier</h2>
            </div>
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
                                <a href="<?= BASEURL ?>/admin/ubah_status_bayar.php?id=<?= $order['id_order']; ?>">
                                    <button class="ubah">Konfirmasi</button>
                                </a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <!-- end konfirmasi -->
    </div>
    <!-- end container-kanan -->

</body>
</html>