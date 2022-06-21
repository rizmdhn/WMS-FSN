-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 12:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `agamas`
--

CREATE TABLE `agamas` (
  `id_agama` int(10) UNSIGNED NOT NULL,
  `nama_agama` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agamas`
--

INSERT INTO `agamas` (`id_agama`, `nama_agama`, `created_at`, `updated_at`) VALUES
(1, 'Islam', '2019-03-22 08:42:30', '2019-03-22 08:42:30'),
(2, 'Kristen', '2019-03-22 08:42:49', '2019-03-22 08:42:49'),
(3, 'Katolik', '2019-03-22 08:42:57', '2019-03-22 08:42:57'),
(4, 'Hindu', '2019-03-22 08:43:06', '2019-03-22 08:43:06'),
(7, 'Budha', '2019-11-19 06:32:08', '2019-11-19 06:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `has_expired` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama_kategori`, `has_expired`, `created_at`, `updated_at`) VALUES
(6, 'PUPUK', 1, '2022-03-27 16:27:02', '2022-06-07 01:24:38'),
(8, 'BAHAN KIMIA (CAIR)', 1, '2022-03-27 16:29:22', '2022-06-07 01:24:43'),
(9, 'PELET', 0, '2022-04-18 21:43:50', '2022-04-18 21:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `sap` char(7) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `id_gender` int(10) UNSIGNED NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_daftar` date NOT NULL,
  `id_agama` int(10) UNSIGNED DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id_karyawan`, `sap`, `nama_karyawan`, `id_gender`, `tgl_lahir`, `tgl_daftar`, `id_agama`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(14, '4538276', 'RizkiR', 1, '1987-09-10', '2000-01-03', 3, 'Jl. Satu', '556455656567', '2020-01-03 15:59:27', '2022-03-27 16:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id_gender` int(10) UNSIGNED NOT NULL,
  `nama_gender` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id_gender`, `nama_gender`, `created_at`, `updated_at`) VALUES
(1, 'Laki-laki', '2019-03-22 09:38:24', '2019-03-22 09:38:24'),
(3, 'Perempuan', '2019-11-19 06:18:02', '2019-11-19 06:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `kode_gudang` varchar(191) NOT NULL,
  `nama_gudang` varchar(191) NOT NULL,
  `Kapasitas_GT` int(10) NOT NULL,
  `Kapasitas_F` int(10) NOT NULL,
  `Kapasitas_S` int(10) NOT NULL,
  `Kapasitas_N` int(10) NOT NULL,
  `sisa_F` int(11) NOT NULL,
  `sisa_S` int(11) NOT NULL,
  `sisa_N` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `kode_gudang`, `nama_gudang`, `Kapasitas_GT`, `Kapasitas_F`, `Kapasitas_S`, `Kapasitas_N`, `sisa_F`, `sisa_S`, `sisa_N`, `updated_at`, `created_at`) VALUES
(1, 'G_001', 'Gudang Jakarta', 1200, 800, 300, 100, -480, 300, 100, '2022-06-21', '2022-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2022_04_05_035957_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('arif@contoh.com', '$2y$10$teDGfASs9BQExEzZkCf/OOoMBeOMYIlbwfHUzyVKNEg2NECzNIxyC', '2019-08-26 00:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `image` varchar(100) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `id_unit` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `id_gudang` int(10) NOT NULL,
  `ket_produk` text NOT NULL,
  `jumlah_enodes` int(10) NOT NULL,
  `TOR4Months` float NOT NULL,
  `Kategori_fsn` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `image`, `stok_produk`, `id_unit`, `id_supplier`, `id_gudang`, `ket_produk`, `jumlah_enodes`, `TOR4Months`, `Kategori_fsn`, `created_at`, `updated_at`) VALUES
(5, 'MKP01', 'MKP Pak Tani', 6, '1648398757.jpg', 30, 1, 1, 1, 'Pupuk 1 KG', 6, 4.0553, 1, '2022-03-27 16:32:37', '2022-06-21 12:19:47'),
(6, 'BRN001', 'Boron Plus', 6, '1648398839.jpg', 380, 1, 1, 1, 'Boron Plus', 5, 1.48755, 1, '2022-03-27 16:33:59', '2022-06-21 12:19:47'),
(7, 'PR001', 'Panen Raya', 6, '1648424692.jpg', 120, 1, 1, 1, 'Panen Raya', 4, 3.24651, 1, '2022-03-27 23:44:52', '2022-06-21 12:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id_purchase` int(10) UNSIGNED NOT NULL,
  `tgl_purchase` date NOT NULL,
  `id_produk` int(10) UNSIGNED NOT NULL,
  `qty_purchase` int(11) NOT NULL,
  `expired` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id_purchase`, `tgl_purchase`, `id_produk`, `qty_purchase`, `expired`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(32, '2021-12-20', 5, 50, '2022-04-20', 1, 0, '2022-03-27 21:31:52', '2022-04-19 17:10:30'),
(33, '2022-01-20', 5, 50, '2022-04-20', 1, 0, '2022-03-27 21:33:32', '2022-04-19 17:10:30'),
(40, '2022-02-20', 5, 50, '2022-04-20', 1, 0, '2022-03-27 22:00:02', '2022-04-19 17:10:30'),
(45, '2022-03-20', 5, 50, '2022-04-20', 1, 1, '2022-03-27 22:04:23', '2022-06-06 10:31:43'),
(79, '2021-12-20', 6, 100, '2022-04-20', 1, 0, '2022-03-27 23:31:00', '2022-04-19 17:10:30'),
(81, '2022-01-20', 6, 50, NULL, 1, 0, '2022-03-27 23:43:09', '2022-04-19 17:10:30'),
(112, '2022-02-20', 7, 100, NULL, 1, 0, '2022-03-28 11:16:55', '2022-04-19 17:10:30'),
(113, '2022-03-20', 7, 100, NULL, 1, 0, '2022-03-28 11:17:07', '2022-04-19 17:10:30'),
(115, '2022-01-20', 7, 100, NULL, 1, 0, '2022-04-04 08:54:03', '2022-04-19 17:10:30'),
(116, '2021-12-20', 7, 100, NULL, 1, 0, '2022-04-04 08:54:40', '2022-04-19 17:10:30'),
(121, '2022-02-20', 6, 50, NULL, 1, 0, '2022-04-07 21:33:42', '2022-04-19 17:10:30'),
(122, '2022-03-20', 6, 100, '2022-04-20', 1, 1, '2022-04-07 21:36:40', '2022-06-06 11:04:19'),
(128, '2022-04-20', 7, 20, '2022-04-20', 1, 1, '2022-04-20 08:48:57', '2022-06-06 10:26:11'),
(130, '2022-03-01', 6, 200, '2022-02-01', 1, 0, '2022-06-06 08:46:44', '2022-06-06 10:12:03');

--
-- Triggers `purchases`
--
DELIMITER $$
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `purchases` FOR EACH ROW BEGIN
	UPDATE products SET stok_produk =     stok_produk+NEW.qty_purchase
    WHERE id_produk = NEW.id_produk;
 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cancel_purchase` AFTER DELETE ON `purchases` FOR EACH ROW BEGIN
	UPDATE products SET stok_produk = products.stok_produk - OLD.qty_purchase
	WHERE id_produk = OLD.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id_record` int(11) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `stokawal_produk` int(11) NOT NULL,
  `qty_masuk` int(11) DEFAULT NULL,
  `qty_keluar` int(11) DEFAULT NULL,
  `stokakhir_produk` int(11) DEFAULT NULL,
  `Tanggal` varchar(100) NOT NULL,
  `Rata2_persediaan` float DEFAULT NULL,
  `TOR_partial` float DEFAULT NULL,
  `WSP` float DEFAULT NULL,
  `TOR` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id_record`, `id_produk`, `kode_produk`, `nama_produk`, `stokawal_produk`, `qty_masuk`, `qty_keluar`, `stokakhir_produk`, `Tanggal`, `Rata2_persediaan`, `TOR_partial`, `WSP`, `TOR`, `created_at`, `updated_at`) VALUES
