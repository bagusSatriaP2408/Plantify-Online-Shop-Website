<?php
require_once('base.php');

function getAllDataProducts()
{
	try {
		$statement = DB->prepare("SELECT * FROM produk");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}
function getNewProducts()
{
	try {
		$statement = DB->prepare("SELECT * FROM produk ORDER BY created_at DESC LIMIT 1");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}
function getAllDataProductsWithDetails()
{
	try {
		$statement = DB->prepare("SELECT * FROM produk JOIN kategori ON kategori.id_kategori = produk.id_kategori");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}
function getAllCategories()
{
	try {
		$statement = DB->prepare("SELECT * FROM kategori");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}
// function getAllDataProductsWithDetailsByCategory($kodeKat)
// {
// 	global $db;
// 	try {
// 		$statement = $db->prepare("SELECT * FROM products JOIN categories ON categories.kodeKategori = products.kodeKategori WHERE products.kodeKategori = :kodeKat");
// 		$statement->bindValue(':kodeKat', $kodeKat);
// 		$statement->execute();
// 		return $statement->fetchAll(PDO::FETCH_ASSOC);
// 	} catch (PDOException $err) {
// 		echo $err->getMessage();
// 	}
// }

// function getDataProductsByCategory($kodeKategori)
// {
// 	global $db;
// 	try {
// 		$statement = $db->prepare("SELECT * FROM products JOIN categories ON products.kodeKategori=categories.kodeKategori WHERE categories.kodeKategori = :kodeKategori");
// 		$statement->bindValue(':kodeKategori', $kodeKategori);
// 		$statement->execute();
// 		return $statement->fetchAll(PDO::FETCH_ASSOC);
// 	} catch (PDOException $err) {
// 		echo $err->getMessage();
// 	}
// }

// function getDataProduct($kodeProduk)
// {
// 	global $db;
// 	try {
// 		$statement = $db->prepare("SELECT * FROM products where kodeProduk = :kodeProduk");
// 		$statement->bindValue(':kodeProduk', $kodeProduk);
// 		$statement->execute();
// 		return $statement->fetchAll(PDO::FETCH_ASSOC);
// 	} catch (PDOException $err) {
// 		echo $err->getMessage();
// 	}
// }

// function insertProduct($data)
// {
// 	// ambil data file
// 	$namaFile = $data[1]['gambar']['name'];
// 	$namaSementara = $data[1]['gambar']['tmp_name'];

// 	// tentukan lokasi file akan dipindahkan
// 	// $direktori = BASEPATH."\assets\images\products";
// 	$direktori = BASEPATH . "/assets/images/products/";


// 	// Pengecekan tipe file
// 	$allowedTypes = array("image/jpeg", "image/jpg", "image/png"); // Tipe file yang diizinkan
// 	if (!in_array($data[1]['gambar']['type'], $allowedTypes)) {
// 		echo "Tipe file tidak diizinkan. Hanya gambar JPEG, JPG, PNG yang diizinkan.";
// 	}

// 	// Pengecekan ukuran file
// 	$maxSize = 5 * 1024 * 1024; // Maksimal ukuran file 5 MB
// 	if ($data[1]['gambar']['size'] > $maxSize) {
// 		echo "Ukuran file terlalu besar. Maksimal ukuran file adalah 5 MB.";
// 	}

// 	// Ubah nama file
// 	$namaFileBaru = $data[0]["kodeProduk"] . '_' . $namaFile; // Membuat nama unik dengan fungsi uniqid

// 	// Pindahkan file jika tipe dan ukuran sesuai
// 	if (move_uploaded_file($namaSementara, $direktori . $namaFileBaru)) {
// 		echo "Gambar berhasil diunggah";
// 	} else {
// 		echo "Terjadi kesalahan saat mengunggah gambar.";
// 	}

// 	$kodePro = $data[0]["kodeProduk"];
// 	$kodeKat = $data[0]["kodeKategori"];
// 	$namaPro = $data[0]["namaProduk"];
// 	$gambarPro = $namaFileBaru;
// 	$hargaPro = $data[0]["hargaProduk"];
// 	$stokPro = $data[0]["stokProduk"];

// 	global $db;
// 	try {
// 		$statement = $db->prepare("INSERT INTO products(kodeProduk, kodeKategori, namaProduk, gambarProduk, hargaProduk, stokProduk) VALUES (:kodePro, :kodeKat, :namaPro, :gambarPro, :hargaPro, :stokPro)");
// 		$statement->bindValue(':kodePro', $kodePro);
// 		$statement->bindValue(':kodeKat', $kodeKat);
// 		$statement->bindValue(':namaPro', $namaPro);
// 		$statement->bindValue(':gambarPro', $gambarPro);
// 		$statement->bindValue(':hargaPro', $hargaPro);
// 		$statement->bindValue(':stokPro', $stokPro);
// 		$statement->execute();
// 		header("location:" . BASEURL . "/app/admin/manajemen_produk.php");
// 	} catch (PDOException $err) {
// 		echo "Insert data produk gagal";
// 		echo $err->getMessage();
// 	}
// }

// function editProduct($data)
// {
// 	if (empty($data[1]['gambar']['name'])) {
// 		$namaFileBaru = $data[0]["gambar_lama"];
// 	} else {
// 		// ambil data file
// 		$namaFile = $data[1]['gambar']['name'];
// 		$namaSementara = $data[1]['gambar']['tmp_name'];

// 		// tentukan lokasi file akan dipindahkan
// 		// $direktori = BASEPATH."\assets\images\products";
// 		$direktori = BASEPATH . "/assets/images/products/";


// 		// Pengecekan tipe file
// 		$allowedTypes = array("image/jpeg", "image/jpg", "image/png"); // Tipe file yang diizinkan
// 		if (!in_array($data[1]['gambar']['type'], $allowedTypes)) {
// 			echo "Tipe file tidak diizinkan. Hanya gambar JPEG, JPG, PNG yang diizinkan.";
// 		}

// 		// Pengecekan ukuran file
// 		$maxSize = 5 * 1024 * 1024; // Maksimal ukuran file 5 MB
// 		if ($data[1]['gambar']['size'] > $maxSize) {
// 			echo "Ukuran file terlalu besar. Maksimal ukuran file adalah 5 MB.";
// 		}

// 		// Ubah nama file
// 		$namaFileBaru = $data[0]["kodeProduk"] . '_' . $namaFile; // Membuat nama unik dengan fungsi uniqid

// 		// Pindahkan file jika tipe dan ukuran sesuai
// 		if (move_uploaded_file($namaSementara, $direktori . $namaFileBaru)) {
// 			echo "Gambar berhasil diunggah";
// 		} else {
// 			echo "Terjadi kesalahan saat mengunggah gambar.";
// 		}
// 	}

// 	$kodePro = $data[0]["kodeProduk"];
// 	$kodeKat = $data[0]["kodeKategori"];
// 	$namaPro = $data[0]["namaProduk"];
// 	$gambarPro = $namaFileBaru;
// 	$hargaPro = $data[0]["hargaProduk"];
// 	$stokPro = $data[0]["stokProduk"];

// 	global $db;
// 	try {
// 		$statement = $db->prepare("UPDATE products set kodeProduk = :kodePro, kodeKategori = :kodeKat, namaProduk =  :namaPro, gambarProduk = :gambarPro, hargaProduk=:hargaPro, stokProduk=:stokPro where kodeProduk = :kodePro");
// 		$statement->bindValue(':kodePro', $kodePro);
// 		$statement->bindValue(':kodeKat', $kodeKat);
// 		$statement->bindValue(':namaPro', $namaPro);
// 		$statement->bindValue(':gambarPro', $gambarPro);
// 		$statement->bindValue(':hargaPro', $hargaPro);
// 		$statement->bindValue(':stokPro', $stokPro);
// 		$statement->execute();
// 		header("location:" . BASEURL . "/app/admin/manajemen_produk.php");
// 	} catch (PDOException $err) {
// 		echo "Update data produk gagal";
// 		echo $err->getMessage();
// 	}
// }

// function deleteProduct($kodePro)
// {
// 	global $db;
// 	try {
// 		$statement = $db->prepare("DELETE FROM products WHERE kodeProduk = :kodePro");
// 		$statement->bindValue(':kodePro', $kodePro);
// 		$statement->execute();
// 		header("location:" . BASEURL . "/app/admin/manajemen_produk.php");
// 	} catch (PDOException $err) {
// 		echo "Delete data produk gagal";
// 		echo $err->getMessage();
// 	}
// }
