-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 08:15 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detailorder` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Game Online'),
(2, 'Akun Game Online');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
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
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_produk`, `kode_produk`, `nama_produk`, `gambar`, `harga`, `stok`, `keterangan`, `kategori`) VALUES
(1, NULL, '300 VP', 'valorant.jpg', 40000, '10', 'Valorant Points', 'Game Online'),
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
-- Triggers `products`
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
-- Table structure for table `products_delete`
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
-- Dumping data for table `products_delete`
--

INSERT INTO `products_delete` (`id_produk`, `kode_produk`, `nama_produk`, `gambar`, `harga`, `stok`, `keterangan`, `kategori`, `tgl_hapus`, `nama_user`) VALUES
(30, NULL, '5000 VP', '', 6500000, '', 'Valorant Points', '', '2022-05-11', 'root@localhost'),
(31, NULL, '5000 VP', 'valorant3.jpg', 6500000, '1', 'VP', 'Game Online', '2022-05-11', 'root@localhost');

-- --------------------------------------------------------

--
-- Table structure for table `products_hapus`
--

CREATE TABLE `products_hapus` (
  `prod_id` varchar(10) NOT NULL,
  `prod_code` varchar(10) DEFAULT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `tgl_hapus` date DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Dwi Arya Ramadhani', 'dwiaryar@dartgc.com', 'default1.png', '3906c5555ce71f0213701ac3e501198a', 2, 1, 1648292358),
(2, 'Admin1', 'Admin1@dartgc.com', '52.png', '202cb962ac59075b964b07152d234b70', 1, 1, 1648292358),
(6, 'User2', 'user2@dartgc.com', 'default.png', '202cb962ac59075b964b07152d234b70', 2, 1, 1649819717);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 2),
(8, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Action'),
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
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
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
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/dashboard', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'account/profile', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'account/edit', 'fas fa-fw fa-user-edit', 1),
(4, 1, 'User List', 'account/userlist', 'fas fa-fw fa-address-book', 1),
(5, 4, 'Recovery Password', 'account/recovery', 'fas fa-fw fa-rotate', 1),
(6, 5, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(7, 5, 'SubMenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(8, 6, 'Tambah Data', 'products/tambah', 'fas fa-fw fa-plus', 1),
(9, 6, 'Edit Data', 'products/edit', 'fas fa-fw fa-pen-to-square', 0),
(10, 6, 'List Produk', 'products/index', 'fas fa-fw fa-list', 1),
(11, 2, 'Daftar Produk', 'member/daftarproduk', 'fas fa-fw fa-list', 1),
(15, 1, 'Test', 'test', 'test', 0),
(16, 6, 'Tambah Kategori', 'products/tambahkategori', 'fas fa-fw fa-plus', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detailorder`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_detailorder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
