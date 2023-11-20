<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}
require "validations.php";

$success = false;
$errors = array();

if (isset($_POST['submit'])) {
    $nama_supplier = htmlspecialchars($_POST['nama_supplier']);
    $tel = htmlspecialchars($_POST['tel']);
    $alamat = htmlspecialchars($_POST['alamat']);

    if (checkRequired($nama_supplier) || checkRequired($tel) || checkRequired($alamat)) {
        $errors['error'] = "data supplier tidak boleh ada yang kosong";
    } else {
        if (!checkAlphabet($nama_supplier)) {
            $errors['error'] = "nama supplier harus berupa alfabet";
        } else if (!checkNumeric($tel)) {
            $errors['error'] = "telepon supplier harus berupa numerik";
        } else if (strlen($tel) < 12) {
            $errors['error'] = "telepon tidak boleh  kurang dari 12 digit";
        } else {
            $errors['error'] = "";
        }
    }

    if ($errors['error'] == "") {
        $success = true;
    }

    if ($success) {
        try{
            $stat = DB->prepare("INSERT INTO supplier VALUES ('', :nama, :alamat, :telepon)");
            $stat = $stat->execute(array(
                ":nama" => $nama_supplier,
                ":alamat" => $alamat,
                ":telepon" => $tel));
        } catch (PDOException $err) {
            echo $err->getMessage(); 
        }
    }
}

$title = "Supplier";
require_once('../base.php');
require_once(BASEPATH . "/app/admin/templates/sidebar.php");
require_once(BASEPATH . "/app/admin/templates/header.php");
?>
    <!-- start tambah supplier -->
    <div class="wadah">
        <a href="<?= BASEURL ?>/app/admin/supplier.php">
            <button class="kembali">Kembali</button>
        </a>
        <div class="judul">
            <h2>Tambah Supplier</h2>
        </div>
        <p class="error"><?= $errors['error'] ?? ''; ?></p>
        <?php if ($success) { ?>
            <div>Supplier sukses ditambahkan!</div>
        <?php } else { ?>
            <form action="tambah_supplier.php" method="post">
                <div class="input-container">
                    <label for="nama_supplier">Nama Supplier</label>
                    <input type="text" name="nama_supplier" id="nama_supplier" value="<?php echo $_POST["nama_supplier"] ?? '' ?>">
                </div>
                <div class="input-container">
                    <label for="tel">Telepon Supplier</label>
                    <input type="text" name="tel" id="tel" value="<?php echo $_POST["tel"] ?? '' ?>">
                </div>
                <div class="input-container">
                    <label for="alamat">Alamat Supplier</label>
                    <input type="text" name="alamat" id="alamat" value="<?php echo $_POST["alamat"] ?? '' ?>">
                </div>
                <button type="submit" name="submit" class="submit">Tambahkan</button>
            </form>
        <?php } ?>
    </div>
    <!-- end tambah supplier -->

    </div>

</body>
</html>