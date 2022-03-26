/*
SQLyog - Free MySQL GUI v5.02
Host - 5.5.5-10.4.18-MariaDB : Database - ecomm2022
*********************************************************************
Server version : 5.5.5-10.4.18-MariaDB
*/


create database if not exists `ecomm2022`;

USE `ecomm2022`;

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `stok` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `products` */

insert into `products` values 
(1,'300 VP','assets/images/valorant.jpg','40000','10','Valorant Points'),
(2,'625 VP','assets/images/valorant.jpg','65000','10','Valorant Points'),
(3,'1125 VP','assets/images/valorant.jpg','125000','10','Valorant Points'),
(4,'1650 VP','assets/images/valorant.jpg','175000','10','Valorant Points'),
(5,'1950 VP','assets/images/valorant.jpg','215000','10','Valorant Points'),
(6,'3400 VP','assets/images/valorant.jpg','350000','10','Valorant Points'),
(7,'7000 VP','assets/images/valorant.jpg','725000','10','Valorant Points'),
(8,'1200 PB Cash','assets/images/PointBlankID.jpg','10000','10','Voucher Point Blank Zepetto'),
(9,'2400 PB Cash','assets/images/PointBlankID.jpg','19000','10','Voucher Point Blank Zepetto'),
(10,'6000 PB Cash','assets/images/PointBlankID.jpg','49000','10','Voucher Point Blank Zepetto'),
(11,'12000 PB Cash','assets/images/PointBlankID.jpg','98000','10','Voucher Point Blank Zepetto'),
(12,'24000 PB Cash','assets/images/PointBlankID.jpg','197000','10','Voucher Point Blank Zepetto'),
(13,'36000 PB Cash','assets/images/PointBlankID.jpg','295000','10','Voucher Point Blank Zepetto'),
(14,'60000 PB Cash','assets/images/PointBlankID.jpg','490000','10','Voucher Point Blank Zepetto');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert into `user` values 
(1,'Dwi Arya Ramadhani','dwiaryar@dartgc.com','default.jpg','3906c5555ce71f0213701ac3e501198a',2,1,1647837610);

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role` */

insert into `user_role` values 
(1,'Administrator'),
(2,'Member');
