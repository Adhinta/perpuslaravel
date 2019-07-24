-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for perpus_gc
DROP DATABASE IF EXISTS `perpus_gc`;
CREATE DATABASE IF NOT EXISTS `perpus_gc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `perpus_gc`;

-- Dumping structure for table perpus_gc.anggota
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE IF NOT EXISTS `anggota` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `npm` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anggota_user_id_foreign` (`user_id`),
  CONSTRAINT `anggota_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpus_gc.anggota: ~4 rows (approximately)
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` (`id`, `user_id`, `npm`, `nama`, `status`, `tempat_lahir`, `tgl_lahir`, `jk`, `prodi`, `jabatan`, `created_at`, `updated_at`) VALUES
	(1, 1, 10000353, 'Admin GC', '', 'Banjarmasin', '2018-01-01', 'L', 'TI', '', '2019-07-13 01:34:53', '2019-07-13 01:34:53'),
	(2, 2, 10000375, 'User GC', '', 'Banjarmasin', '2019-01-01', 'L', 'TI', '', '2019-07-13 01:34:53', '2019-07-13 01:34:53'),
	(5, 3, 1615051112, 'adenta', 'S', 'singaraja', '2019-07-10', 'L', 'SI', '-', '2019-07-13 06:47:27', '2019-07-13 06:47:27'),
	(6, 4, 0, 'triadi', 'GS', 'singaraja', '2019-07-10', 'L', '-', 'Staff perpus', '2019-07-13 06:48:12', '2019-07-13 06:48:12');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;

