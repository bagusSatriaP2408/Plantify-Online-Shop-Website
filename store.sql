-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Nov 2023 pada 08.36
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--
CREATE DATABASE IF NOT EXISTS `store` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `store`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('jony1111', 'bf73ab106dd097a9d2a1d63a07825bf34496734f6dd65877a9d29125b3d0ef34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`id_bank`, `nama_bank`) VALUES
(1, 'Mandiri'),
(2, 'BCA'),
(3, 'BRI'),
(4, 'BNI'),
(5, 'CIMB Niaga'),
(6, 'Permata');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`username`, `password`, `nama`, `no_telepon`, `alamat`) VALUES
('jony2222', '2f6205701e5a247cd3ec262511e56b6a7a4ad3b4e49144dac97937ae704024b5', 'jony', '123456789101', 'iraq Jawa barat'),
('jony4321', 'efa87211c6f8b2e588da402546a8a17e09853528e9e5833fd659451cf4275b8b', 'jony', '123456789101', 'irlandia'),
('test1234', '937e8d5fbb48bd4949536cd65b8d35c426b80d2f830c5c308e2cdec422ae2244', 'Test', '123742588852', 'Mexico');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Bonsai Buah'),
(3, 'Bonsai Bunga'),
(4, 'Bonsai Conifer'),
(5, 'Bonsai Daun Lebar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang_detail`
--

CREATE TABLE `keranjang_detail` (
  `id_keranjang_detail` int(11) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `manajer`
--

CREATE TABLE `manajer` (
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `manajer`
--

INSERT INTO `manajer` (`username`, `password`) VALUES
('jony12345', '17d8c0405070683f2e5e235ac1eb1e99eca1f798334933f16cdbd4726722b798');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `total_order` int(11) NOT NULL,
  `tanggal_order` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_bank` int(11) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_supplier`, `nama_produk`, `harga_produk`, `stok_produk`, `gambar_produk`, `id_kategori`, `created_at`) VALUES
(11, 2, 'Bonsai Jeruk', 150000, 10, '655862559e56d.jpeg', 2, '2023-11-18 07:05:57'),
(12, 4, 'Bonsai Apel', 180000, 8, '6558636905db9.jpeg', 2, '2023-11-18 07:10:33'),
(13, 3, 'Bonsai Anggur', 100000, 15, '655863f28b5d7.jpeg', 2, '2023-11-18 07:12:50'),
(14, 2, 'Bonsai Plum', 160000, 7, '6558642fe0ce4.jpeg', 2, '2023-11-18 07:13:51'),
(15, 6, 'Bonsai Persik', 200000, 5, '6558647ba7906.jpeg', 2, '2023-11-18 07:15:07'),
(16, 2, 'Bonsai Delima', 180000, 9, '655864c40dc18.jpeg', 2, '2023-11-18 07:16:20'),
(17, 5, 'Bonsai Sakura', 190000, 3, '655864fad59be.jpeg', 3, '2023-11-18 07:17:14'),
(18, 4, 'Bonsai Mawar', 80000, 18, '6558652e881e7.jpeg', 3, '2023-11-18 07:18:06'),
(19, 5, 'Bonsai Azalea', 150000, 10, '65586570403f4.jpeg', 3, '2023-11-18 07:19:12'),
(20, 6, 'Bonsai Camellia', 170000, 12, '655865979afea.jpeg', 3, '2023-11-18 07:19:51'),
(21, 3, 'Bonsai Lily', 120000, 15, '655865d847de3.jpeg', 3, '2023-11-18 07:20:56'),
(22, 2, 'Bonsai Bunga Matahari', 60000, 20, '655865f5aeea6.jpeg', 3, '2023-11-18 07:21:25'),
(23, 4, 'Bonsai Wisteria', 180000, 4, '6558662031437.jpeg', 3, '2023-11-18 07:22:08'),
(24, 2, 'Bonsai Pine', 150000, 6, '6558664d777fb.jpeg', 4, '2023-11-18 07:22:53'),
(25, 6, 'Bonsai Juniper', 120000, 8, '65586676e7583.jpeg', 4, '2023-11-18 07:23:34'),
(26, 5, 'Bonsai Maple', 130000, 7, '655866e09e5b6.jpeg', 5, '2023-11-18 07:26:41'),
(27, 6, 'Bonsai Ficus', 70000, 25, '6558679a575f6.jpeg', 5, '2023-11-18 07:28:26'),
(28, 4, 'Bonsai Jade', 50000, 30, '655867ca42393.jpeg', 5, '2023-11-18 07:29:14'),
(29, 3, 'Bonsai Oak', 170000, 10, '655867edf1c3f.jpeg', 5, '2023-11-18 07:29:49'),
(30, 4, 'Bonsai Spruce', 140000, 10, '65586839f3d63.jpeg', 4, '2023-11-18 07:31:06'),
(31, 5, 'Bonsai Cedar', 120000, 8, '6558685b11afc.jpeg', 4, '2023-11-18 07:31:39'),
(32, 6, 'Bonsai Yew', 160000, 12, '655868fe52be8.jpeg', 4, '2023-11-18 07:34:22'),
(33, 2, 'Bonsai Fir', 130000, 15, '6558692c842cf.jpeg', 4, '2023-11-18 07:35:08'),
(34, 3, 'Bonsai Larch', 150000, 7, '6558694d0854f.jpeg', 4, '2023-11-18 07:35:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telepon`) VALUES
(2, 'Bonsai World', 'Jl. Bonsai No. 123, Kota Bonsai', '081234567890'),
(3, 'Green Gardens', 'Jl. Kebun Bonsai 5, Kota Bonsai', '085678901234'),
(4, 'Nature\'s Art', 'Jl. Indah Bonsai 8, Desa Bonsai', '081112223344'),
(5, 'Bonsai Jaya', 'Jl. Bunga Indah No. 123, Kota Bonsai', '081234567890'),
(6, 'Bonsai Berkah', 'Jl. Cinta Alam 15, Perkampungan Bonsai', '089912345678');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `FK_Menambahkan` (`username`);

--
-- Indeks untuk tabel `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  ADD PRIMARY KEY (`id_keranjang_detail`),
  ADD KEY `FK_keranjang_memiliki` (`id_keranjang`),
  ADD KEY `FK_menambahkan_produk` (`id_produk`);

--
-- Indeks untuk tabel `manajer`
--
ALTER TABLE `manajer`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `FK_pesan` (`username`),
  ADD KEY `id_bank` (`id_bank`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `FK_memiliki_order` (`id_order`),
  ADD KEY `FK_pesan_produk` (`id_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `FK_supply` (`id_supplier`),
  ADD KEY `FK_memiliki_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  MODIFY `id_keranjang_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `FK_Menambahkan` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

--
-- Ketidakleluasaan untuk tabel `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  ADD CONSTRAINT `FK_keranjang_memiliki` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id_keranjang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_menambahkan_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_pesan` FOREIGN KEY (`username`) REFERENCES `customer` (`username`),
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`);

--
-- Ketidakleluasaan untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_memiliki_order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`),
  ADD CONSTRAINT `FK_pesan_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `FK_memiliki_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `FK_supply` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
