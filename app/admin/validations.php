<?php 

require_once('../base.php');

function checkRequired($field) {
    return empty(trim($field));
}

function checkAlphabet($field) {
    $pattern = "/^[a-zA-Z\s]+$/";
    return preg_match($pattern, $field);
}

function checkNumeric($field) {
    $pattern = "/^[0-9]+$/";
    return preg_match($pattern, $field);
}

// validasi inputan nama (required, alfabet)
function validateNamaProduk(&$errors, $nama_produk) {
    if (checkRequired($nama_produk)) {
        $errors["nama_produk"] = "nama produk tidak boleh kosong";
    } else {
        if (!checkAlphabet($nama_produk)) {
            $errors["nama_produk"] = "nama produk harus berupa alfabet";
        } else {
            $errors["nama_produk"] = "";
        }
    }
}

// validasi inputan telepon (required, numeric, panjang digit)
function validateTel(&$errors, $tel) {
    if (checkRequired($tel)) {
        $errors["tel"] = "nomor telepon tidak boleh kosong";
    } else {
        if (!checkNumeric($tel)) {
            $errors["tel"] = "nomor telepon harus berupa angka";
        } else if (strlen($tel) < 12) {
            $errors["tel"] = "tidak boleh kurang dari 12 digit";
        } else {
            $errors["tel"] = "";
        }
    }
}

// validasi inputan alamat (required)
function validateAlamat(&$errors, $address) {
    if (checkRequired($address)) {
        $errors["address"] = "alamat tidak boleh kosong";
    } else {
        $errors["address"] = "";
    }
}

function validasiTambahProduk (&$errors, $inputan) {
    if (checkRequired($inputan['nama_produk']) || checkRequired($inputan['harga']) || checkRequired($inputan['stok']) || $inputan['kategori'] == 0 || $inputan['supplier'] == 0) {
        $errors['error'] = "data produk tidak boleh ada yang kosong";
    } else if (!checkAlphabet($inputan['nama_produk'])) {
        $errors['error'] = "nama produk harus berupa alfabet";
    } else if (!checkNumeric($inputan['harga'])) {
        $errors['error'] = "harga produk harus berupa angka";
    } else if (!checkNumeric($inputan['stok'])) {
        $errors['error'] = "stok produk harus berupa angka";
    }
}

function upload() {

    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar (cek ekstensi)
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile); // memecah string dengan delimiter .
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // ambil indeks terakhir

    // cek apakah ekstensi ada di ekstensigambarvalid
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang diupload bukan gambar');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;

}


?>