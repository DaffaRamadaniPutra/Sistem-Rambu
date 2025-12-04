-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2025 at 07:10 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_rambu`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 21, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/2Kfgq3YOJuTOudZtID0w95Zpo6NwXBdYxwUaZQYv.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Jalur Penyeberangan\", \"koordinat_gps\": \"-6.735586, 108.536318\"}}', NULL, '2025-12-03 09:58:54', '2025-12-03 09:58:54'),
(2, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 21, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-12-03 10:01:04', '2025-12-03 10:01:04'),
(3, 'rambu', 'Rambu telah restored', 'App\\Models\\Rambu', 'restored', 21, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/2Kfgq3YOJuTOudZtID0w95Zpo6NwXBdYxwUaZQYv.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Jalur Penyeberangan\", \"koordinat_gps\": \"-6.735586, 108.536318\"}}', NULL, '2025-12-03 10:01:04', '2025-12-03 10:01:04'),
(4, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 21, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/2Kfgq3YOJuTOudZtID0w95Zpo6NwXBdYxwUaZQYv.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Jalur Penyeberangan\", \"koordinat_gps\": \"-6.735586, 108.536318\"}}', NULL, '2025-12-03 10:01:15', '2025-12-03 10:01:15'),
(5, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 21, 'App\\Models\\User', 1, '{\"id\": 21, \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"nama_rambu\": \"Jalur Penyeberangan\"}', NULL, '2025-12-03 10:01:20', '2025-12-03 10:01:20'),
(6, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 22, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/Xkur5WNiDjWyJjRmXc98pKXsJsLX3R4cD3d6zHVS.png\", \"jenis\": \"Petunjuk\", \"lokasi\": \"Bima Stadion, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Putar Balik\", \"koordinat_gps\": \"-6.731510, 108.533120\"}}', NULL, '2025-12-03 10:34:42', '2025-12-03 10:34:42'),
(7, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-03 11:01:19', '2025-12-03 11:01:19'),
(8, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 5, '[]', NULL, '2025-12-03 11:02:38', '2025-12-03 11:02:38'),
(9, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 5, '[]', NULL, '2025-12-03 11:03:38', '2025-12-03 11:03:38'),
(10, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-03 11:12:18', '2025-12-03 11:12:18'),
(11, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 23, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/e4QI6k1dUsMMR0YRr2p6IOeErmtyxsw3j7eli5Qp.png\", \"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 8, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.730301, 108.537817\"}}', NULL, '2025-12-03 12:28:52', '2025-12-03 12:28:52'),
(12, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 23, 'App\\Models\\User', 1, '{\"old\": {\"kondisi\": \"Rusak\"}, \"attributes\": {\"kondisi\": \"Baik\"}}', NULL, '2025-12-03 12:29:17', '2025-12-03 12:29:17'),
(13, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 23, 'App\\Models\\User', 1, '{\"old\": {\"lokasi\": \"Jalan Terusan Pemuda No. 8, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\"}, \"attributes\": {\"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\"}}', NULL, '2025-12-03 12:29:40', '2025-12-03 12:29:40'),
(14, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 23, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/e4QI6k1dUsMMR0YRr2p6IOeErmtyxsw3j7eli5Qp.png\", \"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.730301, 108.537817\"}}', NULL, '2025-12-03 12:29:52', '2025-12-03 12:29:52'),
(15, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 23, 'App\\Models\\User', 1, '{\"id\": 23, \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"nama_rambu\": \"Dilarang Parkir\"}', NULL, '2025-12-03 12:30:05', '2025-12-03 12:30:05'),
(16, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 24, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/b3LNh5jJSbjunz0RmL0xLAFM1zvVhtQiLU35ntUJ.png\", \"jenis\": \"Perintah\", \"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"parkir\", \"koordinat_gps\": \"-6.730164, 108.535197\"}}', NULL, '2025-12-03 12:34:59', '2025-12-03 12:34:59'),
(17, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 24, 'App\\Models\\User', 1, '{\"old\": {\"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\"}, \"attributes\": {\"lokasi\": \"Jalan Terusan Pemuda No. 12, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\"}}', NULL, '2025-12-03 12:36:00', '2025-12-03 12:36:00'),
(18, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 24, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/b3LNh5jJSbjunz0RmL0xLAFM1zvVhtQiLU35ntUJ.png\", \"jenis\": \"Perintah\", \"lokasi\": \"Jalan Terusan Pemuda No. 12, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"parkir\", \"koordinat_gps\": \"-6.730164, 108.535197\"}}', NULL, '2025-12-03 12:43:53', '2025-12-03 12:43:53'),
(19, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 24, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-12-03 12:55:25', '2025-12-03 12:55:25'),
(20, 'rambu', 'Rambu telah restored', 'App\\Models\\Rambu', 'restored', 24, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/b3LNh5jJSbjunz0RmL0xLAFM1zvVhtQiLU35ntUJ.png\", \"jenis\": \"Perintah\", \"lokasi\": \"Jalan Terusan Pemuda No. 12, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"parkir\", \"koordinat_gps\": \"-6.730164, 108.535197\"}}', NULL, '2025-12-03 12:55:25', '2025-12-03 12:55:25'),
(21, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 24, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/b3LNh5jJSbjunz0RmL0xLAFM1zvVhtQiLU35ntUJ.png\", \"jenis\": \"Perintah\", \"lokasi\": \"Jalan Terusan Pemuda No. 12, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"parkir\", \"koordinat_gps\": \"-6.730164, 108.535197\"}}', NULL, '2025-12-03 12:58:01', '2025-12-03 12:58:01'),
(22, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 24, 'App\\Models\\User', 1, '{\"id\": 24, \"lokasi\": \"Jalan Terusan Pemuda No. 12, Kesambi, Cirebon, Jawa Barat\", \"nama_rambu\": \"parkir\"}', NULL, '2025-12-03 12:58:38', '2025-12-03 12:58:38'),
(23, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 22, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/Xkur5WNiDjWyJjRmXc98pKXsJsLX3R4cD3d6zHVS.png\", \"jenis\": \"Petunjuk\", \"lokasi\": \"Bima Stadion, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Putar Balik\", \"koordinat_gps\": \"-6.731510, 108.533120\"}}', NULL, '2025-12-03 13:07:14', '2025-12-03 13:07:14'),
(24, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 22, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-12-03 13:24:11', '2025-12-03 13:24:11'),
(25, 'rambu', 'Rambu telah restored', 'App\\Models\\Rambu', 'restored', 22, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/Xkur5WNiDjWyJjRmXc98pKXsJsLX3R4cD3d6zHVS.png\", \"jenis\": \"Petunjuk\", \"lokasi\": \"Bima Stadion, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Putar Balik\", \"koordinat_gps\": \"-6.731510, 108.533120\"}}', NULL, '2025-12-03 13:24:11', '2025-12-03 13:24:11'),
(26, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 22, 'App\\Models\\User', 1, '{\"old\": {\"lokasi\": \"Bima Stadion, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132\", \"kondisi\": \"Baik\"}, \"attributes\": {\"lokasi\": \"Bima Stadion 2, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132\", \"kondisi\": \"Rusak\"}}', NULL, '2025-12-03 13:24:37', '2025-12-03 13:24:37'),
(27, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 22, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/Xkur5WNiDjWyJjRmXc98pKXsJsLX3R4cD3d6zHVS.png\", \"jenis\": \"Petunjuk\", \"lokasi\": \"Bima Stadion 2, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"Putar Balik\", \"koordinat_gps\": \"-6.731510, 108.533120\"}}', NULL, '2025-12-03 13:24:51', '2025-12-03 13:24:51'),
(28, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 22, 'App\\Models\\User', 1, '{\"id\": 22, \"lokasi\": \"Bima Stadion 2, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132\", \"nama_rambu\": \"Putar Balik\"}', NULL, '2025-12-03 13:24:59', '2025-12-03 13:24:59'),
(29, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 25, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/VlPjpxoZwYCMdkTB5xsIrr0Bh5Zni5nMGcYtMLFy.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Jalan Licin\", \"koordinat_gps\": \"-6.730197, 108.533228\"}}', NULL, '2025-12-03 13:26:21', '2025-12-03 13:26:21'),
(30, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 25, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/VlPjpxoZwYCMdkTB5xsIrr0Bh5Zni5nMGcYtMLFy.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Jalan Licin\", \"koordinat_gps\": \"-6.730197, 108.533228\"}}', NULL, '2025-12-03 13:28:39', '2025-12-03 13:28:39'),
(31, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 25, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-12-03 13:28:56', '2025-12-03 13:28:56'),
(32, 'rambu', 'Rambu telah restored', 'App\\Models\\Rambu', 'restored', 25, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/VlPjpxoZwYCMdkTB5xsIrr0Bh5Zni5nMGcYtMLFy.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Jalan Licin\", \"koordinat_gps\": \"-6.730197, 108.533228\"}}', NULL, '2025-12-03 13:28:56', '2025-12-03 13:28:56'),
(33, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 25, 'App\\Models\\User', 1, '{\"old\": {\"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\"}, \"attributes\": {\"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\"}}', NULL, '2025-12-03 14:08:19', '2025-12-03 14:08:19'),
(34, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 25, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/VlPjpxoZwYCMdkTB5xsIrr0Bh5Zni5nMGcYtMLFy.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"Jalan Licin\", \"koordinat_gps\": \"-6.730197, 108.533228\"}}', NULL, '2025-12-03 14:08:49', '2025-12-03 14:08:49'),
(35, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 25, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-12-03 14:08:53', '2025-12-03 14:08:53'),
(36, 'rambu', 'Rambu telah restored', 'App\\Models\\Rambu', 'restored', 25, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/VlPjpxoZwYCMdkTB5xsIrr0Bh5Zni5nMGcYtMLFy.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"Jalan Licin\", \"koordinat_gps\": \"-6.730197, 108.533228\"}}', NULL, '2025-12-03 14:08:53', '2025-12-03 14:08:53'),
(37, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 25, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/VlPjpxoZwYCMdkTB5xsIrr0Bh5Zni5nMGcYtMLFy.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"Jalan Licin\", \"koordinat_gps\": \"-6.730197, 108.533228\"}}', NULL, '2025-12-03 14:09:17', '2025-12-03 14:09:17'),
(38, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 25, 'App\\Models\\User', 1, '{\"id\": 25, \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"nama_rambu\": \"Jalan Licin\"}', NULL, '2025-12-03 14:09:25', '2025-12-03 14:09:25'),
(39, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 26, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/82FEHbNXMlgVDrFz179FTkp25BqIw3wt4GBzId2i.png\", \"jenis\": \"Petunjuk\", \"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Putar Balik\", \"koordinat_gps\": \"-6.729913, 108.534601\"}}', NULL, '2025-12-03 14:10:05', '2025-12-03 14:10:05'),
(40, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-03 15:34:26', '2025-12-03 15:34:26'),
(41, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 5, '[]', NULL, '2025-12-03 15:34:38', '2025-12-03 15:34:38'),
(42, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 27, 'App\\Models\\User', 5, '{\"attributes\": {\"foto\": \"fotos/LBiGjDkNpf264uv7IyFviI3JxyV2r4ArylaYmWpJ.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.730611, 108.535438\"}}', NULL, '2025-12-03 15:45:59', '2025-12-03 15:45:59'),
(43, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 27, 'App\\Models\\User', 5, '{\"old\": {\"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\"}, \"attributes\": {\"lokasi\": \"Jalan Terusan Pemuda No. 12, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\"}}', NULL, '2025-12-03 15:49:28', '2025-12-03 15:49:28'),
(44, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 27, 'App\\Models\\User', 5, '{\"old\": {\"foto\": \"fotos/LBiGjDkNpf264uv7IyFviI3JxyV2r4ArylaYmWpJ.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 12, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.730611, 108.535438\"}}', NULL, '2025-12-03 15:50:28', '2025-12-03 15:50:28'),
(45, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 5, '[]', NULL, '2025-12-03 15:51:04', '2025-12-03 15:51:04'),
(46, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-03 15:51:13', '2025-12-03 15:51:13'),
(47, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 26, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/82FEHbNXMlgVDrFz179FTkp25BqIw3wt4GBzId2i.png\", \"jenis\": \"Petunjuk\", \"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Putar Balik\", \"koordinat_gps\": \"-6.729913, 108.534601\"}}', NULL, '2025-12-03 15:52:18', '2025-12-03 15:52:18'),
(48, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 26, 'App\\Models\\User', 1, '{\"id\": 26, \"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"nama_rambu\": \"Putar Balik\"}', NULL, '2025-12-03 15:52:40', '2025-12-03 15:52:40'),
(49, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 27, 'App\\Models\\User', 1, '{\"id\": 27, \"lokasi\": \"Jalan Terusan Pemuda No. 12, Kesambi, Cirebon, Jawa Barat\", \"nama_rambu\": \"Dilarang Parkir\"}', NULL, '2025-12-03 15:52:43', '2025-12-03 15:52:43'),
(50, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 28, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/u6etzYGPOQPRMo9JBXXzBY4XEu1MbqkH2RV3Qq5R.png\", \"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.732661, 108.533163\"}}', NULL, '2025-12-03 16:09:05', '2025-12-03 16:09:05'),
(51, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 28, 'App\\Models\\User', 1, '{\"old\": {\"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\"}, \"attributes\": {\"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\"}}', NULL, '2025-12-03 16:19:22', '2025-12-03 16:19:22'),
(52, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-03 16:19:51', '2025-12-03 16:19:51'),
(53, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 5, '[]', NULL, '2025-12-03 16:19:58', '2025-12-03 16:19:58'),
(54, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 5, '[]', NULL, '2025-12-03 16:37:45', '2025-12-03 16:37:45'),
(55, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-03 16:37:53', '2025-12-03 16:37:53'),
(56, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 28, 'App\\Models\\User', 1, '{\"old\": {\"kondisi\": \"Rusak\"}, \"attributes\": {\"kondisi\": \"Perlu Perbaikan\"}}', NULL, '2025-12-03 16:38:04', '2025-12-03 16:38:04'),
(57, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 28, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/u6etzYGPOQPRMo9JBXXzBY4XEu1MbqkH2RV3Qq5R.png\", \"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.732661, 108.533163\"}}', NULL, '2025-12-03 16:39:16', '2025-12-03 16:39:16'),
(58, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 29, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/9siD4qu2AHp1Aze2uRdqGBJP0K16WMqw9UlBfCoe.png\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 8, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Jalan Licin\", \"koordinat_gps\": \"-6.730215, 108.533211\"}}', NULL, '2025-12-03 16:42:30', '2025-12-03 16:42:30'),
(59, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 30, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/QCODxlK30KbWtcgN7zF4ZN4Pr561tzk7X8Ue2t7N.png\", \"jenis\": \"Petunjuk\", \"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"Putar Balik\", \"koordinat_gps\": \"-6.729652, 108.535427\"}}', NULL, '2025-12-03 16:43:10', '2025-12-03 16:43:10'),
(60, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 31, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/KQ90RuOY68BdajGXlOcBbnKiv3giKduB1lJMxVzX.png\", \"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.730389, 108.537788\"}}', NULL, '2025-12-03 16:43:37', '2025-12-03 16:43:37'),
(61, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 32, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/1ds80YjjDMhPa8UqJJqPYjpo5HlAA112GpGpUBwy.png\", \"jenis\": \"Perintah\", \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"parkir\", \"koordinat_gps\": \"-6.730451, 108.535776\"}}', NULL, '2025-12-03 16:44:44', '2025-12-03 16:44:44'),
(62, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 28, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-12-03 16:45:52', '2025-12-03 16:45:52'),
(63, 'rambu', 'Rambu telah restored', 'App\\Models\\Rambu', 'restored', 28, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/u6etzYGPOQPRMo9JBXXzBY4XEu1MbqkH2RV3Qq5R.png\", \"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.732661, 108.533163\"}}', NULL, '2025-12-03 16:45:52', '2025-12-03 16:45:52'),
(64, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 31, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/KQ90RuOY68BdajGXlOcBbnKiv3giKduB1lJMxVzX.png\", \"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.730389, 108.537788\"}}', NULL, '2025-12-03 16:46:10', '2025-12-03 16:46:10'),
(65, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 31, 'App\\Models\\User', 1, '{\"id\": 31, \"lokasi\": \"Jalan Terusan Pemuda No. 10, Kesambi, Cirebon, Jawa Barat\", \"nama_rambu\": \"Dilarang Parkir\"}', NULL, '2025-12-03 16:46:28', '2025-12-03 16:46:28'),
(66, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 32, 'App\\Models\\User', 1, '{\"old\": {\"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\"}, \"attributes\": {\"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\"}}', NULL, '2025-12-03 17:21:22', '2025-12-03 17:21:22'),
(67, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 32, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/1ds80YjjDMhPa8UqJJqPYjpo5HlAA112GpGpUBwy.png\", \"jenis\": \"Perintah\", \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"parkir\", \"koordinat_gps\": \"-6.730451, 108.535776\"}}', NULL, '2025-12-03 17:21:28', '2025-12-03 17:21:28'),
(68, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 32, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-12-03 17:21:35', '2025-12-03 17:21:35'),
(69, 'rambu', 'Rambu telah restored', 'App\\Models\\Rambu', 'restored', 32, 'App\\Models\\User', 1, '{\"attributes\": {\"foto\": \"fotos/1ds80YjjDMhPa8UqJJqPYjpo5HlAA112GpGpUBwy.png\", \"jenis\": \"Perintah\", \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"parkir\", \"koordinat_gps\": \"-6.730451, 108.535776\"}}', NULL, '2025-12-03 17:21:35', '2025-12-03 17:21:35'),
(70, 'rambu', 'Rambu telah deleted', 'App\\Models\\Rambu', 'deleted', 32, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/1ds80YjjDMhPa8UqJJqPYjpo5HlAA112GpGpUBwy.png\", \"jenis\": \"Perintah\", \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\", \"nama_rambu\": \"parkir\", \"koordinat_gps\": \"-6.730451, 108.535776\"}}', NULL, '2025-12-03 17:21:41', '2025-12-03 17:21:41'),
(71, 'default', 'Rambu dihapus PERMANEN dari sistem', 'App\\Models\\Rambu', NULL, 32, 'App\\Models\\User', 1, '{\"id\": 32, \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"nama_rambu\": \"parkir\"}', NULL, '2025-12-03 17:21:46', '2025-12-03 17:21:46'),
(72, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-04 01:55:54', '2025-12-04 01:55:54'),
(73, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-04 02:02:22', '2025-12-04 02:02:22'),
(74, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 5, '[]', NULL, '2025-12-04 02:02:31', '2025-12-04 02:02:31'),
(75, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 33, 'App\\Models\\User', 5, '{\"attributes\": {\"foto\": \"fotos/zYUXDGU4kLcQvuKNn5SkMVRYfMljq0g0izyj3wsE.png\", \"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Baik\", \"nama_rambu\": \"Dilarang Parkir\", \"koordinat_gps\": \"-6.732133, 108.535446\"}}', NULL, '2025-12-04 02:04:41', '2025-12-04 02:04:41'),
(76, 'rambu', 'Rambu telah created', 'App\\Models\\Rambu', 'created', 34, 'App\\Models\\User', 5, '{\"attributes\": {\"foto\": \"fotos/TUOMyDP44VCqlXgysC2MQ3cBLpQC3h1j59EIYVfm.JPG\", \"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\", \"nama_rambu\": \"Jalur Penyeberangan\", \"koordinat_gps\": \"-6.730642, 108.535457\"}}', NULL, '2025-12-04 02:06:02', '2025-12-04 02:06:02'),
(77, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 5, '[]', NULL, '2025-12-04 02:07:19', '2025-12-04 02:07:19'),
(78, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 6, '[]', NULL, '2025-12-04 02:07:31', '2025-12-04 02:07:31'),
(79, 'default', 'logout', NULL, NULL, NULL, 'App\\Models\\User', 6, '[]', NULL, '2025-12-04 02:10:19', '2025-12-04 02:10:19'),
(80, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-12-04 02:12:39', '2025-12-04 02:12:39'),
(81, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 34, 'App\\Models\\User', 1, '{\"old\": {\"foto\": \"fotos/TUOMyDP44VCqlXgysC2MQ3cBLpQC3h1j59EIYVfm.JPG\"}, \"attributes\": {\"foto\": \"fotos/fSvM7Ro2Q070gf6sfOr7vO1vTxOEv4qlE6fIXgln.png\"}}', NULL, '2025-12-04 02:13:14', '2025-12-04 02:13:14'),
(82, 'rambu', 'Rambu telah updated', 'App\\Models\\Rambu', 'updated', 34, 'App\\Models\\User', 1, '{\"old\": {\"jenis\": \"Peringatan\", \"lokasi\": \"Jalan Terusan Pemuda No. 11, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Perlu Perbaikan\"}, \"attributes\": {\"jenis\": \"Larangan\", \"lokasi\": \"Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat\", \"kondisi\": \"Rusak\"}}', NULL, '2025-12-04 02:13:37', '2025-12-04 02:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_26_095218_create_rambus_table', 1),
(5, '2025_11_27_012044_add_soft_deletes_to_rambus_table', 2),
(6, '2025_11_27_021916_create_activity_log_table', 3),
(7, '2025_11_27_021917_add_event_column_to_activity_log_table', 3),
(8, '2025_11_27_021918_add_batch_uuid_column_to_activity_log_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rambus`
--

