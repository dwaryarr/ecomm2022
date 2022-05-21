-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Bulan Mei 2022 pada 16.49
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
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detailorder` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`id_detailorder`, `stok`, `harga`, `id_order`, `id_produk`) VALUES
(1, 1, 40000, 1, 1),
(2, 1, 40000, 5, 1),
(3, 1, 60000, 9, 28),
(4, 1, 125000, 9, 3),
(5, 1, 40000, 10, 1);

--
-- Trigger `detail_order`
--
DELIMITER $$
CREATE TRIGGER `update_stokjual` AFTER INSERT ON `detail_order` FOR EACH ROW begin
update products
set stok=stok-new.stok where id_produk=new.id_produk;
end
$$
DELIMITER ;

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
(1, 'Game Online'),
(2, 'Akun Game Online');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id_order`, `tgl_order`, `id_pelanggan`) VALUES
(1, '2022-05-16 00:00:00', 3),
(2, '2022-05-16 00:00:00', 4),
(3, '2022-05-16 00:00:00', 5),
(4, '2022-05-16 00:00:00', 6),
(5, '2022-05-16 00:00:00', 7),
(6, '2022-05-16 00:00:00', 8),
(7, '2022-05-16 00:00:00', 9),
(8, '2022-05-16 00:00:00', 10),
(9, '2022-05-16 00:00:00', 11),
(10, '2022-05-16 00:00:00', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `name`, `email`, `alamat`, `telp`) VALUES
(1, NULL, '', '', '', ''),
(2, NULL, 'Admin', 'Admin1@dartgc.com', 'qwdw', '08223'),
(3, NULL, 'Admin', 'Admin1@dartgc.com', 'qwdw', '08223'),
(4, NULL, 'Admin1', 'Admin1@dartgc.com', 'smg', '08223'),
(5, NULL, 'Admin1', 'Admin1@dartgc.com', 'smg', '08223'),
(6, NULL, 'Admin1', 'Admin1@dartgc.com', 'SMG', '08223'),
(7, NULL, 'Admin1', 'Admin1@dartgc.com', 'SMG', '08223'),
(8, NULL, 'Admin1', 'Admin1@dartgc.com', 'SMG', '08223'),
(9, NULL, 'Admin1', 'Admin1@dartgc.com', 'SMG', '08223'),
(10, NULL, 'Admin1', 'Admin1@dartgc.com', 'SMG', '08223'),
(11, NULL, 'User2', 'user2@dartgc.com', 'SMG', '08111123456'),
(12, NULL, 'User2', 'user2@dartgc.com', 'DPK', '08111123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(10) DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id_produk`, `kode_produk`, `nama_produk`, `gambar`, `harga`, `stok`, `keterangan`, `kategori`) VALUES
(1, NULL, '300 VP', 'valorant.jpg', 40000, '20', 'Valorant Points', 'Game Online'),
(2, NULL, '625 VP', 'valorant.jpg', 65000, '10', 'Valorant Points', 'Game Online'),
(3, NULL, '1125 VP', 'valorant.jpg', 125000, '10', 'Valorant Points', 'Game Online'),
(4, NULL, '1650 VP', 'valorant.jpg', 175000, '10', 'Valorant Points', 'Game Online'),
(5, NULL, '1950 VP', 'valorant.jpg', 215000, '10', 'Valorant Points', 'Game Online'),
(6, NULL, '3400 VP', 'valorant.jpg', 350000, '10', 'Valorant Points', 'Game Online'),
(7, NULL, '7000 VP', 'valorant.jpg', 725000, '10', 'Valorant Points', 'Game Online'),
(8, NULL, '1200 PB Cash', 'PointBlankID.jpg', 10000, '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(9, NULL, '2400 PB Cash', 'PointBlankID.jpg', 19000, '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(10, NULL, '6000 PB Cash', 'PointBlankID.jpg', 49000, '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(11, NULL, '12000 PB Cash', 'PointBlankID.jpg', 98000, '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(12, NULL, '24000 PB Cash', 'PointBlankID.jpg', 197000, '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(13, NULL, '36000 PB Cash', 'PointBlankID.jpg', 295000, '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(14, NULL, '60000 PB Cash', 'PointBlankID.jpg', 490000, '10', 'Voucher Point Blank Zepetto', 'Game Online'),
(28, NULL, 'Valorant Account', 'Plat1.png', 60000, '1', 'RANK : PLAT 1\r\nSKIN : -\r\nSISA VP : 0\r\nSISA RP : 80\r\nTOTAL VP : -\r\nAGENT : UNLOCKED CHAMBER, KJ, NEON, VIPER\r\nBATTLEPASS : -\r\nCHANGE NICK : READY\r\nEMAIL : UNVERIFIED\r\nSTATUS : NON TRADE / BARTER', 'Akun Game Online');

--
-- Trigger `products`
--
DELIMITER $$
CREATE TRIGGER `delete_product` AFTER DELETE ON `products` FOR EACH ROW begin
insert into products_delete
(id_produk,
kode_produk,
nama_produk,
gambar,
harga,
stok,
keterangan,
kategori,
tgl_hapus,
nama_user
)
values
(old.id_produk,
old.kode_produk,
old.nama_produk,
old.gambar,
old.harga,
old.stok,
old.keterangan,
old.kategori,
SYSDATE(),
current_user
);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products_delete`
--

CREATE TABLE `products_delete` (
  `id_produk` int(11) NOT NULL DEFAULT 0,
  `kode_produk` varchar(10) DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tgl_hapus` date DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products_delete`
--

INSERT INTO `products_delete` (`id_produk`, `kode_produk`, `nama_produk`, `gambar`, `harga`, `stok`, `keterangan`, `kategori`, `tgl_hapus`, `nama_user`) VALUES
(30, NULL, '5000 VP', '', 6500000, '', 'Valorant Points', '', '2022-05-11', 'root@localhost'),
(31, NULL, '5000 VP', 'valorant3.jpg', 6500000, '1', 'VP', 'Game Online', '2022-05-11', 'root@localhost');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tambah_stok`
--

CREATE TABLE `tambah_stok` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tambah_stok`
--

INSERT INTO `tambah_stok` (`id`, `id_produk`, `stok`) VALUES
(1, 1, 1),
(2, NULL, NULL),
(3, 28, 1),
(4, 1, 12),
(5, 3, 1);

--
-- Trigger `tambah_stok`
--
DELIMITER $$
CREATE TRIGGER `update_tambahstok` AFTER INSERT ON `tambah_stok` FOR EACH ROW begin
update products set stok=stok+new.stok where id_produk=new.id_produk;
end
$$
DELIMITER ;

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
(1, 'Dwi Arya Ramadhani', 'dwiaryar@dartgc.com', 'default1.png', '3906c5555ce71f0213701ac3e501198a', 2, 1, 1648292358),
(2, 'Admin1', 'Admin1@dartgc.com', '52.png', '202cb962ac59075b964b07152d234b70', 1, 1, 1648292358),
(6, 'User2', 'user2@dartgc.com', 'default.png', '202cb962ac59075b964b07152d234b70', 2, 1, 1649819717);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 2),
(8, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'NullMenu'),
(4, 'Setting'),
(5, 'Menu'),
(6, 'Products'),
(7, 'test'),
(8, 'test2'),
(9, 'test3'),
(10, 'test4'),
(11, 'test5');

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
(2, 'Member'),
(3, 'Moderator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/dashboard', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'account/profile', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'account/edit', 'fas fa-fw fa-user-edit', 1),
(4, 1, 'User List', 'admin/userlist', 'fas fa-fw fa-address-book', 1),
(5, 4, 'Recovery Password', 'account/recovery', 'fas fa-fw fa-rotate', 1),
(6, 5, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(7, 5, 'SubMenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(8, 6, 'Tambah Data', 'products/tambah', 'fas fa-fw fa-plus', 1),
(9, 6, 'Edit Data', 'products/edit', 'fas fa-fw fa-pen-to-square', 0),
(10, 6, 'List Produk', 'products/index', 'fas fa-fw fa-list', 1),
(11, 2, 'Daftar Produk', 'member/daftarproduk', 'fas fa-fw fa-list', 1),
(15, 1, 'Test', 'test', 'test', 0),
(16, 6, 'Tambah Kategori', 'products/tambahkategori', 'fas fa-fw fa-plus', 1),
(17, 6, 'Tambah Stok Produk', 'products/tambahstok', 'fas fa-fw fa-plus', 1),
(18, 2, 'Riwayat Transaksi', 'products/riwayat', 'fas fa-fw fa-history', 1),
(19, 4, 'Change Password', 'account/edit/changepassword', 'fas fa-fw fa-key', 1),
(22, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detailorder`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tambah_stok`
--
ALTER TABLE `tambah_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_detailorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tambah_stok`
--
ALTER TABLE `tambah_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
