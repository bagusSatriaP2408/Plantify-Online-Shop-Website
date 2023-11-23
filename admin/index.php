<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$title = "Dashboard";
require_once('../base.php');
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");
$products = getAllDataProducts();
$customers = getAllDataCustomer();
$supplier = getAllDataSupplier();
?>
        
        <!-- start produk -->
        <div class="wadah">
            <div class="judul">
                <h2>Produk</h2>
                <a href="<?= BASEURL ?>/admin/produk.php">
                    <h4>Lihat semua</h4>
                </a>
            </div>
            <div class="container-produk">
                <?php for($i=0;$i<3;$i++):?>
                <div class="card">
                    <img
                        class="img-produk"
                        src="<?= BASEURL ;?>/assets/img/produk/<?= $products[$i]['gambar_produk'] ?>"
                        alt="gambar produk"
                    />
                    <div class="caption">
                        <h5><?= $products[$i]['nama_produk']?></h5>
                        <h5>Rp. <?= $products[$i]['harga_produk']?>,-</h5>
                        <small>Tersedia <?= $products[$i]['stok_produk']?></small>
                    </div>
                </div>
                <?php endfor;?>
            </div>
        </div>
        <!-- end produk -->

        <!-- start supplier -->
        <div class="wadah">
            <div class="judul">
                <h2>Supplier</h2>
                <a href="<?= BASEURL ?>/admin/supplier.php">
                    <h4>Lihat semua</h4>
                </a>
            </div>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                </tr>
                <?php for($i=0;$i<3;$i++): ?>
                    <tr>
                        <td><?= $supplier[$i]['nama_supplier']; ?></td>
                        <td><?= $supplier[$i]['no_telepon']; ?></td>
                        <td><?= $supplier[$i]['alamat']; ?></td>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
        <!-- end supplier -->

        <!-- start customer -->
        <div class="wadah">
            <div class="judul">
                <h2>Customer</h2>
                <a href="<?= BASEURL ?>/admin/customer.php">
                    <h4>Lihat semua</h4>
                </a>
            </div>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                </tr>
                <?php for($i=0;$i<3;$i++): ?>
                    <tr>
                        <td><?= $customers[$i]['username']; ?></td>
                        <td><?= $customers[$i]['nama']; ?></td>
                        <td><?= $customers[$i]['no_telepon']; ?></td>
                        <td><?= $customers[$i]['alamat']; ?></td>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
        <!-- end customer -->
    </div>
    <!-- end container-kanan -->

</body>
</html>