CREATE TABLE `rambus` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nama_rambu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('Larangan','Peringatan','Petunjuk','Perintah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` enum('Baik','Rusak','Perlu Perbaikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Baik',
  `koordinat_gps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rambus`
--

INSERT INTO `rambus` (`id`, `user_id`, `nama_rambu`, `jenis`, `lokasi`, `kondisi`, `koordinat_gps`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(28, 1, 'Dilarang Parkir', 'Larangan', 'Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat', 'Perlu Perbaikan', '-6.732661, 108.533163', 'fotos/u6etzYGPOQPRMo9JBXXzBY4XEu1MbqkH2RV3Qq5R.png', '2025-12-03 16:09:05', '2025-12-03 16:45:52', NULL),
(29, 1, 'Jalan Licin', 'Peringatan', 'Jalan Terusan Pemuda No. 8, Kesambi, Cirebon, Jawa Barat', 'Baik', '-6.730215, 108.533211', 'fotos/9siD4qu2AHp1Aze2uRdqGBJP0K16WMqw9UlBfCoe.png', '2025-12-03 16:42:30', '2025-12-03 16:42:30', NULL),
(30, 1, 'Putar Balik', 'Petunjuk', 'Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat', 'Rusak', '-6.729652, 108.535427', 'fotos/QCODxlK30KbWtcgN7zF4ZN4Pr561tzk7X8Ue2t7N.png', '2025-12-03 16:43:10', '2025-12-03 16:43:10', NULL),
(33, 5, 'Dilarang Parkir', 'Larangan', 'Jalan Terusan Pemuda No. 9, Kesambi, Cirebon, Jawa Barat', 'Baik', '-6.732133, 108.535446', 'fotos/zYUXDGU4kLcQvuKNn5SkMVRYfMljq0g0izyj3wsE.png', '2025-12-04 02:04:41', '2025-12-04 02:04:41', NULL),
(34, 5, 'Jalur Penyeberangan', 'Larangan', 'Jalan Terusan Pemuda No. 1, Kesambi, Cirebon, Jawa Barat', 'Rusak', '-6.730642, 108.535457', 'fotos/fSvM7Ro2Q070gf6sfOr7vO1vTxOEv4qlE6fIXgln.png', '2025-12-04 02:06:02', '2025-12-04 02:13:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rrUKjg20mScy3YuODo63vblOZ2l86gmxDUvpUP8M', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMGpTaFo3cjEyVlYwbHBHbUk3enFxREZJRlBnRzd6RThNdml2czNReCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXRhIjtzOjU6InJvdXRlIjtzOjEwOiJyYW1idS5wZXRhIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764815902);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'petugas',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nip`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Daffa', 'daffarp@gmail.com', '123123123123123123', 'admin', NULL, '$2y$12$cOGlRDzJIWIAXFhTc2XWSeHFlbqqWdSWEO/Wdbm3mwRJvFm6OC6tW', NULL, '2025-11-26 04:33:19', '2025-11-26 18:44:52'),
(5, 'aldi', 'aldi@gmail.com', '321321321321321321', 'petugas', NULL, '$2y$12$0DGpS09eEAiqPXCB3fXEM.osH7Js8w1fZrqEB3WX1IMo5HzBApHuO', NULL, '2025-12-01 20:28:00', '2025-12-01 20:28:00'),
(6, 'ramadani', 'ramadani@gmail.com', '231231231231231231', 'petugas', NULL, '$2y$12$7UoWgvIkxZ/mDxWHNauNJOO9M.WRpQxqX8UI9qAnJ0HD.sBLHBpZO', NULL, '2025-12-04 02:02:16', '2025-12-04 02:02:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rambus`
--
ALTER TABLE `rambus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rambus_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rambus`
--
ALTER TABLE `rambus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rambus`
--
ALTER TABLE `rambus`
  ADD CONSTRAINT `rambus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
