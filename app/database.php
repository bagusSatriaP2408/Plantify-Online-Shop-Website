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



function insertOrder($username,$total,$rekening,$bank,$id_keranjang)
{
	try {
		$statement = DB->prepare("INSERT INTO `order` (username,total_order,id_bank,no_rekening) 
		VALUES (:username,:total_order,:id_bank,:no_rekening)");
		$statement->execute(array(':username' => $username,
								':total_order'=> $total,
								':id_bank' => $bank,
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
		$statement = DB->prepare("SELECT id_order,tanggal_order,total_order,no_rekening,nama_bank,status 
		FROM `order` o JOIN bank b ON o.id_bank = b.id_bank WHERE username = :username ORDER BY status,tanggal_order DESC");
		$statement->execute([':username'=>$username]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getOrderbyId($username,$id)
{
	try {
		$statement = DB->prepare("SELECT id_order,tanggal_order,total_order,no_rekening,nama_bank,status ,o.id_bank
		FROM `order` o JOIN bank b ON o.id_bank = b.id_bank WHERE username = :username AND id_order=:id_order");
		$statement->execute([':username'=>$username,':id_order'=> $id]);
		return $statement->fetch(PDO::FETCH_ASSOC);
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

function deleteOrderById($id)
{
	try {
		$statement = DB->prepare("DELETE FROM order_detail WHERE id_order = :id");
		$statement->execute(array(":id" => $id));
		$statement = DB->prepare("DELETE FROM `order` WHERE id_order = :id");
		$statement->execute(array(":id" => $id));
		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
		
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function updateOrder($id_bank,$no_rekening,$id)
{
	try {
		$statement = DB->prepare("UPDATE `order` SET id_bank=:id_bank ,no_rekening=:no_rekening where id_order=:id");
		$statement->execute(array(":id_bank" => $id_bank,':no_rekening' => $no_rekening,':id'=>$id));
		header("Location: daftar_transaksi.php");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function updateStatusOrder($id)
{
	try {
		$statement = DB->prepare("UPDATE `order` SET status=:satu where id_order=:id");
		$statement->execute(array(":satu" => 1,':id'=>$id));
		$stat1 = DB->prepare("SELECT p.id_produk,jumlah_produk,stok_produk FROM order_detail od 
		JOIN produk p ON p.id_produk = od.id_produk WHERE id_order=:id ");
		$stat1->execute(array(':id'=>$id));
		$products = $stat1->fetchAll(PDO::FETCH_ASSOC);
		foreach($products as $product){
			$stat2 = DB->prepare("UPDATE `produk` SET stok_produk=:jumlah where id_produk=:id");
			$stokUpdate = $product['stok_produk']-$product['jumlah_produk'];
			$stat2->execute(array(":jumlah" =>$stokUpdate ,':id'=>$product['id_produk']));
		}
		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}



















//-------------------------------Admin------------------------------------------

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

function deleteProduct($id) 
{
	try {
		$statement = DB->prepare("DELETE FROM produk WHERE id_produk = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getProductById($id) 
{
	try {
		$statement = DB->prepare("SELECT * FROM produk WHERE id_produk = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function deleteSupplier($id) 
{
	try {
		$statement = DB->prepare("DELETE FROM supplier WHERE id_supplier = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getSupplierById($id) {
	try {
		$statement = DB->prepare("SELECT * FROM supplier WHERE id_supplier = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getAllOrder()
{
	try {
		$statement = DB->prepare("SELECT * FROM `order` o JOIN bank b on o.id_bank=b.id_bank ORDER BY status,tanggal_order DESC");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// ---------------------------end Admin ----------------------------------------




//-------------------------------Manajer------------------------------------------

function getAllProducts() 
{
	try {
		$statement = DB->prepare("SELECT * FROM produk");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getAllOrders($status) 
{
	try {
		$statement = DB->prepare("SELECT * FROM `order` WHERE status = :status");
		$statement->execute([":status"=>$status]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getAllOrderByStatusAndTime($time1,$time2,$status)
{
	try {
		$statement = DB->prepare("SELECT * FROM `order` WHERE (tanggal_order BETWEEN :time1 AND :time2) 
		AND status=:status");
		$statement->execute([':time1'=>$time1,':time2'=>$time2,':status'=>$status]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// ---------------------------end Manajer ----------------------------------------
