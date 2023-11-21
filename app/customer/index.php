<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

$title = 'Beranda';
require_once('../base.php');
require_once(BASEPATH . "/app/templates/header.php");

$categories  = getAllCategoriesWithGambarProduk();
$news = getNewProducts();
$populars = getPopularProducts();

?>
<!-- Start Main  -->
<main>
    <div class="main-kiri">
        <h1>Tanamkan Keindahan di Setiap Sudut Rumah Anda!</h1>
        <p>
          Kecantikan alam, dalam genggaman Anda. Bonsai eksklusif untuk
          keindahan yang abadi. Temukan keharmonisan alam di sini
        </p>
        <a href="<?= BASEURL. '/app/customer/produk.php'?>">
            <div class="btn">Temukan Sekarang</div>
        </a>
    </div>
    <div class="main-kanan">
        <div>
            <div>
                <div class="btn-1">Baru</div>
                <img class="img-baru" src="<?= BASEURL ;?>/assets/img/produk/<?= $news[0]['gambar_produk']?>" alt="terbaru" />
            </div>
            <div>
                <div class="btn-1">Baru</div>
                <img
                    class="img-popular"
                    src="<?= BASEURL ;?>/assets/img/produk/<?= $news[1]['gambar_produk']?>"
                    alt="popular"
                />
            </div>
        </div>
        <div>
            <div>
                <div class="btn-1">unggulan</div>
                <img
                    class="img-unggulan"
                    src="<?= BASEURL ;?>/assets/img/produk/<?= $populars[0]['gambar_produk']?>"
                    alt="unggulan"
                />
            </div>
            <img class="img-abs" src="<?= BASEURL ;?>/assets/img/Vector.png" alt="img-abs" />
        </div>
    </div>
</main>
    <!-- End Main -->
    <!-- Start Produk -->
<div class="produk">
    <div class="judul">
        <h2>Baru</h2>
        <h4 ><a style="color:green;"  href="<?= BASEURL. '/app/customer/produk.php'?>">Lihat semua</a></h4>
    </div>
    <div class="container">
    <?php foreach($news as $new):?>
        <div class="card">
            <img
              class="img-produk"
              src="<?= BASEURL ;?>/assets/img/produk/<?= $new['gambar_produk'] ?>"
              alt="gambar produk"
            />
            <div class="caption">
                <h5><?= $new['nama_produk']?></h5>
                <h5>Rp. <?= $new['harga_produk']?>,-</h5>
                <small>Tersedia <?= $new['stok_produk']?></small>
                <?php if ($new['stok_produk'] == 0 ):?>
                    <div class="btn-card">Stok Habis</div>
                <?php else: ?>
                    <a href="tambah_keranjang.php?produk=<?= $new["id_produk"] ?>">
                        <div class="btn-card">Beli</div>
                    </a>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach;?>
    </div>
</div>
    <!-- End Produk -->
    <!-- Start Produk -->
<div class="produk">
    <div class="judul">
        <h2>Popular</h2>
        <h4><a style="color:green"  href="<?= BASEURL. '/app/customer/produk.php'?>">Lihat semua</a></h4>
    </div>
    <div class="container">
    <?php foreach($populars as $popular):?>
        <div class="card">
            <img
              class="img-produk"
              src="<?= BASEURL ;?>/assets/img/produk/<?= $popular['gambar_produk'] ?>"
              alt="gambar produk"
            />
            <div class="caption">
                <h5><?= $popular['nama_produk']?></h5>
                <h5>Rp. <?= $popular['harga_produk']?>,-</h5>
                <small>Tersedia <?= $popular['stok_produk']?></small>
                <?php if ($popular['stok_produk'] == 0 ):?>
                    <div class="btn-card">Stok Habis</div>
                <?php else: ?>
                    <a href="tambah_keranjang.php?produk=<?= $popular["id_produk"] ?>">
                        <div class="btn-card">Beli</div>
                    </a>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach;?>
    </div>
</div>
    <!-- End Produk -->
    <!-- Start Kategori -->
<div class="kategori">
    <div class="judul">
        <h2>Kategori</h2>
    </div>
    <div class="container">
        <?php foreach($categories as $category):?>
            <a href="<?= BASEURL?>/app/customer/produk.php?cate=<?= $category['id_kategori']?>" >
                <div class="card-kategori">
                    <img class="img2" src="<?= BASEURL ;?>/assets/img/produk/<?= $category['gambar_produk']?>" alt="img kategori" />
                    <h4 class="title2"><?= $category['nama_kategori'] ?></h4>
                </div>
            </a>
        <?php endforeach ;?>
    </div>
</div>
    <!-- End Kategori -->
    <!-- Start Lokasi -->
<div class="lokasi">
    <div class="judul">
        <h2>Lokasi Kami</h2>
    </div>
    <div class="container">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.9644736773307!2d112.72410727433831!3d-7.130106192873798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd803dcd1e1bd7f%3A0x5261304f608c91db!2sLey%20Denara!5e0!3m2!1sid!2sid!4v1699597392448!5m2!1sid!2sid"
          width="1159"
          height="287"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
</div>
    <!-- End Lokasi -->
<?php
require_once('../templates/footer.php');
?>