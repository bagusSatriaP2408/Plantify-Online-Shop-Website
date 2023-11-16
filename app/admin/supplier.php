<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

$title = "Supplier";
require_once('../base.php');
require_once(BASEPATH . "/app/admin/templates/sidebar.php");
require_once(BASEPATH . "/app/admin/templates/header.php");
$supplier = getAllDataSupplier();
?>
    
    <!-- start supplier -->
    <div class="wadah">
        <div class="judul">
            <h2>Supplier</h2>
        </div>
        <table>
            <tr>
                <th>Nama</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($supplier as $sup): ?>
                <tr>
                    <td><?= $sup['nama_supplier']; ?></td>
                    <td><?= $sup['no_telepon']; ?></td>
                    <td><?= $sup['alamat']; ?></td>
                    <td>
                        <a href="<?= BASEURL ?>/app/admin/ubah_supplier.php?id=<?= $sup['id_supplier']; ?>">
                            <button class="ubah">Ubah</button>
                        </a>
                        <a href="hapus_supplier.php?id=<?= $sup['id_supplier']; ?>">
                            <button class="hapus">Hapus</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="<?= BASEURL ?>/app/admin/tambah_supplier.php">
            <button class="tambah">Tambahkan Supplier Baru</button>
        </a>
    </div>
    <!-- end supplier -->


    </div>

</body>
</html>