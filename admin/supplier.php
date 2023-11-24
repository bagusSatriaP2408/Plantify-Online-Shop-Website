<?php 

$title = "Supplier";
<<<<<<<< HEAD:admin/supplier/index.php

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$supplier = getAllDataSupplier();   // mengambil semua data supplier

========
require_once('../base.php');
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");
$supplier = getAllDataSupplier();
>>>>>>>> 9b1d9f1baf23f286f2dc379bc1e5ce55b12428d6:admin/supplier.php
?>
    
        <!-- start supplier -->
        <div class="wadah">
            <div class="judul">
                <h2>Supplier</h2>
            </div>
            <!-- start table -->
            <table>
                <tr>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($supplier as $sup): ?>
                    <tr>
                        <td><?= $sup['nama_supplier']; ?></td>
                        <td><?= $sup['no_telepon']; ?></td>
                        <td><?= $sup['alamat']; ?></td>
                        <td>
<<<<<<<< HEAD:admin/supplier/index.php
                            <div class="button-container">
                                <a href="<?= BASEURL ?>/admin/supplier/ubah.php?id=<?= $sup['id_supplier']; ?>">
                                    <button class="ubah">Ubah</button>
                                </a>
                                <a href="hapus.php?id=<?= $sup['id_supplier']; ?>">
                                    <button class="hapus">Hapus</button>
                                </a>
                            </div>
========
                            <a href="<?= BASEURL ?>/admin/ubah_supplier.php?id=<?= $sup['id_supplier']; ?>">
                                <button class="ubah">Ubah</button>
                            </a>
                            <a href="hapus_supplier.php?id=<?= $sup['id_supplier']; ?>">
                                <button class="hapus">Hapus</button>
                            </a>
>>>>>>>> 9b1d9f1baf23f286f2dc379bc1e5ce55b12428d6:admin/supplier.php
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
<<<<<<<< HEAD:admin/supplier/index.php
            <!-- end table -->
            <a href="<?= BASEURL ?>/admin/supplier/tambah.php">
========
            <a href="<?= BASEURL ?>/admin/tambah_supplier.php">
>>>>>>>> 9b1d9f1baf23f286f2dc379bc1e5ce55b12428d6:admin/supplier.php
                <button class="tambah">Tambahkan Supplier Baru</button>
            </a>
        </div>
        <!-- end supplier -->
    </div>
    <!-- end container-kanan -->

</body>
</html>