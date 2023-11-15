<?php
require_once('base.php');




//-------------------------------Profile------------------------------------------
function getDataDiri($username)
{
	try {
		$statement = DB->prepare("SELECT * FROM customer WHERE username = :username");
		$statement->bindValue(":username",$username);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// ---------------------------end Profile ----------------------------------------

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
// function getAllDataProductsWithDetails()
// {
// 	try {
// 		$statement = DB->prepare("SELECT * FROM produk JOIN kategori ON kategori.id_kategori = produk.id_kategori");
// 		$statement->execute();
// 		return $statement->fetchAll(PDO::FETCH_ASSOC);
// 	} catch (PDOException $err) {
// 		echo $err->getMessage();
// 	}
// }
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

function getAllDataProductsWithDetailsByCategory($kodeKat)
{
	try {
		$statement = DB->prepare("SELECT * FROM produk JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE produk.id_kategori = :kodeKat");
		$statement->bindValue(':kodeKat', $kodeKat);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

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

// Keranjang

// function insertKeranjang($username)
// {
// 	try{
// 		$statement = DB->prepare("INSERT INTO keranjang (username) VALUES (:username)");
// 		$username->bindValue(':username',$username);
// 		$statement->execute();
// 		return $statement->fetch(PDO::FETCH_ASSOC);
// 	}catch(PDOException $err){
// 		echo $err->getMessage();
// 	}
// }

function getKeranjang($username)
{
	try{
		$statement = DB->prepare("SELECT kd.id_produk,kd.id_keranjang,nama_produk,harga_produk,stok_produk,gambar_produk, count(*) as jml FROM keranjang_detail kd JOIN produk p ON kd.id_produk = p.id_produk JOIN keranjang k ON k.id_keranjang = kd.id_keranjang WHERE username = :username GROUP BY id_produk");
		$statement->bindValue(':username',$username);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $err) 
	{
		echo $err->getMessage();
	}
}

function getCartCode($username)
{
	try {
		$statement = DB->prepare("SELECT id_keranjang FROM keranjang WHERE username = :username");
		$statement->bindValue(':username', $username);
		$statement->execute();
		if($statement->rowcount() > 0)
		{
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
		else{
			$statement1 = DB->prepare("INSERT INTO keranjang (username) VALUES (:username)");
			$statement1->bindValue(':username', $username);
			$statement1->execute();
			$statement = DB->prepare("SELECT id_keranjang FROM keranjang WHERE username = :username");
			$statement->bindValue(':username', $username);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}
function insertCart($username, $id_produk)
{
	$id_keranjang = getCartCode($username);
	try {
		$statement = DB->prepare("INSERT INTO keranjang_detail(id_keranjang,id_produk) VALUES (:id_keranjang,:id_produk)");
		$statement->bindValue(':id_keranjang', $id_keranjang['id_keranjang']);
		$statement->bindValue(':id_produk', $id_produk);
		$statement->execute();

		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}
// function getAllProductsInCarts($kodePelanggan)
// {
// 	try {
// 		$statement = DB->prepare("SELECT cartdetails.kodeProduk, namaProduk,gambarProduk, categories.namaKategori,
// 		 hargaProduk, COUNT(*) AS jumlah_item FROM cartdetails JOIN carts ON cartdetails.kodeKeranjang = carts.kodeKeranjang 
// 		 JOIN products ON cartdetails.kodeProduk = products.kodeProduk JOIN categories ON products.kodeKategori=categories.kodeKategori
// 		  where carts.kodePelanggan=:kodePelanggan GROUP BY cartdetails.kodeProduk");
// 		$statement->bindValue(':kodePelanggan', $kodePelanggan);
// 		$statement->execute();
// 		return $statement->fetchAll(PDO::FETCH_ASSOC);
// 	} catch (PDOException $err) {
// 		echo $err->getMessage();
// 	}
// }
function deleteProductInCart($id_produk, $id_keranjang,$hapus)
{
	// $kodeKeranjang = getCartCode($kodePelanggan);
	if($hapus===0){
		$query = "DELETE FROM keranjang_detail WHERE id_keranjang=:id_keranjang AND id_produk=:id_produk ORDER BY id_keranjang_detail DESC LIMIT 1";
	}elseif($hapus===1){
		$query = "DELETE FROM keranjang_detail WHERE id_keranjang=:id_keranjang AND id_produk=:id_produk ORDER BY id_keranjang_detail";
	}
	try {
		$statement = DB->prepare($query);
		$statement->bindValue(':id_keranjang', $id_keranjang);
		$statement->bindValue(':id_produk', $id_produk);
		$statement->execute();

		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}
function increaseProductInCart($id_produk, $id_keranjang)
{
	// $kodeKeranjang = getCartCode($kodePelanggan);
	try {
		$statement = DB->prepare("INSERT INTO  keranjang_detail(id_keranjang,id_produk) VALUES (:id_keranjang,:id_produk)");
		$statement->bindValue(':id_keranjang', $id_keranjang);
		$statement->bindValue(':id_produk', $id_produk);
		$statement->execute();

		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

 function getAllBank()
 {
	try {
		$statement = DB->prepare("SELECT * FROM bank");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
 }

 function getAllPengiriman()
 {
	try {
		$statement = DB->prepare("SELECT * FROM metode_pengiriman");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
 }

 function insertOrder($username,$total,$pengiriman,$rekening,$bank,$id_keranjang)
 {
	try {
		$statement = DB->prepare("INSERT INTO `order` (username,total_order,id_pengiriman,id_bank,id_order_status,no_rekening) 
		VALUES (:username,:total_order,:id_pengiriman,:id_bank,:id_order_status,:no_rekening)");
		$statement->execute(array(':username' => $username,
								':total_order'=> $total,
								':id_pengiriman' => $pengiriman,
								':id_bank' => $bank,
								':id_order_status' => 1,
								':no_rekening'=> $rekening
							));
		
		$id = DB->lastInsertId();
		$stat1 = DB->prepare("DELETE FROM keranjang_detail WHERE id_keranjang = :id_keranjang");
		$stat1->execute(array(':id_keranjang' => $id_keranjang));
		$stat2 = DB->prepare("DELETE FROM keranjang WHERE id_keranjang = :id_keranjang");
		$stat2->execute(array(':id_keranjang' => $id_keranjang));

		return $id;


	} catch (PDOException $err) {
		echo $err->getMessage();
	}
 }

 function insertOrderDetail($id_order,$id_produk,$jumlah,$total_harga)
 {
	try {
		$statement = DB->prepare("INSERT INTO `order_detail` (id_order,id_produk,jumlah_produk,harga_total) 
		VALUES (:id_order,:id_produk,:jumlah,:total_harga)");
		$statement->execute(array(':id_order' => $id_order,
								':id_produk'=> $id_produk,
								':jumlah' => $jumlah,
								':total_harga' => $total_harga,
		));
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
 }

 function getOrder($username)
 {
	try {
		$statement = DB->prepare("SELECT id_order,tanggal_order,total_order,no_rekening,nama_ekspedisi,nama_bank,status 
		FROM `order` o JOIN metode_pengiriman mp ON o.id_pengiriman = mp.id_pengiriman 
		JOIN bank b ON o.id_bank = b.id_bank JOIN order_status os ON o.id_order_status = os.id_order_status
		WHERE username = :username");
		$statement->execute([':username'=>$username]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
 }
 function getDetailOrder($id){
	try {
		$statement = DB->prepare("SELECT * FROM order_detail od JOIN produk p ON od.id_produk = p.id_produk
		 WHERE id_order = :id_order");
		$statement->execute([':id_order'=>$id]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
 }

function getAllDataCustomer()
{
	try {
		$statement = DB->prepare("SELECT * FROM customer");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getAllDataSupplier()
{
	try {
		$statement = DB->prepare("SELECT * FROM supplier");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function deleteProduct($id) {
	try {
		$statement = DB->prepare("DELETE FROM produk WHERE id_produk = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getProductById($id) {
	try {
		$statement = DB->prepare("SELECT * FROM produk WHERE id_produk = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function upload() {
    
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

    move_uploaded_file($tmpName, "../../assets/img/" . $namaFileBaru); 
    
    return $namaFileBaru;

}

function updateProduct($data) {
	try {
		$nama_produk = htmlspecialchars($data['nama_produk']);
		$harga = htmlspecialchars($data['harga']);
		$stok = htmlspecialchars($data['stok']);
		$kategori = $data['kategori'];
		$sup = $data['supplier'];
		$gambar = upload();

		$stat = DB->prepare("SELECT * FROM produk WHERE id_produk = :id");
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
