/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 8.0.30 : Database - perpustakaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `perpustakaan`;

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `anggota_id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`anggota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `anggota` */

insert  into `anggota`(`anggota_id`,`nama`,`alamat`,`email`,`telepon`) values (1,'vito','jepara','vatra@gmail.com','084473426'),(2,'gunawan','pancur','ggn@gmail.com','081325483'),(3,'ferdi','demak','ferdi123@gmail.com','099232873'),(4,'ilham','mayong','ilham@gmail.com','081325483');

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `buku_id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` int DEFAULT NULL,
  `sinopsis` text,
  `kategori_id` int DEFAULT NULL,
  PRIMARY KEY (`buku_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `buku` */

insert  into `buku`(`buku_id`,`judul`,`pengarang`,`penerbit`,`tahun_terbit`,`sinopsis`,`kategori_id`) values (2,'Jaringan Komputer','jack grealish','gunawan',2023,'',1),(3,'Rekayasa perangkat lunak','ggn','gunawan',2023,'',1),(6,'Algoritma','vatra','vito',2023,'',1),(7,'Jaringan Komputer','jack grealish','ulil',2023,NULL,1);

/*Table structure for table `denda` */

DROP TABLE IF EXISTS `denda`;

CREATE TABLE `denda` (
  `denda_id` int NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int DEFAULT NULL,
  `jumlah_denda` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`denda_id`),
  KEY `peminjaman_id` (`peminjaman_id`),
  CONSTRAINT `denda_ibfk_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`peminjaman_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `denda` */

/*Table structure for table `katalog` */

DROP TABLE IF EXISTS `katalog`;

CREATE TABLE `katalog` (
  `katalog_id` int NOT NULL AUTO_INCREMENT,
  `buku_id` int DEFAULT NULL,
  `sinopsis` text,
  `kategori_id` int DEFAULT NULL,
  PRIMARY KEY (`katalog_id`),
  KEY `buku_id` (`buku_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `katalog_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`),
  CONSTRAINT `katalog_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `katalog` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`kategori_id`,`nama_kategori`) values (1,'anak anak'),(2,'remaja');

/*Table structure for table `lokasi_fisik_buku` */

DROP TABLE IF EXISTS `lokasi_fisik_buku`;

CREATE TABLE `lokasi_fisik_buku` (
  `lokasi_id` int NOT NULL AUTO_INCREMENT,
  `buku_id` int DEFAULT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lokasi_id`),
  KEY `buku_id` (`buku_id`),
  CONSTRAINT `lokasi_fisik_buku_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `lokasi_fisik_buku` */

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `peminjaman_id` int NOT NULL AUTO_INCREMENT,
  `buku_id` int DEFAULT NULL,
  `anggota_id` int DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'dipinjam',
  PRIMARY KEY (`peminjaman_id`),
  KEY `buku_id` (`buku_id`),
  KEY `anggota_id` (`anggota_id`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`),
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`peminjaman_id`,`buku_id`,`anggota_id`,`tanggal_peminjaman`,`tanggal_kembali`,`status`) values (1,3,2,'2023-12-18','2023-12-20','dipinjam'),(3,3,1,'2023-12-18','2023-12-20','dipinjam'),(4,2,1,'2023-12-18','2023-12-19','dipinjam'),(5,3,1,'2023-12-19','2023-12-21','dipinjam');

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `pengembalian_id` int NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT NULL,
  `status_pengembalian` enum('dikembalikan','terlambat') DEFAULT 'dikembalikan',
  PRIMARY KEY (`pengembalian_id`),
  KEY `peminjaman_id` (`peminjaman_id`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`peminjaman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pengembalian` */

insert  into `pengembalian`(`pengembalian_id`,`peminjaman_id`,`tanggal_pengembalian`,`denda`,`status_pengembalian`) values (1,1,'2023-12-18',NULL,'dikembalikan'),(2,3,'2023-12-24',NULL,'dikembalikan'),(3,3,'2023-12-24',NULL,'dikembalikan'),(4,3,'2023-12-24',NULL,'dikembalikan');

/*Table structure for table `penggunas` */

DROP TABLE IF EXISTS `penggunas`;

CREATE TABLE `penggunas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `penggunas` */

insert  into `penggunas`(`id`,`username`,`password`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3');

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `staff` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
