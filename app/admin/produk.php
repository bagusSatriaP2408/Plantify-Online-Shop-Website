<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$title = "Produk";
require_once('../base.php');
require_once(BASEPATH . "/app/admin/templates/sidebar.php");
require_once(BASEPATH . "/app/admin/templates/header.php");
$products = getAllDataProducts();
$categories  = getAllCategoriesWithGambarProduk();
$supplier = getAllDataSupplier();
?>

        <!-- start produk -->
        <div class="wadah">
            <div class="judul">
                <h2>Produk</h2>
            </div>
            <div class="container-produk">
                <?php foreach ($products as $product):?>
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
                        <a href="<?= BASEURL ?>/app/admin/ubah_produk.php?id=<?= $product['id_produk']; ?>">
                            <button class="ubah">Ubah</button>
                        </a> 
                        <a href="hapus_produk.php?id=<?= $product['id_produk']; ?>">
                            <button class="hapus">Hapus</button>
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <a href="<?= BASEURL ?>/app/admin/tambah_produk.php">
                <button class="tambah">Tambahkan Produk Baru</button>
            </a>
        </div>
        <!-- end produk -->
    </div>
    <!-- end container-kanan -->

</body>
</html>