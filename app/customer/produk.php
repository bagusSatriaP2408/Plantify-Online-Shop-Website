<?php
$title = 'Produk';
require_once('../base.php');
require_once(BASEPATH . "/app/templates/header.php");
$products = getAllDataProducts();
?>

<div class="produk">
    <div class="judul">
    <h2>Semua Produk</h2>
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
            <div class="btn-card">Beli</div>
        </div>
        </div>
    <?php endforeach;?>
    </div>
</div>

<?php
require_once('../templates/footer.php');
?>