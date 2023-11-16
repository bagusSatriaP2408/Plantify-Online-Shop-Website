<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

require "validations.php";

$errors = array();
$success = false;

if (isset($_POST['submit'])) {

    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $harga = htmlspecialchars($_POST['harga']);
    $stok = htmlspecialchars($_POST['stok']);
    $kategori = $_POST['kategori'];
    $sup = $_POST['supplier'];

    $gambar = uploadGambar($errors);
    validasiTambahProduk($errors, $_POST);

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {
        $success = true;
    }

    if ($success && $gambar) {
        try{
            $stat = DB->prepare("INSERT INTO produk (id_supplier,nama_produk,harga_produk,stok_produk,gambar_produk,id_kategori) VALUES (:id_supplier,:nama_produk,:harga_produk,:stok_produk,:gambar_produk,:id_kategori)");
            $stat->execute(array(
                ":id_supplier" => $sup,
                ":nama_produk" => $nama_produk,
                ":harga_produk" => $harga,
                ":stok_produk" => $stok,
                ":gambar_produk" => $gambar,
                ":id_kategori" => $kategori));
        } catch (PDOException $err) {
            echo $err->getMessage(); 
        }
    }
}

$title = "Produk";
require_once('../base.php');
require_once(BASEPATH . "/app/admin/templates/sidebar.php");
require_once(BASEPATH . "/app/admin/templates/header.php");
$products = getAllDataProducts();
$categories  = getAllCategories();
$supplier = getAllDataSupplier();
?>
    <!-- start tambah produk -->
    <div class="wadah">
        <a href="<?= BASEURL ?>/app/admin/produk.php">
            <button class="kembali">Kembali</button>
        </a>
        <div class="judul">
            <h2>Tambah Produk</h2>
        </div>
        <p class="error"><?= $errors['error'] ?? ''; ?></p>
        <?php if ($success) { ?>
            <div>Produk sukses ditambahkan!</div>
        <?php } else { ?>
            <form action="tambah_produk.php" method="post" enctype="multipart/form-data">
                <div class="input-container">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" value="<?php echo $_POST["nama_produk"] ?? '' ?>">
                </div>
                <div class="input-container">
                    <label for="harga">Harga Produk</label>
                    <input type="text" name="harga" id="harga" value="<?php echo $_POST["harga"] ?? '' ?>">
                </div>
                <div class="input-container">
                    <label for="stok">Stok Produk</label>
                    <input type="text" name="stok" id="stok" value="<?php echo $_POST["stok"] ?? '' ?>">
                </div>
                <div class="input-container">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori">
                        <?php for($i = -1; $i < count($categories); $i++): ?>
                            <option 
                            value="<?= $i == -1 ? '0' : $categories[$i]['id_kategori']; ?>"
                            <?php if ($i != -1) {
                                if (isset($_POST["kategori"]) && $_POST["kategori"] == $categories[$i]['id_kategori']) {echo 'selected';}} ?>
                            ><?= $i == -1 ? '--pilih kategori--' : $categories[$i]['nama_kategori']; ?> </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="input-container">
                    <label for="supplier">Supplier</label>
                    <select name="supplier" id="supplier">
                        <?php for($i = -1; $i < count($supplier); $i++): ?>
                            <option 
                            value="<?= $i == -1 ? '0' : $supplier[$i]['id_supplier']; ?>" 
                            <?php if ($i != -1) {
                                if (isset($_POST["supplier"]) && $_POST["supplier"] == $supplier[$i]['id_supplier']) {echo 'selected';}} ?>
                            ><?= $i == -1 ? '--pilih supplier--' : $supplier[$i]['nama_supplier']; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="input-container">
                    <label for="gambar">Gambar : </label>
                    <input type="file" name="gambar" id="gambar">
                </div>
                <button type="submit" name="submit" class="submit">Tambahkan</button>
            </form>
        <?php } ?>
    </div>
    <!-- end tambah produk -->

    </div>

</body>
</html>