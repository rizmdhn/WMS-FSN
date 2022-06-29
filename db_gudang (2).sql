-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 08:46 AM
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
(9, 'PAKAN', 1, '2022-04-18 21:43:50', '2022-06-27 13:32:45'),
(13, 'Alat', 0, '2022-06-27 13:32:31', '2022-06-27 13:32:31');

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
(1, 'G_001', 'Gudang Jakarta', 6000, 4500, 1200, 300, 3420, 1200, -2016, '2022-06-29', '2022-04-18');

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
  `id_gudang` int(10) NOT NULL,
  `ket_produk` text NOT NULL,
  `jumlah_enodes` int(10) NOT NULL,
  `TOR4Months` float NOT NULL DEFAULT 0,
  `Kategori_fsn` int(10) DEFAULT 3,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `image`, `stok_produk`, `id_unit`, `id_gudang`, `ket_produk`, `jumlah_enodes`, `TOR4Months`, `Kategori_fsn`, `created_at`, `updated_at`) VALUES
(5, 'MKP01', 'MKP Pak Tani', 6, '1648398757.jpg', 30, 1, 1, 'Pupuk 1 KG', 6, 4.0553, 1, '2022-03-27 16:32:37', '2022-06-28 18:25:24'),
(6, 'BRN001', 'Boron Plus', 6, '1648398839.jpg', 180, 1, 1, 'Boron Plus', 5, 1.79706, 1, '2022-03-27 16:33:59', '2022-06-28 18:25:24'),
(7, 'PR001', 'Panen Raya', 6, '1648424692.jpg', 504, 1, 1, 'Panen Raya', 4, 0, 3, '2022-03-27 23:44:52', '2022-06-28 18:25:24'),
(11, 'Cgkl_01', 'Cangkul', 13, '1656336830.png', 30, 6, 1, 'test', 10, 0, 3, '2022-06-27 13:33:50', '2022-06-27 13:33:50');

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
(32, '2021-12-20', 5, 50, '2022-04-20', 1, 1, '2022-03-27 21:31:52', '2022-06-27 14:00:12'),
(33, '2022-01-20', 5, 50, '2022-04-20', 1, 1, '2022-03-27 21:33:32', '2022-06-27 13:10:09'),
(40, '2022-02-20', 5, 50, '2022-04-20', 1, 1, '2022-03-27 22:00:02', '2022-06-27 13:10:07'),
(45, '2022-03-20', 5, 50, '2022-04-20', 1, 1, '2022-03-27 22:04:23', '2022-06-06 10:31:43'),
(136, '2022-01-20', 6, 100, '2024-06-04', 1, 0, '2022-06-27 04:43:07', '2022-06-27 13:57:41'),
(137, '2022-02-20', 6, 50, '2024-06-27', 1, 0, '2022-06-27 04:43:34', '2022-06-27 13:57:41'),
(138, '2022-03-27', 6, 50, '2024-06-27', 1, 0, '2022-06-27 04:44:02', '2022-06-27 13:57:41'),
(139, '2022-04-27', 6, 100, '2024-06-27', 1, 0, '2022-06-27 04:44:27', '2022-06-27 13:57:41'),
(140, '2022-01-27', 7, 100, '2024-06-27', 1, 0, '2022-06-27 13:46:26', '2022-06-27 13:57:41'),
(141, '2022-02-27', 7, 100, '2024-06-27', 1, 0, '2022-06-27 13:46:43', '2022-06-27 13:57:41'),
(142, '2022-03-27', 7, 100, '2024-06-27', 1, 0, '2022-06-27 13:46:56', '2022-06-27 13:57:41'),
(143, '2022-04-27', 7, 100, '2024-06-28', 1, 0, '2022-06-27 13:47:10', '2022-06-27 13:57:41'),
(145, '2022-03-27', 11, 20, NULL, 1, 0, '2022-06-27 13:56:21', '2022-06-27 13:57:41');

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
  `id_produk` int(10) UNSIGNED NOT NULL,
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
(20, 5, 'MKP01', 'MKP Pak Tani', 30, 50, 30, 50, '2021-12-20', 40, 0.75, 41.3333, 0.75, '2022-03-27 21:31:52', '2022-06-28 18:25:24'),
(21, 5, 'MKP01', 'MKP Pak Tani', 50, 50, 50, 50, '2022-01-20', 50, 1, 31, 3.87097, '2022-03-27 21:33:17', '2022-06-28 18:25:24'),
(24, 5, 'MKP01', 'MKP Pak Tani', 50, 50, 60, 40, '2022-02-20', 45, 1.33333, 21, 5.71429, '2022-03-27 21:46:10', '2022-06-28 18:25:24'),
(25, 5, 'MKP01', 'MKP Pak Tani', 40, 50, 60, 30, '2022-03-20', 35, 1.71429, 18.0833, 6.63594, '2022-03-27 22:04:23', '2022-06-28 18:25:24'),
(45, 6, 'BRN001', 'Boron Plus', 296, 0, 0, 296, '2021-12-20', 0, 0, 0, 0, '2022-03-27 23:31:00', '2022-06-28 18:25:24'),
(48, 6, 'BRN001', 'Boron Plus', 296, 100, 96, 300, '2022-01-12', 298, 0.322148, 96.2292, 1.24702, '2022-03-27 23:41:22', '2022-06-28 18:25:24'),
(57, 7, 'PR001', 'Panen Raya', 104, 0, 0, 104, '2021-12-20', 0, 0, 0, 0, '2022-03-28 10:50:33', '2022-06-28 18:25:24'),
(58, 7, 'PR001', 'Panen Raya', 104, 100, 0, 204, '2022-01-20', 0, 0, 0, 0, '2022-03-28 11:16:39', '2022-06-28 18:25:24'),
(59, 7, 'PR001', 'Panen Raya', 204, 100, 0, 304, '2022-02-20', 0, 0, 0, 0, '2022-03-28 11:16:55', '2022-06-28 18:25:24'),
(60, 7, 'PR001', 'Panen Raya', 304, 100, 0, 404, '2022-03-20', 0, 0, 0, 0, '2022-03-28 11:17:07', '2022-06-28 18:25:24'),
(63, 6, 'BRN001', 'Boron Plus', 300, 50, 100, 250, '2022-02-20', 275, 0.363636, 77, 1.55844, '2022-04-07 21:33:42', '2022-06-28 18:25:24'),
(64, 6, 'BRN001', 'Boron Plus', 250, 50, 120, 180, '2022-03-20', 215, 0.55814, 55.5417, 2.16054, '2022-04-07 21:36:40', '2022-06-28 18:25:24'),
(65, 5, 'MKP01', 'MKP Pak Tani', 30, 0, 0, 30, '2022-04-12', 35, 0, 0, 0, '2022-04-12 12:16:20', '2022-06-28 18:25:24'),
(66, 6, 'BRN001', 'Boron Plus', 180, 100, 100, 180, '2022-04-20', 180, 0.555556, 54, 2.22222, '2022-04-19 17:10:00', '2022-06-28 18:25:24'),
(67, 8, 'test_001', 'testing', 21, 0, 0, 21, '2022-04-20', 0, 0, 0, 0, '2022-04-19 18:39:58', '2022-05-30 15:30:27'),
(68, 7, 'PR001', 'Panen Raya', 404, 100, 0, 504, '2022-04-20', 0, 0, 0, 0, '2022-04-19 18:51:40', '2022-06-28 18:25:24'),
(69, 5, 'MKP01', 'MKP Pak Tani', 30, 0, 0, 30, '2022-05-30', 35, 0, 0, 0, '2022-06-01 16:24:03', '2022-06-28 18:25:24'),
(70, 6, 'BRN001', 'Boron Plus', 180, 0, 0, 180, '2022-05-29', 180, 0, 0, 0, '2022-06-01 16:24:37', '2022-06-28 18:25:24'),
(71, 5, 'MKP01', 'MKP Pak Tani', 30, 0, 0, 30, '2022-06-07', 35, 0, 0, 0, '2022-06-06 10:59:59', '2022-06-28 18:25:24'),
(72, 6, 'BRN001', 'Boron Plus', 180, 0, 0, 180, '2022-06-23', 180, 0, 0, 0, '2022-06-23 04:51:15', '2022-06-28 18:25:24'),
(73, 7, 'PR001', 'Panen Raya', 504, 0, 0, 504, '2022-05-27', 0, 0, 0, 0, '2022-06-27 13:02:05', '2022-06-28 18:25:24'),
(74, 11, 'Cgkl_01', 'Cangkul', 40, 0, 0, 40, '2022-05-28', 0, 0, 0, 0, '2022-06-27 13:55:15', '2022-06-28 18:25:24'),
(75, 11, 'Cgkl_01', 'Cangkul', 20, 20, 0, 40, '2022-03-27', 0, 0, 0, 0, '2022-06-27 13:56:21', '2022-06-28 18:25:24'),
(76, 11, 'Cgkl_01', 'Cangkul', 40, 0, 0, 40, '2022-06-27', 0, 0, 0, 0, '2022-06-27 13:57:17', '2022-06-28 18:25:24'),
(77, 7, 'PR001', 'Panen Raya', 504, 0, 0, 504, '2022-06-29', 0, 0, 0, 0, '2022-06-28 18:02:22', '2022-06-28 18:25:24');

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
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id_sell`, `tgl_sell`, `id_karyawan`, `id_produk`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(19, '2021-12-20', 4, 5, 30, 1, '2022-03-27 21:32:07', '2022-04-12 12:15:40'),
(20, '2022-01-20', 4, 5, 50, 1, '2022-03-27 21:33:17', '2022-04-12 12:15:40'),
(23, '2022-02-20', 4, 5, 60, 1, '2022-03-27 21:46:10', '2022-04-12 12:15:40'),
(24, '2022-03-20', 4, 5, 60, 1, '2022-03-27 22:05:21', '2022-04-12 12:15:40'),
(139, '2022-01-27', 4, 6, 96, 0, '2022-06-27 04:45:24', '2022-06-27 04:45:24'),
(140, '2022-02-27', 4, 6, 100, 0, '2022-06-27 04:45:46', '2022-06-27 04:45:46'),
(141, '2022-03-27', 4, 6, 120, 0, '2022-06-27 04:45:59', '2022-06-27 04:45:59'),
(142, '2022-04-27', 4, 6, 100, 0, '2022-06-27 04:46:11', '2022-06-27 04:46:11');

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
(5, 'GRAM', '2022-03-27 16:29:48', '2022-03-27 16:29:48'),
(6, 'PCS', '2022-06-27 13:33:26', '2022-06-27 13:33:26');

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
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id_sell`),
  ADD KEY `id_sell` (`id_sell`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_karyawan` (`id_karyawan`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id` (`id`);

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
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id_purchase` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id_sell` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id_unit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `prod_gudangFk` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `units` (`id_unit`) ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `Fkidprod` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `Ffk_id` FOREIGN KEY (`id_karyawan`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sells_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
