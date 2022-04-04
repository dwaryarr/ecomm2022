-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Apr 2022 pada 05.55
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm2022`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Game Online');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `nama_produk`, `gambar`, `harga`, `stok`, `keterangan`, `kategori`) VALUES
(1, '300 VP', 'valorant.jpg', '40000', '10', 'Valorant Points', 'Game Online'),
(2, '625 VP', 'valorant.jpg', '65000', '10', 'Valorant Points', 'Game Online'),
(3, '1125 VP', 'valorant.jpg', '125000', '10', 'Valorant Points', 'Game Online'),
(4, '1650 VP', 'valorant.jpg', '175000', '10', 'Valorant Points', 'Game Online'),
(5, '1950 VP', 'valorant.jpg', '215000', '10', 'Valorant Points', 'Game Online'),
(6, '3400 VP', 'valorant.jpg', '350000', '10', 'Valorant Points', 'Game Online'),
(7, '7000 VP', 'valorant.jpg', '725000', '10', 'Valorant Points', 'Game Online'),
(8, '1200 PB Cash', 'PointBlankID.jpg', '10000', '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(9, '2400 PB Cash', 'PointBlankID.jpg', '19000', '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(10, '6000 PB Cash', 'PointBlankID.jpg', '49000', '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(11, '12000 PB Cash', 'PointBlankID.jpg', '98000', '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(12, '24000 PB Cash', 'PointBlankID.jpg', '197000', '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(13, '36000 PB Cash', 'PointBlankID.jpg', '295000', '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(14, '60000 PB Cash', 'PointBlankID.jpg', '490000', '10', 'Voucher Point Blank Zepetto', 'Game Online');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Dwi Arya Ramadhani', 'dwiaryar@dartgc.com', 'default.png', '3906c5555ce71f0213701ac3e501198a', 2, 1, 1647837610),
(2, 'Admin', 'Admin1@dartgc.com', 'default.png', '202cb962ac59075b964b07152d234b70', 1, 1, 1648217682);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
