<?php
// session_start();

// if (!isset($_SESSION['login'])) {
//     header("Location: ../index.php");
//     exit();
// }

$title = 'Produk';
require_once('../base.php');
require_once(BASEPATH . "/app/templates/header.php");
if(!isset($_GET['cate'])){
    $products = getAllDataProducts();
    $judul = 'Semua Produk';
}else{
    $products = getAllDataProductsWithDetailsByCategory($_GET['cate']);
    $judul = 'Kategori : '. $products[0]['nama_kategori'];
}
?>

<div class="produk">
    <div class="judul">
    <h2><?= $judul ?></h2>
    </div>
    <div class="container">
    <?php foreach($products as $product ):?>
        <div class="card">
        <img
            class="img-produk"
            src="<?= BASEURL ;?>/assets/img/<?= $product['gambar_produk'] ?>"
            alt="gambar produk"
        />
        <div class="caption">
            <h5><?= $product['nama_produk']?></h5>
            <h5>Rp. <?= $product['harga_produk']?>,-</h5>
            <small>Tersedia <?= $product['stok_produk']?></small>
            <a href="tambah_keranjang.php?produk=<?= $product["id_produk"] ?>">
                <div class="btn-card">Beli</div>
            </a>
        </div>
        </div>
    <?php endforeach;?>
    </div>
</div>

<?php
require_once('../templates/footer.php');
?>