-- Dumping structure for table perpus_gc.buku
DROP TABLE IF EXISTS `buku`;
CREATE TABLE IF NOT EXISTS `buku` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_inventaris` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_tahun_terbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cetakan_jilid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_inventaris` (`no_inventaris`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpus_gc.buku: ~5 rows (approximately)
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` (`id`, `no_inventaris`, `judul`, `pengarang`, `tempat_tahun_terbit`, `cetakan_jilid`, `kode`, `asal`, `isbn`, `harga`, `ukuran`, `jumlah_buku`, `created_at`, `updated_at`) VALUES
	(5, '001', 'Prinsip Dasar Mesin Otomatis', 'ryanjemtatos', 'Jakarta & 2014', 'Kedua', '052 Eas O.2', 'Dana BOS DPA 2015', '978-979-518-033-3', 'Rp.51,000', '387 halm', 25, '2019-07-13 04:02:51', '2019-07-24 16:52:24'),
	(6, '002', 'Cara menjadi pentolan', 'ryanjemtatos', 'Jakarta & 2014', 'Kedua', '052 Eas O.2', 'Dana BOS DPA 2015', '978-979-518-033-3', 'Rp.51,000', '387 halm', 24, '2019-07-13 04:02:51', '2019-07-24 16:53:06'),
	(7, '003', 'How to become pirates', 'ryanjemtatos', 'Jakarta & 2014', 'Kedua', '052 Eas O.2', 'Dana BOS DPA 2015', '978-979-518-033-3', 'Rp.51,000', '387 halm', 23, '2019-07-13 04:02:51', '2019-07-24 16:53:06'),
	(8, '004', 'You know nothing jon show!', 'ryanjemtatos', 'Jakarta & 2014', 'Kedua', '052 Eas O.2', 'Dana BOS DPA 2015', '978-979-518-033-3', 'Rp.51,000', '387 halm', 34, '2019-07-13 04:02:51', '2019-07-24 16:35:00'),
	(9, '005', 'The lord of the ring', 'ryanjemtatos', 'Jakarta & 2014', 'Kedua', '052 Eas O.2', 'Dana BOS DPA 2015', '978-979-518-033-3', 'Rp.51,000', '387 halm', 33, '2019-07-13 04:02:51', '2019-07-24 16:52:24');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;

-- Dumping structure for table perpus_gc.buku_transaksi
DROP TABLE IF EXISTS `buku_transaksi`;
CREATE TABLE IF NOT EXISTS `buku_transaksi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpus_gc.buku_transaksi: ~3 rows (approximately)
/*!40000 ALTER TABLE `buku_transaksi` DISABLE KEYS */;
INSERT INTO `buku_transaksi` (`id`, `kode_transaksi`, `buku_id`, `created_at`, `updated_at`) VALUES
	(1, 'TR00003', 5, '2019-07-24 23:02:07', '2019-07-24 23:02:08'),
	(2, 'TR00003', 6, '2019-07-24 23:02:07', '2019-07-24 23:02:08'),
	(3, 'TR00005', 6, '2019-07-24 23:02:07', '2019-07-24 23:02:08'),
	(4, 'TR00004', 8, '2019-07-24 23:02:07', '2019-07-24 23:02:08'),
	(8, 'TR00025', 7, NULL, NULL),
	(9, 'TR00031', 5, NULL, NULL),
	(10, 'TR00032', 5, NULL, NULL),
	(11, 'TR00033', 5, NULL, NULL),
	(26, 'TR00042', 5, NULL, NULL),
	(27, 'TR00042', 9, NULL, NULL),
	(28, 'TR00043', 6, NULL, NULL),
	(29, 'TR00043', 7, NULL, NULL);
/*!40000 ALTER TABLE `buku_transaksi` ENABLE KEYS */;

-- Dumping structure for table perpus_gc.detail_transaksi
DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_detailtransaksi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(10) unsigned NOT NULL,
  `buku_id` int(10) unsigned NOT NULL,
  `kondisi` varchar(200) NOT NULL,
  PRIMARY KEY (`id_detailtransaksi`),
  UNIQUE KEY `id_transaksi` (`transaksi_id`),
  UNIQUE KEY `id_buku` (`buku_id`),
  CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table perpus_gc.detail_transaksi: ~0 rows (approximately)
/*!40000 ALTER TABLE `detail_transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_transaksi` ENABLE KEYS */;

-- Dumping structure for table perpus_gc.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpus_gc.migrations: ~5 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2018_06_17_070037_create_anggotas_table', 1),
	(3, '2018_06_17_130244_create_bukus_table', 1),
	(4, '2018_06_18_014155_create_transaksis_table', 1),
	(6, '2019_07_24_143837_create_buku_transaksi_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table perpus_gc.transaksi
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_id` int(10) unsigned NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` enum('pinjam','kembali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_anggota_id_foreign` (`anggota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpus_gc.transaksi: ~7 rows (approximately)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id`, `kode_transaksi`, `anggota_id`, `tgl_pinjam`, `tgl_kembali`, `status`, `ket`, `created_at`, `updated_at`) VALUES
	(3, 'TR00003', 2, '2019-07-13', '2019-07-13', 'kembali', NULL, '2019-07-13 06:50:46', '2019-07-13 06:51:08'),
	(4, 'TR00004', 5, '2019-07-13', '2019-07-14', 'pinjam', NULL, '2019-07-13 06:51:43', '2019-07-13 06:51:43'),
	(5, 'TR00005', 5, '2019-07-18', '2019-07-23', 'pinjam', NULL, '2019-07-18 02:01:58', '2019-07-18 02:01:58'),
	(6, 'TR00006', 2, '2019-07-18', '2019-07-23', 'pinjam', NULL, '2019-07-18 05:38:54', '2019-07-18 05:38:54'),
	(7, 'TR00007', 5, '2019-07-24', '2019-07-29', 'pinjam', 'asasasasasasasas', '2019-07-24 12:24:57', '2019-07-24 12:24:57'),
	(8, 'TR00008', 1, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 14:01:55', '2019-07-24 14:01:55'),
	(16, 'TR00016', 2, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 14:11:26', '2019-07-24 14:11:26'),
	(24, 'TR00017', 1, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 16:07:50', '2019-07-24 16:07:50'),
	(30, 'TR00025', 2, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 16:42:47', '2019-07-24 16:42:47'),
	(31, 'TR00031', 6, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 16:45:29', '2019-07-24 16:45:29'),
	(32, 'TR00032', 1, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 16:46:18', '2019-07-24 16:46:18'),
	(33, 'TR00033', 1, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 16:47:20', '2019-07-24 16:47:20'),
	(41, 'TR00039', 1, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 16:51:19', '2019-07-24 16:51:19'),
	(42, 'TR00042', 5, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 16:52:24', '2019-07-24 16:52:24'),
	(43, 'TR00043', 5, '2019-07-24', '2019-07-29', 'pinjam', 'Baik', '2019-07-24 16:53:06', '2019-07-24 16:53:06');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- Dumping structure for table perpus_gc.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpus_gc.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `gambar`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Ryan Ardiansyah - Admin', 'admin123', '123456@gilacoding.com', '$2y$10$tCtAAc32NCvsYdMmv8jFdeIWU8BModeIhfOAUZZFpFFNzOHDIdNjO', NULL, 'admin', 'hzLfWyvoYzhjiUwQM9jQbu2QN5erVN4Aguc1CHeDfmfD7IB1lOBxBvgMxpga', '2019-07-13 01:34:53', '2019-07-13 01:55:27'),
	(2, 'Gilacoding - User', 'user123', '654321@gilacoding.com', '$2y$10$jz8eyLkDaErNRPtYL5csOOLHX7jpt2vECG5ZoJkOHjE3ghdycOQKG', NULL, 'user', NULL, '2019-07-13 01:34:53', '2019-07-13 01:34:53'),
	(3, 'denta', 'denta', 'adenta@gmail.com', '$2y$10$Bf1vnOg8D57Fqf2CS78EY.V0RgPfRodfNB2GN3SPeEF.Sf3CnxW3u', NULL, 'user', NULL, '2019-07-13 03:27:12', '2019-07-13 03:27:12'),
	(4, 'triadi', 'triadi', 'triadi@gmail.com', '$2y$10$vYAhnwac5Jl.OnrQovdb.uXdSI8qtpAiNCrWIDnUUuHb.o8R5Fypy', NULL, 'user', NULL, '2019-07-13 06:15:46', '2019-07-13 06:15:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
