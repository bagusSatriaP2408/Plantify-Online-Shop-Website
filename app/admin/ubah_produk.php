<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

var_dump($_GET['id']);

$title = "Produk";
require_once('../base.php');
require_once(BASEPATH . "/app/admin/templates/sidebar.php");
require_once(BASEPATH . "/app/admin/templates/header.php");
$products = getAllDataProducts();
$categories  = getAllCategories();
$supplier = getAllDataSupplier();
?>
    <!-- start ubah produk -->
    <div class="tambah-produk">
        <a href="<?= BASEURL ?>/app/admin/produk.php">
            <button class="kembali">Kembali</button>
        </a>
        <div class="judul">
            <h2>Ubah Produk</h2>
        </div>
        <form action="ubah_produk.php">
            <div class="input-container">
                <label for="nama">Nama Produk</label>
                <input type="text" name="nama" id="nama">
            </div>
            <div class="input-container">
                <label for="harga">Harga Produk</label>
                <input type="text" name="harga" id="harga">
            </div>
            <div class="input-container">
                <label for="stok">Stok Produk</label>
                <input type="text" name="stok" id="stok">
            </div>
            <div class="input-container">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori">
                    <?php for($i = -1; $i < count($categories); $i++): ?>
                        <option value="<?= $i == -1 ? '0' : $categories[$i]['id_kategori']; ?>"><?= $i == -1 ? '--pilih kategori--' : $categories[$i]['nama_kategori']; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="input-container">
                <label for="supplier">Supplier</label>
                <select name="supplier" id="supplier">
                    <?php for($i = -1; $i < count($supplier); $i++): ?>
                        <option value="<?= $i == -1 ? '0' : $supplier[$i]['id_supplier']; ?>"><?= $i == -1 ? '--pilih supplier--' : $supplier[$i]['nama_supplier']; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="input-container">
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </div>
            <button type="submit" name="submit" class="submit">Ubah</button>
        </form>
    </div>
    <!-- end ubah produk -->

    </div>

</body>
</html>