(20, 5, 'MKP01', 'MKP Pak Tani', 30, 50, 30, 50, '2021-12-20', 40, 0.75, 41.3333, 0.75, '2022-03-27 21:31:52', '2022-06-21 12:19:47'),
(21, 5, 'MKP01', 'MKP Pak Tani', 50, 50, 50, 50, '2022-01-20', 50, 1, 31, 3.87097, '2022-03-27 21:33:17', '2022-06-21 12:19:47'),
(24, 5, 'MKP01', 'MKP Pak Tani', 50, 50, 60, 40, '2022-02-20', 45, 1.33333, 21, 5.71429, '2022-03-27 21:46:10', '2022-06-21 12:19:47'),
(25, 5, 'MKP01', 'MKP Pak Tani', 40, 50, 60, 30, '2022-03-20', 35, 1.71429, 18.0833, 6.63594, '2022-03-27 22:04:23', '2022-06-21 12:19:47'),
(45, 6, 'BRN001', 'Boron Plus', 296, 100, 96, 300, '2021-12-20', 298, 0.322148, 96.2292, 0.322148, '2022-03-27 23:31:00', '2022-06-21 12:19:47'),
(48, 6, 'BRN001', 'Boron Plus', 300, 50, 100, 250, '2022-01-12', 275, 0.363636, 85.25, 1.40762, '2022-03-27 23:41:22', '2022-06-21 12:19:47'),
(57, 7, 'PR001', 'Panen Raya', 104, 100, 96, 108, '2021-12-20', 106, 0.90566, 34.2292, 0.90566, '2022-03-28 10:50:33', '2022-06-21 12:19:47'),
(58, 7, 'PR001', 'Panen Raya', 108, 100, 106, 102, '2022-01-20', 105, 1.00952, 30.7075, 3.90783, '2022-03-28 11:16:39', '2022-06-21 12:19:47'),
(59, 7, 'PR001', 'Panen Raya', 102, 100, 120, 82, '2022-02-20', 92, 1.30435, 21.4667, 5.59006, '2022-03-28 11:16:55', '2022-06-21 12:19:47'),
(60, 7, 'PR001', 'Panen Raya', 82, 100, 82, 100, '2022-03-20', 91, 0.901099, 34.4024, 3.48812, '2022-03-28 11:17:07', '2022-06-21 12:19:47'),
(63, 6, 'BRN001', 'Boron Plus', 250, 50, 120, 180, '2022-02-20', 215, 0.55814, 50.1667, 2.39203, '2022-04-07 21:33:42', '2022-06-21 12:19:47'),
(64, 6, 'BRN001', 'Boron Plus', 180, 100, 100, 180, '2022-03-20', 180, 0.555556, 55.8, 2.15054, '2022-04-07 21:36:40', '2022-06-21 12:19:47'),
(65, 5, 'MKP01', 'MKP Pak Tani', 30, 0, 0, 30, '2022-04-12', 35, 0, 0, 0, '2022-04-12 12:16:20', '2022-06-21 12:19:47'),
(66, 6, 'BRN001', 'Boron Plus', 180, 0, 0, 180, '2022-04-20', 180, 0, 0, 0, '2022-04-19 17:10:00', '2022-06-21 12:19:47'),
(67, 8, 'test_001', 'testing', 21, 0, 0, 21, '2022-04-20', 0, 0, 0, 0, '2022-04-19 18:39:58', '2022-05-30 15:30:27'),
(68, 7, 'PR001', 'Panen Raya', 100, 20, 0, 120, '2022-04-20', 91, 0, 0, 0, '2022-04-19 18:51:40', '2022-06-21 12:19:47'),
(69, 5, 'MKP01', 'MKP Pak Tani', 30, 0, 0, 30, '2022-05-30', 35, 0, 0, 0, '2022-06-01 16:24:03', '2022-06-21 12:19:47'),
(70, 6, 'BRN001', 'Boron Plus', 180, 0, 0, 180, '2022-05-29', 180, 0, 0, 0, '2022-06-01 16:24:37', '2022-06-21 12:19:47'),
(71, 5, 'MKP01', 'MKP Pak Tani', 30, 0, 0, 30, '2022-06-07', 35, 0, 0, 0, '2022-06-06 10:59:59', '2022-06-21 12:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id_sell` int(10) UNSIGNED NOT NULL,
  `tgl_sell` date NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `id_produk` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id_sell`, `tgl_sell`, `id_karyawan`, `id_produk`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(19, '2021-12-20', 14, 5, 30, 1, '2022-03-27 21:32:07', '2022-04-12 12:15:40'),
(20, '2022-01-20', 14, 5, 50, 1, '2022-03-27 21:33:17', '2022-04-12 12:15:40'),
(23, '2022-02-20', 14, 5, 60, 1, '2022-03-27 21:46:10', '2022-04-12 12:15:40'),
(24, '2022-03-20', 14, 5, 60, 1, '2022-03-27 22:05:21', '2022-04-12 12:15:40'),
(41, '2021-12-20', 14, 6, 96, 1, '2022-03-27 23:34:00', '2022-04-12 12:15:40'),
(44, '2022-01-12', 14, 6, 100, 1, '2022-03-27 23:41:22', '2022-04-12 12:15:40'),
(113, '2021-12-20', 14, 7, 96, 1, '2022-03-28 11:39:17', '2022-04-12 12:15:40'),
(114, '2022-01-20', 14, 7, 106, 1, '2022-03-28 11:39:53', '2022-04-12 12:15:40'),
(117, '2022-03-20', 14, 7, 82, 1, '2022-04-02 18:28:26', '2022-04-12 12:15:40'),
(121, '2022-02-20', 14, 7, 120, 1, '2022-04-04 09:18:37', '2022-04-12 12:15:40'),
(128, '2022-02-20', 14, 6, 120, 1, '2022-04-07 21:35:43', '2022-04-12 12:15:40'),
(129, '2022-03-20', 14, 6, 100, 1, '2022-04-07 21:36:53', '2022-04-12 12:15:40');

--
-- Triggers `sells`
--
DELIMITER $$
CREATE TRIGGER `cancel_sell` AFTER DELETE ON `sells` FOR EACH ROW BEGIN
	UPDATE products SET stok_produk = products.stok_produk + OLD.qty
	WHERE id_produk = OLD.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengambilan` BEFORE INSERT ON `sells` FOR EACH ROW BEGIN
	UPDATE products SET stok_produk = stok_produk-NEW.qty
    WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `cp` varchar(100) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `telp_supplier` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id_supplier`, `nama_supplier`, `cp`, `alamat_supplier`, `telp_supplier`, `created_at`, `updated_at`) VALUES
(1, 'Supplier 1', 'Joko', 'Palembang', '081232435436', '2019-11-28 03:14:50', '2019-11-28 03:27:22'),
(4, 'Supplier 4', 'Bari', 'Jakabaring', '067677987987', '2020-01-04 16:34:10', '2020-01-04 16:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id_unit` int(10) UNSIGNED NOT NULL,
  `nama_unit` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id_unit`, `nama_unit`, `created_at`, `updated_at`) VALUES
(1, 'KILOGRAM', '2019-11-28 14:30:50', '2022-03-27 16:29:43'),
(4, 'LITER', '2022-03-27 16:23:30', '2022-03-27 16:30:04'),
(5, 'GRAM', '2022-03-27 16:29:48', '2022-03-27 16:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akses` enum('admin','operator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'operator',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `akses`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Administrator', 'admin', 'admin@contoh.com', 'admin', '$2y$10$MnTwLh0DfW8NYyfF.eMaKelqZZkQpq4/RtW.2I.XU3aoOdlExVyDO', 'NcNINIr2Gnk9Zk8e2olOS8LgFimN3nRCaL4STQ45Q0sdWPFRBlCneLAl8lJF', '2019-03-27 09:18:02', '2019-11-28 02:18:04'),
(9, 'Rizki ramadhan', 'rizmdhn', 'rizkir42@gmail.com', 'admin', '$2y$10$Jior7Fhdv5S/sIuSENVt5ed3ZBhQvF9Lf3LwpUja0Tb0YinDEJ1r.', NULL, '2022-03-27 16:24:02', '2022-03-27 16:24:02'),
(10, 'operator', 'operator', 'operator@gmail.com', 'operator', '$2y$10$IlUhHUwf4kVYZDGJoBVikegIXljVhDHt12sMLt46ITUfEtmnggOUW', 'YRVuwU9M3Fns35YyTn6efWsUpwPyWnniWKgvalFepwleQoXbclViipPdzfzz', '2022-03-27 16:24:32', '2022-03-27 16:24:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agamas`
--
ALTER TABLE `agamas`
  ADD PRIMARY KEY (`id_agama`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_agama_2` (`id_agama`),
  ADD KEY `id_agama_3` (`id_agama`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_pasien` (`id_karyawan`),
  ADD KEY `id_pasien_2` (`id_karyawan`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_agama_2` (`id_agama`),
  ADD KEY `id_gender` (`id_gender`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id_gender`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id_purchase`),
  ADD KEY `id_purchase` (`id_purchase`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id_sell`),
  ADD KEY `id_sell` (`id_sell`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `id_unit` (`id_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agamas`
--
ALTER TABLE `agamas`
  MODIFY `id_agama` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id_karyawan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id_gender` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id_purchase` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id_sell` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_supplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id_unit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`id_agama`) REFERENCES `agamas` (`id_agama`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`id_gender`) REFERENCES `genders` (`id_gender`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `units` (`id_unit`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `suppliers` (`id_supplier`) ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `employees` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sells_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
