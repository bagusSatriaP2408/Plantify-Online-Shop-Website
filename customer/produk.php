<?php

$title = 'Produk';  // memberikan judul pada header
require_once('../base.php');    // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/templates/header.php");   // mengabungkan dengan halaman header

// mengecek apakah ada get jika tidak menampilkan semua
if(!isset($_GET['cate'])){
    $products = getAllDataProducts();
    $judul = 'Semua Produk';
}else{
    // jika ada tampilkan sesuai kategori get
    $products = getAllDataProductsWithDetailsByCategory($_GET['cate']);
    $judul = 'Kategori : '. $products[0]['nama_kategori'];
}
?>

<div class="produk">
    <div class="judul">
        <h2><?= $judul ?></h2> <!-- menampilkan judul -->
    </div>
    <div class="container">
        <?php foreach($products as $product ):?>    <!-- perulangan untuk mengeluarkan nilai $products -->
            <div class="card">              <!-- menampialkan gambar produk dari variable $product -->
                <img class="img-produk" src="<?= BASEURL ;?>/assets/img/produk/<?= $product['gambar_produk'] ?>" alt="gambar produk"/>
                <div class="caption">
                    <h5><?= $product['nama_produk']?></h5>  <!-- menampialkan nama produk dari variable $product -->
                    <h5>Rp. <?= number_format($product["harga_produk"], 0, ',', '.')?>,-</h5>   <!-- menampialkan harga produk dari variable $product -->
                    <small>Tersedia <?= $product['stok_produk']?></small>   <!-- menampialkan stok produk dari variable $product -->
                    <?php if ($product['stok_produk'] == 0 ):?> <!-- kondisi jika stok produk 0 maka tidak bisa dibeli dan menampilkan stok habis -->
                        <div class="btn-card">Stok Habis</div>
                    <?php else: ?>
                        <a href="tambah_keranjang.php?produk=<?= $product["id_produk"] ?>">
                            <div class="btn-card">Masukkan Keranjang</div>    <!-- menuju ke keranjang.php dengan get berisi id produk -->
                        </a>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>

<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>