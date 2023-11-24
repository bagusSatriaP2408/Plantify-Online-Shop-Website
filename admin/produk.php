<?php 

$title = "Produk";
<<<<<<<< HEAD:admin/produk/index.php

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$products = getAllDataProducts();   // mengambil semua data produk
$categories  = getAllCategories();  // mengambil semua data category
$supplier = getAllDataSupplier();   // mengambil semua data supplier

========
require_once('../base.php');
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");
$products = getAllDataProducts();
$categories  = getAllCategoriesWithGambarProduk();
$supplier = getAllDataSupplier();
>>>>>>>> 9b1d9f1baf23f286f2dc379bc1e5ce55b12428d6:admin/produk.php
?>

        <!-- start produk -->
        <div class="wadah">
            <div class="judul">
                <h2>Produk</h2>
            </div>
            <!-- start container-produk -->
            <div class="container-produk">
                <?php foreach ($products as $product):?>
                <!-- start card -->
                <div class="card">
                    <img
                        class="img-produk"
                        src="<?= BASEURL ;?>/assets/img/produk/<?= $product['gambar_produk'] ?>"
                        alt="gambar produk"
                    />
                    <div class="caption">
                        <h5><?= $product['nama_produk']?></h5>
                        <h5>Rp. <?= $product['harga_produk']?>,-</h5>
                        <small>Tersedia <?= $product['stok_produk']?></small>
                    </div>
                    <div class="button-container">
<<<<<<<< HEAD:admin/produk/index.php
                        <a href="<?= BASEURL ?>/admin/produk/ubah.php?id=<?= $product['id_produk']; ?>">
========
                        <a href="<?= BASEURL ?>/admin/ubah_produk.php?id=<?= $product['id_produk']; ?>">
>>>>>>>> 9b1d9f1baf23f286f2dc379bc1e5ce55b12428d6:admin/produk.php
                            <button class="ubah">Ubah</button>
                        </a> 
                        <a href="hapus.php?id=<?= $product['id_produk']; ?>">
                            <button class="hapus">Hapus</button>
                        </a>
                    </div>
                </div>
                <!-- end card -->
                <?php endforeach;?>
            </div>
<<<<<<<< HEAD:admin/produk/index.php
            <!-- end container-produk -->
            <a href="<?= BASEURL ?>/admin/produk/tambah.php">
========
            <a href="<?= BASEURL ?>/admin/tambah_produk.php">
>>>>>>>> 9b1d9f1baf23f286f2dc379bc1e5ce55b12428d6:admin/produk.php
                <button class="tambah">Tambahkan Produk Baru</button>
            </a>
        </div>
        <!-- end produk -->
    </div>
    <!-- end container-kanan -->

</body>
</html>