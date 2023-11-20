<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

$title = "Keranjang";
require_once("../base.php");
require_once(BASEPATH . "/app/database.php");
require_once(BASEPATH."/app/templates/header.php");
require_once(BASEPATH.'/app/validations.php');

$dataKeranjang = getKeranjang($_SESSION['username']);
$dataDiri = getDataDiri($_SESSION['username']);
$bank = getAllBank();
if(empty($dataKeranjang)){
    header("Location: keranjang.php");
}

if(isset($_POST['submit'])){

    if(!isset($_POST['bank'])){
        $errors['bank'] = "Harap pilih pembayaran";
    }
    $no_rekening = htmlspecialchars($_POST['no_rekening']);
    validateTel($errors, $no_rekening);
    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }
    
    if (strlen($cek) == 0) {

        $dataKeranjang = getKeranjang($_SESSION['username']);
        $dataDiri = getDataDiri($_SESSION['username']);
        $bank = getAllBank();
        $total = 0;
        foreach ($dataKeranjang as $data) {
            $total += $data["harga_produk"] * $data["jml"];
        }

        $id_keranjang = $dataKeranjang[0]['id_keranjang'];
        
        $a = insertOrder($_SESSION['username'],$total,$_POST['no_rekening'],$_POST['bank'],$id_keranjang);
        foreach($dataKeranjang as $data)
        {
            insertOrderDetail($a,$data['id_produk'],$data['jml'],$data['jml']*$data['harga_produk']);
        }
        
        header("Location: ".BASEURL."/app/customer/daftar_transaksi.php?id=".$a);
    }
}

?>
<div class="produk">
    <div class="judul">
        <h2>Keranjang Belanja</h2>
    </div>
    <div class="container a">
        <div class="card">
            <table>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
                <?php foreach ($dataKeranjang as $data ):?>
                    <tr>
                        <td>
                            <div class="produk-keranjang">
                                <img
                                class="img-keranjang"
                                src="<?= BASEURL ;?>/assets/img/produk/<?= $data['gambar_produk'] ?>"
                                alt="gambar produk"
                                />
                                <div class="caption">
                                    <h5><?= $data['nama_produk']?></h5>
                                    <small>Tersedia <?= $data['stok_produk']?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5>Rp. <?= number_format($data["harga_produk"], 0, ',', '.')?>,-</h5>
                        </td>
                        <td>
                            <h5 class="jml"><?=$data['jml']?> </h5>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            </table>
            <div class="total">
                <?php
                    $total = 0;
                    foreach ($dataKeranjang as $data) {
                        $total += $data["harga_produk"] * $data["jml"];
                    }                            
                ?>
                <h4>Total Pembayaran</h4>
                <h4>Rp. <?= number_format($total, 0, ',', '.')?>,-</h4>
            </div>
        </div>
        <form action="konfirmasi_pembayaran.php" method="post">
            <div class="card bayar">
                <h3>Info Pembayaran</h3>
                <h4>Nama : </h4>
                <h5><?= $dataDiri['nama']?></h5>
                <h4>Alamat : </h4>
                <h5><?= $dataDiri['alamat']?></h5>
                <label for="bank">Tipe Pembayaran</label>
                <?php foreach($bank as $b) :  ?> 
                    <div>
                        <input name="bank" id="<?= $b['id_bank']?>" type="radio" value="<?= $b['id_bank'] ?>" <?= isset($_POST['bank'])&&$_POST["bank"]==$b['id_bank'] ? 'checked' : '' ?> >
                        <label for="<?= $b['id_bank'] ?>"><?= $b['nama_bank'] ?></lable>
                    </div>
                <?php endforeach ?>
                <span class="error-msg"><?= $errors["bank"] ?? '' ?></span>
                <label for="">No Rekening</label>
                <input type="text" name="no_rekening" value="<?= $_POST['no_rekening'] ?? '' ?>">
                <span class="error-msg"><?= $errors["tel"] ?? '' ?></span>
                <button class="btn-card" type="submit" name="submit">Pesan</button>
                <a href="keranjang.php">
                    <button class="btn-card" type="button">Batalkan</button>
                </a>
            </div>
        </form>
    </div>
</div>