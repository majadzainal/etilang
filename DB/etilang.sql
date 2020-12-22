-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2020 at 10:09 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etilang`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

DROP TABLE IF EXISTS `foto`;
CREATE TABLE IF NOT EXISTS `foto` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pelanggaran_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `foto_name_unique` (`name`),
  KEY `foto_pelanggaran_id_foreign` (`pelanggaran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ktp`
--

DROP TABLE IF EXISTS `ktp`;
CREATE TABLE IF NOT EXISTS `ktp` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_perkawinan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kewarganegaraan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ktp_nik_unique` (`nik`),
  UNIQUE KEY `ktp_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ktp`
--

INSERT INTO `ktp` (`id`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `status_perkawinan`, `pekerjaan`, `kewarganegaraan`, `email`, `created_at`, `updated_at`) VALUES
(1, '3175104803951001', 'Maja Jainul', 'Bekasi', '1993-02-05', 'Laki-laki', 'Bekasi', 'ISLAM', 'Menikah', 'IT Manager', 'Indonesia', 'maja.dzainal@gmail.com', '2020-11-30 03:49:04', '2020-11-30 03:49:04'),
(2, '3175777777777', 'sari', 'jakarta', '2020-02-05', 'Laki-laki', 'jl.xxx', 'ISLAM', 'Menikah', 'IT Manager', 'Indonesia', 'hendrinasavira3@gmail.com', '2020-12-16 12:45:10', '2020-12-16 12:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `description`, `created_at`, `updated_at`) VALUES
(20, 13, 'Login', '2020-12-21 07:25:21', '2020-12-21 07:25:21'),
(22, 14, 'Login', '2020-12-21 07:25:58', '2020-12-21 07:25:58'),
(23, 13, 'Logout', '2020-12-21 07:26:59', '2020-12-21 07:26:59'),
(24, 14, 'Login', '2020-12-21 07:27:08', '2020-12-21 07:27:08'),
(25, 14, 'Logout', '2020-12-21 07:27:42', '2020-12-21 07:27:42'),
(26, 13, 'Login', '2020-12-21 07:28:04', '2020-12-21 07:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_11_27_060143_add_column_soft_delete_table_users', 1),
(6, '2020_11_30_053152_create_petugas_table', 1),
(10, '2020_11_30_080015_create_ktp_table', 2),
(11, '2020_11_30_102404_create_table_pasal', 3),
(12, '2020_11_30_113955_create_table_pelanggaran', 4),
(13, '2020_11_30_114512_create_table_pelanggaran_item', 5),
(14, '2020_12_11_081908_add_column_status_table_pelanggaran', 6),
(15, '2020_12_11_104401_create_table_bukti_tilang', 7),
(16, '2020_12_11_112459_add_column_paid_table_pelanggaran', 8),
(17, '2020_12_16_074939_add_column_name_table_petugas', 9),
(18, '2020_12_21_132406_create_table_log_petugas', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pasal`
--

DROP TABLE IF EXISTS `pasal`;
CREATE TABLE IF NOT EXISTS `pasal` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perkara` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pasal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `denda` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pasal_pasal_unique` (`pasal`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pasal`
--

INSERT INTO `pasal` (`id`, `perkara`, `pasal`, `denda`, `created_at`, `updated_at`) VALUES
(2, 'Mengemudikan kendaraan bermotor di jalan, tidak memiliki Surat Ijin Mengemudi', 'Pasal 281 jo Pasal 77 ayat (1)', '1000000.00', '2020-11-30 04:20:01', '2020-11-30 04:25:06'),
(3, 'Kendaraan bermotor tidak dilengkapi dengan STNK atau STCK yang ditetapkan oleh Polri', 'Pasal 228 ayat (1) jo Pasal 106 ayat (5) huruf a', '500000.00', '2020-11-30 04:20:45', '2020-11-30 04:20:45'),
(4, 'Tidak dapat menunjukan Surat Izin Mengemudi yang sah', 'Pasal 228 ayat (2) jo Pasal 106 ayat (5) huruf b', '250000.00', '2020-11-30 05:37:00', '2020-11-30 05:37:00'),
(5, 'Kendaraan Bermotor Tidak dipasangi Tanda Nomor Kendaraan Bermotor yang ditetapkan oleh Polri', 'Pasal 280 jo Pasal 68 ayat (1)', '500000.00', '2020-11-30 05:37:26', '2020-11-30 05:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

DROP TABLE IF EXISTS `pelanggaran`;
CREATE TABLE IF NOT EXISTS `pelanggaran` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pelanggaran_nik_foreign` (`nik`),
  KEY `pelanggaran_petugas_id_foreign` (`petugas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_item`
--

DROP TABLE IF EXISTS `pelanggaran_item`;
CREATE TABLE IF NOT EXISTS `pelanggaran_item` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pelanggaran_id` bigint(20) UNSIGNED NOT NULL,
  `pasal_id` bigint(20) UNSIGNED NOT NULL,
  `denda` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pelanggaran_item_pelanggaran_id_foreign` (`pelanggaran_id`),
  KEY `pelanggaran_item_pasal_id_foreign` (`pasal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
CREATE TABLE IF NOT EXISTS `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_perkawinan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `petugas_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `user_id`, `nik`, `name`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `status_perkawinan`, `created_at`, `updated_at`) VALUES
(9, 13, '317510480395112', 'administrator', 'Bekasi', '1993-02-05', 'Laki-laki', 'BEKASI', 'ISLAM', 'Menikah', '2020-12-21 07:23:53', '2020-12-21 07:23:53'),
(10, 14, '317510480395119', 'Petugas', 'Bekasi', '1993-02-05', 'Laki-laki', 'Bekasi', 'ISLAM', 'Menikah', '2020-12-21 07:24:59', '2020-12-21 07:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_level`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 'administrator', 'administrator@administrator.com', 'administrator', '2020-12-21 07:25:37', '$2y$10$Sj0ZBdYpAs8NKYOgJKAJquNAOyi37VAzEcWade27CyrG/TdPUCCfm', NULL, NULL, NULL, '2020-12-21 07:23:53', '2020-12-21 07:25:37', NULL),
(14, 'Petugas', 'petugas@petugas.com', 'petugas', '2020-12-21 07:27:21', '$2y$10$dEkf8sxjFVnfOqs8dwFTOeu5T.y5Aq3EvgTTabPakNo1XXxf1T/Oi', NULL, NULL, NULL, '2020-12-21 07:24:59', '2020-12-21 07:27:21', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_pelanggaran_id_foreign` FOREIGN KEY (`pelanggaran_id`) REFERENCES `pelanggaran` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_nik_foreign` FOREIGN KEY (`nik`) REFERENCES `ktp` (`nik`),
  ADD CONSTRAINT `pelanggaran_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`);

--
-- Constraints for table `pelanggaran_item`
--
ALTER TABLE `pelanggaran_item`
  ADD CONSTRAINT `pelanggaran_item_pasal_id_foreign` FOREIGN KEY (`pasal_id`) REFERENCES `pasal` (`id`),
  ADD CONSTRAINT `pelanggaran_item_pelanggaran_id_foreign` FOREIGN KEY (`pelanggaran_id`) REFERENCES `pelanggaran` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
