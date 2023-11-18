<?php 

require_once('../base.php');

function checkRequired($field) {
    return empty(trim($field));
}

function checkAlphabet($field) {
    $pattern = "/^[a-zA-Z\s]+$/";
    return preg_match($pattern, $field);
}

function checkAlphaNumeric($field) {
    $pattern = "/^([a-zA-Z]+[0-9]+)|([0-9]+[a-zA-Z]+)$/";
    return preg_match($pattern, $field);
}

function checkNumeric($field) {
    $pattern = "/^[0-9]+$/";
    return preg_match($pattern, $field);
}

function validasiTambahProduk (&$errors, $inputan) {

    $nama_produk = htmlspecialchars($inputan['nama_produk']);
    $harga = htmlspecialchars($inputan['harga']);
    $stok = htmlspecialchars($inputan['stok']);
    $kategori = $inputan['kategori'];
    $sup = $inputan['supplier'];

    $stat = DB->prepare("SELECT nama_produk FROM produk WHERE nama_produk = :nama_produk");
    $stat->execute(array(":nama_produk" => $nama_produk));

    if (checkRequired($nama_produk) || checkRequired($harga) || checkRequired($stok) || $kategori == 0 || $sup == 0) {
        $errors['error'] = "data produk tidak boleh ada yang kosong";
    } else if (!checkAlphaNumeric($nama_produk) && !checkAlphabet($nama_produk)) {
        $errors['error'] = "nama produk tidak boleh mengandung simbol";
    } else if ($stat->rowCount() > 0) {
        $errors['error'] = "nama produk sudah ada";
    } else if (!checkNumeric($harga)) {
        $errors['error'] = "harga produk harus berupa angka";
    } else if (!checkNumeric($stok)) {
        $errors['error'] = "stok produk harus berupa angka";
    }
}

function uploadGambar(&$errors) {
    
    $namaFile = $_FILES["gambar"]["name"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];
    
    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        $errors['error'] = "pilih gambar terlebih dahulu";
        return false;
    }
    
    // cek apakah yang diupload adalah gambar (cek ekstensi)
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile); // memecah string dengan delimiter .
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // ambil indeks terakhir
    
    // cek apakah ekstensi ada di ekstensigambarvalid
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $errors['error'] = "ekstensi gambar tidak valid";
        return false;
    }
    
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, "../../assets/img/produk/" . $namaFileBaru); 
    
    return $namaFileBaru;

}


?>