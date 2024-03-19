-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Mar 2024 pada 10.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dms_adasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_code` varchar(255) NOT NULL,
  `name_customer` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `customer_code`, `name_customer`, `area`, `email`, `no_telp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BAT07', 'PT BATUM SARANA SEJAHTERA', '140', 'batum@gmail.com', '089128316313', '1', NULL, NULL),
(2, 'DUT01\r\n', 'PT. DUTA NICHIRINDO PRATAMA', '2', 'duta@gmail.com', '08126152371313', '1', NULL, NULL),
(3, 'YUK01', 'PT YUKITA AMI DAI INDONESIA', '150', 'yukita@gmail.com', '081631872361', '1', NULL, NULL),
(4, 'ISK01\r\n', 'PT. ISK INDONESIA\r\n', '0\r\n', 'isk@gmail.com', '0856776107121', '1', NULL, NULL),
(5, 'CAL04', 'PT CALICO METALS INDONESIA', '120', 'calicio@gmail.com', '087727432323', '1', NULL, NULL),
(6, 'HAR01', 'PT. HARAPAN JAYA ABADI TEKNIK INDONESIA', '420', 'harapanjaya@gmail.com', '087612531231', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_preventives`
--

CREATE TABLE `detail_preventives` (
  `id` bigint(20) NOT NULL,
  `id_mesin` int(11) NOT NULL,
  `issue` varchar(100) DEFAULT NULL,
  `issue_checked` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_preventives`
--

INSERT INTO `detail_preventives` (`id`, `id_mesin`, `issue`, `issue_checked`, `start`, `end`, `created_at`, `updated_at`) VALUES
(1, 29, 'Buat Majalah', 1, '2024-03-16 08:47:00', NULL, '2024-03-15 01:47:06', '2024-03-15 01:48:57'),
(2, 29, 'Buat Makalah', 1, '2024-03-16 08:47:00', NULL, '2024-03-15 01:47:06', '2024-03-15 02:16:03'),
(3, 29, 'Isi Majalah', 1, '2024-03-19 08:47:00', NULL, '2024-03-15 01:47:22', '2024-03-15 01:52:20'),
(4, 29, 'Isi Makalah', 1, '2024-03-19 08:47:00', NULL, '2024-03-15 01:47:22', '2024-03-15 02:41:36'),
(5, 35, 'Sparepart Rusak', 1, '2024-03-23 10:01:00', NULL, '2024-03-15 03:01:34', '2024-03-15 03:01:47'),
(6, 35, 'Parts Tidak ada', 1, '2024-03-23 10:01:00', NULL, '2024-03-15 03:01:34', '2024-03-15 03:01:57'),
(7, 31, 'Oke Siapp', 0, '2024-03-23 10:52:00', NULL, '2024-03-15 03:52:22', '2024-03-15 03:52:22'),
(8, 31, 'Salah isi', 0, '2024-03-23 10:52:00', NULL, '2024-03-15 03:52:22', '2024-03-15 03:52:22'),
(9, 30, 'Pengecekan Coolan', 1, '2024-03-18 11:06:00', NULL, '2024-03-15 04:06:12', '2024-03-15 04:07:10'),
(10, 30, 'Pengecekan PLC', 1, '2024-03-18 11:06:00', NULL, '2024-03-15 04:06:12', '2024-03-15 04:07:10'),
(11, 35, 'Ganti Parts', 1, '2024-05-01 11:08:00', NULL, '2024-03-15 04:08:40', '2024-03-15 04:10:01'),
(12, 31, 'Salah Sparepart', 1, '2024-03-15 08:22:00', NULL, '2024-03-18 01:22:04', '2024-03-18 01:23:40'),
(13, 31, 'Mesin Rusak', 1, '2024-03-15 08:22:00', NULL, '2024-03-18 01:22:04', '2024-03-18 01:23:40'),
(14, 31, 'Salah Sparepart', 0, '2024-03-15 08:22:00', NULL, '2024-03-18 01:22:25', '2024-03-18 01:22:25'),
(15, 31, 'Mesin Rusak', 0, '2024-03-15 08:22:00', NULL, '2024-03-18 01:22:25', '2024-03-18 01:22:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `id_mesin` int(11) NOT NULL,
  `nama_mesin` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `no_mesin` varchar(20) NOT NULL,
  `mfg_date` year(4) NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `events`
--

INSERT INTO `events` (`id`, `id_mesin`, `nama_mesin`, `type`, `no_mesin`, `mfg_date`, `pic`, `start`, `end`, `status`, `created_at`, `updated_at`) VALUES
(1, 29, 'Mesin Cutting 6', 'Honda', 'CC3', '2010', NULL, '2024-03-16 08:47:00', '2024-03-08 09:37:00', 1, '2024-03-15 01:47:06', '2024-03-15 02:37:48'),
(2, 29, 'Mesin Cutting 6', 'Honda', 'CC3', '2010', NULL, '2024-03-19 08:47:00', NULL, 0, '2024-03-15 01:47:22', '2024-03-15 01:47:22'),
(3, 29, 'Mesin Cutting 6', 'Honda', 'CC3', '2010', NULL, '2024-03-19 08:47:00', '2024-03-14 09:41:00', 1, '2024-03-15 02:41:53', '2024-03-15 02:41:53'),
(4, 35, 'Maching Custom 1', 'Honda', 'CC3', '2000', NULL, '2024-03-23 10:01:00', '2024-03-16 10:02:00', 0, '2024-03-15 03:01:34', '2024-03-15 03:02:14'),
(5, 35, 'Maching Custom 1', 'Honda', 'CC3', '2000', NULL, '2024-03-23 10:01:00', '2024-03-16 10:02:00', 1, '2024-03-15 03:02:14', '2024-03-15 03:02:14'),
(6, 31, 'Mesin Cutting 8', 'Honda', 'CC3', '2010', NULL, '2024-03-23 10:52:00', NULL, 0, '2024-03-15 03:52:22', '2024-03-15 03:52:22'),
(7, 30, 'Mesin Cutting 7', 'Honda', 'CC3', '2010', NULL, '2024-03-18 11:06:00', '2024-03-25 11:06:00', 0, '2024-03-15 04:06:12', '2024-03-15 04:07:26'),
(8, 30, 'Mesin Cutting 7', 'Honda', 'CC3', '2010', NULL, '2024-03-18 11:06:00', '2024-03-25 11:06:00', 1, '2024-03-15 04:07:26', '2024-03-15 04:07:26'),
(9, 35, 'Maching Custom 1', 'Honda', 'CC3', '2000', NULL, '2024-05-01 11:08:00', '2024-05-02 11:09:00', 0, '2024-03-15 04:08:40', '2024-03-15 04:10:01'),
(10, 35, 'Maching Custom 1', 'Honda', 'CC3', '2000', NULL, '2024-05-01 11:08:00', '2024-05-02 11:09:00', 1, '2024-03-15 04:10:01', '2024-03-15 04:10:01'),
(11, 31, 'Mesin Cutting 8', 'Honda', 'CC3', '2010', NULL, '2024-03-15 08:22:00', NULL, 0, '2024-03-18 01:22:04', '2024-03-18 01:22:04'),
(12, 31, 'Mesin Cutting 8', 'Honda', 'CC3', '2010', NULL, '2024-03-15 08:22:00', '2024-03-23 08:23:00', 0, '2024-03-18 01:22:25', '2024-03-18 01:24:46'),
(13, 31, 'Mesin Cutting 8', 'Honda', 'CC3', '2010', NULL, '2024-03-15 08:22:00', '2024-03-23 08:23:00', 1, '2024-03-18 01:24:46', '2024-03-18 01:24:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_f_p_p_s`
--

CREATE TABLE `form_f_p_p_s` (
  `id` bigint(20) NOT NULL,
  `id_fpp` varchar(20) NOT NULL,
  `pemohon` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `section` varchar(50) NOT NULL,
  `mesin` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `kendala` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `form_f_p_p_s`
--

INSERT INTO `form_f_p_p_s` (`id`, `id_fpp`, `pemohon`, `date`, `section`, `mesin`, `lokasi`, `kendala`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(88, 'FP0001', 'Mas Medi', '2024-02-09', 'MC Custom', 'CC2', 'DS8', 'sparepart rusak', 'gambar/1eC0Zr7kykxyJpEFOWaNWFc1TYWW7yt7Ll3nEBm0.jpg', 3, '2024-02-06 08:21:56', '2024-02-06 08:26:27'),
(89, 'FP0089', 'Mas Mula', '2024-01-30', 'MC Custom', 'CC3', 'Deltamas', 'Oke', NULL, 3, '2024-02-06 09:06:24', '2024-02-13 03:53:13'),
(90, 'FP0090', 'Mas Mula', '2024-02-08', 'Machining', 'CC3', 'DS8', 'q', 'gambar/rHn6bWX2JdnRaztLQwhmU2cBuFfzQmSJp7svnDeW.png', 1, '2024-02-13 08:36:33', '2024-02-15 06:41:05'),
(91, 'FP0091', 'Rina Suryani', '2024-02-09', 'Bubut', 'CC1', 'Deltamas', 'Salah Sparepart', 'gambar/LSl8UQde9zaEx6uhYNsUWpdD7hsiEt4qB6t63B4u.jpg', 0, '2024-02-15 01:28:12', '2024-02-15 01:28:12'),
(92, 'FP0092', 'Rina Suryani', '2024-02-09', 'Machining', 'CC3', 'Deltamas', 'Salah Mesin', NULL, 0, '2024-02-15 01:32:19', '2024-02-15 01:32:19'),
(93, 'FP0093', 'Rina Suryani', '2024-02-09', 'Machining', 'CC3', 'Deltamas', 'Salah Mesin', NULL, 0, '2024-02-15 01:33:48', '2024-02-15 01:33:48'),
(94, 'FP0094', 'Rina Suryani', '2024-02-16', 'MC Custom', 'CC3', 'DS8', 'Salah Mesin Lagi', NULL, 1, '2024-02-15 01:34:34', '2024-02-15 04:25:52'),
(95, 'FP0095', 'Rina Suryani', '2024-02-16', 'MC Custom', 'CC2', 'Deltamas', 'Sparepart', NULL, 2, '2024-02-15 01:35:43', '2024-02-15 06:50:00'),
(96, 'FP0096', 'Mas Medi', '2024-02-17', 'Bubut', 'CC2', 'Deltamas', 'Oke', NULL, 3, '2024-02-15 03:13:52', '2024-02-15 06:24:46'),
(97, 'FP0097', 'Mash Adler', '2024-02-16', 'MC Custom', 'CC4', 'Deltamas', 'Aduh', NULL, 2, '2024-02-15 03:33:03', '2024-02-15 06:42:53'),
(98, 'FP0098', 'Mash Adler', '2024-02-16', 'MC Custom', 'CC3', 'DS8', 'Oke Sipp', 'assets/gambar/VsDUyEhxTIfj9zosFhL6AhTBiSgudCw365YzuRhf.jpg', 0, '2024-02-15 07:11:42', '2024-02-15 07:11:42'),
(99, 'FP0099', 'Mas Medi', '2024-02-17', 'MC Custom', 'CC2', 'DS8', 'Salah ISI', 'assets/gambar/gunung.jpg', 0, '2024-02-15 07:15:17', '2024-02-15 07:15:17'),
(100, 'FP0100', 'Rina Suryani Mega', '2024-02-14', 'MC Custom', 'CC3', 'Deltamas', 'SIAPPP', 'assets/gambar/gunung.jpg', 0, '2024-02-15 07:17:37', '2024-02-15 07:17:37'),
(101, 'FP0101', 'Mash Adler', '2024-02-16', 'Machining', 'CC2', 'DS8', 'A', 'gambar/9GZVSSGzXitCWDDcKPJ8DS6QEjtMQQNvP6N3kxPH.jpg', 1, '2024-02-15 07:21:52', '2024-02-15 08:07:20'),
(102, 'FP0102', 'Rina Suryani', '2024-02-13', 'Machining', 'CC1', 'Deltamas', 'OKEHHHH', 'assets/gambar/Mesin Rusak.jpg', 1, '2024-02-15 07:23:20', '2024-02-15 07:54:47'),
(103, 'FP0103', 'Mas Medi', '2024-02-16', 'Bubut', 'CC1', 'Deltamas', 'OKEEEEEEEEEEEEEEEEEEEEEEEE', 'assets/gambar/Mesin Rusak.jpg', 1, '2024-02-15 07:25:21', '2024-02-15 07:51:23'),
(104, 'FP0104', 'Mash Adler', '2024-02-17', 'Bubut', 'CC1', 'DS8', 'WOKEHHH', 'assets/gambar/Mesin Rusak.jpg', 3, '2024-02-15 07:31:27', '2024-02-15 07:48:23'),
(105, 'FP0105', 'Rina Suryani', '2024-02-03', 'Bubut', 'CC3', 'DS8', 'Salah Sparepart', 'assets/gambar/Struktur Organisasi.drawio.png', 1, '2024-02-16 01:29:47', '2024-03-18 01:46:44'),
(106, 'FP0106', 'Mash Adler', '2024-02-17', 'MC Custom', 'CC2', 'DS8', 'Wokehh Siapp', 'assets/gambar/Form FPP 0196.jpg', 2, '2024-02-16 01:37:24', '2024-02-16 12:03:47'),
(107, 'FP0107', 'Astra Daido', '2024-02-27', 'Machining', 'CC3', 'DS8', 'Sparepart', 'assets/gambar/gunung.jpg', 3, '2024-02-26 01:42:17', '2024-02-26 01:55:54'),
(108, 'FP0108', 'Rina Suryani', '2024-03-09', 'Bubut', 'CC1', 'DS8', 'd', NULL, 3, '2024-03-01 02:40:35', '2024-03-06 06:18:22'),
(109, 'FP0109', 'Rina Suryani', '2024-03-08', 'Cutting', 'CC2', 'DS8', 'Oke', NULL, 3, '2024-03-04 09:11:45', '2024-03-04 09:12:14'),
(110, 'FP0110', 'Astra Daido', '2024-03-14', 'MC Custom', 'CC2', 'Deltamas', 'Salah Isi', NULL, 3, '2024-03-04 10:34:26', '2024-03-05 00:55:15'),
(111, 'FP0111', 'Mash Adler', '2024-03-15', 'Bubut', 'CC4', 'DS8', 'Salah Sparepart', NULL, 0, '2024-03-06 04:21:43', '2024-03-06 04:21:43'),
(112, 'FP0112', 'Mas Medi', '2024-03-14', 'MC Custom', 'CC3', 'DS8', 'Salah Sparepart', 'assets/gambar/gunung.jpg', 3, '2024-03-06 06:07:01', '2024-03-06 06:18:10'),
(113, 'FP0113', 'Rina Suryani', '2024-03-08', 'MC Custom', 'CC3', 'DS8', 'Sparepart Rusak', 'assets/gambar/gunung.jpg', 3, '2024-03-13 06:49:27', '2024-03-13 06:53:56'),
(114, 'FP0114', 'Rina Suryani', '2024-03-22', 'Machining', 'CC3', 'DS8', 'Salah Sparepart', NULL, 3, '2024-03-18 01:09:08', '2024-03-18 01:10:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `handlings`
--

CREATE TABLE `handlings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_wo` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thickness` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `outer_diameter` varchar(255) DEFAULT NULL,
  `inner_diameter` varchar(255) DEFAULT NULL,
  `lenght` varchar(255) DEFAULT NULL,
  `qty` varchar(255) NOT NULL,
  `pcs` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `process_type` varchar(255) NOT NULL,
  `type_1` varchar(255) NOT NULL,
  `type_2` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `handlings`
--

INSERT INTO `handlings` (`id`, `no_wo`, `customer_id`, `type_id`, `thickness`, `weight`, `outer_diameter`, `inner_diameter`, `lenght`, `qty`, `pcs`, `category`, `process_type`, `type_1`, `type_2`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'WO/2024/00001', 3, 3, '200', '400', '55', '88', '150', '66', '3', 'Pecah', 'HeatTreatment', 'Complain', 'Claim', 'BSmpwpDOoZAMEx9YWaWTc3dpVTHOQ0IVOmtrfYHB.jpg', 3, '2024-03-18 01:59:55', '2024-03-18 02:04:48'),
(2, 'WO/2024/00000044', 2, 5, '123', '123', '123', '123', '123', '4', '6', 'Pecah', 'Cutting', 'Complain', NULL, 'QCUJcmYf9Kyeu20ET833jDqChwniZQISNJo66KCZ.jpg', 0, '2024-03-18 03:24:13', '2024-03-18 04:42:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mesins`
--

CREATE TABLE `mesins` (
  `id` bigint(20) NOT NULL,
  `nama_mesin` varchar(50) NOT NULL,
  `no_mesin` varchar(25) NOT NULL,
  `merk` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `mfg_date` year(4) NOT NULL,
  `acq_date` year(4) NOT NULL,
  `age` int(11) NOT NULL,
  `preventive_date` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `sparepart` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mesins`
--

INSERT INTO `mesins` (`id`, `nama_mesin`, `no_mesin`, `merk`, `type`, `mfg_date`, `acq_date`, `age`, `preventive_date`, `status`, `foto`, `sparepart`, `created_at`, `updated_at`) VALUES
(28, 'Mesin Cutting 5', 'CC3', 'Yamaha', 'Yamaha', '2010', '2024', 14, NULL, 0, 'public/assets/foto/s8kJfctIkT7orUX5Y0ptPB9hABk1f6kqnD2osFBF.jpg', 'public/assets/sparepart/lKhJkLFaomAxnWxqllPIZohPVLeEerP3kzitFBoZ.jpg', '2024-02-15 06:52:22', '2024-02-27 07:12:58'),
(29, 'Mesin Cutting 6', 'CC3', 'Honda', 'Honda', '2010', '2024', 14, '2024-02-17', 0, 'assets/foto/gunung.jpg', 'assets/sparepart/gunung.jpg', '2024-02-15 07:09:54', '2024-02-27 07:11:48'),
(30, 'Mesin Cutting 7', 'CC3', 'Honda', 'Honda', '2010', '2024', 14, NULL, 1, 'assets/foto/gunung.jpg', 'assets/sparepart/gunung.jpg', '2024-02-15 09:57:10', '2024-02-27 07:11:12'),
(31, 'Mesin Cutting 8', 'CC3', 'Honda', 'Honda', '2010', '2024', 14, NULL, 1, 'assets/foto/Mesin baru.jpg', 'assets/sparepart/Mesin baru.jpg', '2024-02-15 09:58:15', '2024-03-06 03:57:33'),
(35, 'Maching Custom 1', 'CC3', 'Honda', 'Honda', '2000', '2024', 24, NULL, 1, 'assets/foto/adasi-icon.png', 'assets/sparepart/adasi-icon.png', '2024-03-12 02:51:14', '2024-03-13 07:19:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_05_032039_create_customers_table', 1),
(6, '2024_02_05_032520_create_type_materials_table', 1),
(7, '2024_02_05_032957_create_handlings_table', 1),
(8, '2024_02_15_043000_create_roles_table', 2),
(9, '2024_02_22_004414_create_schedule_visits_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, NULL),
(2, 'Departemen Sales', NULL, NULL),
(3, 'Dept. Head Maintenance', '2024-03-06 01:37:50', '2024-03-06 01:37:50'),
(4, 'Departemen Production', '2024-03-14 01:14:20', '2024-03-14 01:14:20'),
(5, 'Departemen Maintenance', '2024-03-14 01:14:20', '2024-03-14 01:14:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule_visits`
--

CREATE TABLE `schedule_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `handling_id` bigint(20) UNSIGNED DEFAULT NULL,
  `schedule` datetime DEFAULT NULL,
  `results` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `schedule_visits`
--

INSERT INTO `schedule_visits` (`id`, `handling_id`, `schedule`, `results`, `due_date`, `pic`, `file`, `file_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-03-19 10:00:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-18 02:01:36', '2024-03-18 02:01:36'),
(2, 1, '2024-03-20 12:10:00', 'Perubahan Negosiasi dari complain ke claim', NULL, 'etosan', NULL, NULL, 1, '2024-03-18 02:03:10', '2024-03-18 02:03:10'),
(3, 1, '2024-03-22 10:00:00', NULL, '2024-03-25', 'Pak rojo & Eto', 'i379ussw6HrsarVzprdqLYThwqR4ls9XHqBEDkqY.pdf', 'OSP - Gathering 2022.pdf', 3, '2024-03-18 02:04:18', '2024-03-18 02:04:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sparepart`
--

CREATE TABLE `sparepart` (
  `id` bigint(20) NOT NULL,
  `sparepart` varchar(50) NOT NULL,
  `vendor` varchar(25) NOT NULL,
  `leadtime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tindak_lanjuts`
--

CREATE TABLE `tindak_lanjuts` (
  `id` bigint(20) NOT NULL,
  `id_fpp` varchar(20) NOT NULL,
  `tindak_lanjut` varchar(100) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `schedule_pengecekan` date DEFAULT NULL,
  `attachment_file` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tindak_lanjuts`
--

INSERT INTO `tindak_lanjuts` (`id`, `id_fpp`, `tindak_lanjut`, `due_date`, `schedule_pengecekan`, `attachment_file`, `status`, `note`, `created_at`, `updated_at`) VALUES
(133, 'FP0001', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-06 08:21:56', '2024-02-06 08:21:56'),
(134, 'FP0001', NULL, NULL, NULL, NULL, 1, 'Menunggu Sparepart', '2024-02-06 08:22:32', '2024-02-06 08:22:32'),
(135, 'FP0001', 'Sparepart diganti', '2024-02-07', '2024-02-02', NULL, 1, 'Menunggu Sparepart', '2024-02-06 08:23:49', '2024-02-06 08:23:49'),
(136, 'FP0001', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-06 08:24:57', '2024-02-06 08:24:57'),
(137, 'FP0001', NULL, NULL, NULL, NULL, 1, 'sparepartnya salah', '2024-02-06 08:25:23', '2024-02-06 08:25:23'),
(138, 'FP0001', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-06 08:25:47', '2024-02-06 08:25:47'),
(139, 'FP0001', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-02-06 08:25:56', '2024-02-06 08:25:56'),
(140, 'FP0001', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-02-06 08:26:27', '2024-02-06 08:26:27'),
(141, 'FP0089', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-06 09:06:24', '2024-02-06 09:06:24'),
(142, 'FP0089', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-06 09:06:35', '2024-02-06 09:06:35'),
(143, 'FP0089', 'Oke Siapp', '2024-02-07', '2024-02-08', 'public/EpntpX8As208kAD9ytIfv2IUV9qBSYmUZXiv1A4k.xlsx', 1, 'Menunggu Sparepart', '2024-02-06 09:12:36', '2024-02-06 09:12:36'),
(144, 'FP0089', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-13 03:52:58', '2024-02-13 03:52:58'),
(145, 'FP0089', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-02-13 03:53:04', '2024-02-13 03:53:04'),
(146, 'FP0089', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-02-13 03:53:13', '2024-02-13 03:53:13'),
(147, 'FP0090', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-13 08:36:33', '2024-02-13 08:36:33'),
(148, 'FP0090', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-13 08:36:46', '2024-02-13 08:36:46'),
(149, 'FP0090', 'Oke Siapp', '2024-02-05', '2024-02-06', NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-13 08:37:11', '2024-02-13 08:37:11'),
(150, 'FP0093', NULL, NULL, NULL, NULL, 0, NULL, '2024-02-15 01:33:48', '2024-02-15 01:33:48'),
(151, 'FP0095', NULL, NULL, NULL, NULL, 0, NULL, '2024-02-15 01:35:43', '2024-02-15 01:35:43'),
(152, 'FP0096', NULL, NULL, NULL, NULL, 0, NULL, '2024-02-15 03:13:52', '2024-02-15 03:13:52'),
(153, 'FP0097', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-15 03:33:03', '2024-02-15 03:33:03'),
(154, 'FP0097', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 03:41:58', '2024-02-15 03:41:58'),
(155, 'FP0097', 'Oke Siapp', '2024-02-10', '2024-02-17', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 03:45:53', '2024-02-15 03:45:53'),
(156, 'FP0096', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 04:07:57', '2024-02-15 04:07:57'),
(157, 'FP0096', 'Wokehh siapp', '2024-02-16', '2024-02-16', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 04:08:10', '2024-02-15 04:08:10'),
(158, 'FP0095', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 04:11:18', '2024-02-15 04:11:18'),
(159, 'FP0094', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 04:25:52', '2024-02-15 04:25:52'),
(160, 'FP0097', 'Oke Siapp', '2024-02-10', '2024-02-17', 'public/jm70DD01UFUQcY2fK1J1tMFVj0rXdPi224gxTINt.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-02-15 04:26:06', '2024-02-15 04:26:06'),
(161, 'FP0097', 'Oke Siapp', '2024-02-10', '2024-02-17', NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-15 04:36:05', '2024-02-15 04:36:05'),
(162, 'FP0096', 'Wokehh siapp', '2024-02-16', '2024-02-16', 'public/V8z4dPYdSaSC2CI7lXxrAkr2TYSxt3bt81Iohnob.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-02-15 04:39:09', '2024-02-15 04:39:09'),
(163, 'FP0096', 'Wokehh siapp', '2024-02-16', '2024-02-16', 'public/gefsp2bV2TURH6bAy1NMVKKSQKXCZB6gjWbbIJjP.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-02-15 04:47:58', '2024-02-15 04:47:58'),
(164, 'FP0096', 'Wokehh siapp', '2024-02-16', '2024-02-16', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 04:51:30', '2024-02-15 04:51:30'),
(165, 'FP0096', 'Wokehh siapp', '2024-02-16', '2024-02-16', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 06:17:51', '2024-02-15 06:17:51'),
(166, 'FP0096', 'Wokehh siapp', '2024-02-16', '2024-02-16', 'public/KGAU8dEe2LeJSfovIDhcIKbT6MJKHwyPkKvXWSTO.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-02-15 06:20:04', '2024-02-15 06:20:04'),
(167, 'FP0096', 'Wokehh siapp', '2024-02-16', '2024-02-16', NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-15 06:20:16', '2024-02-15 06:20:16'),
(168, 'FP0095', NULL, NULL, NULL, 'public/ETGZZejSRKkhfhC0iKwyxh7cai9mdtTDKYwRiWfL.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-02-15 06:22:27', '2024-02-15 06:22:27'),
(169, 'FP0097', NULL, NULL, NULL, NULL, 1, 'Maaf Salah File', '2024-02-15 06:23:47', '2024-02-15 06:23:47'),
(170, 'FP0096', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-02-15 06:24:30', '2024-02-15 06:24:30'),
(171, 'FP0096', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-02-15 06:24:46', '2024-02-15 06:24:46'),
(172, 'FP0097', 'Oke siappp', '2024-02-14', '2024-02-15', 'public/WmAClo9npRp2X5O9FS63PGMICU4j2RJqNFnsxdU0.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-02-15 06:30:47', '2024-02-15 06:30:47'),
(173, 'FP0097', 'Oke siappp', '2024-02-14', '2024-02-15', NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-15 06:31:23', '2024-02-15 06:31:23'),
(174, 'FP0095', 'Oke Sepp', '2024-02-22', '2024-02-15', NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-15 06:33:11', '2024-02-15 06:33:11'),
(175, 'FP0097', NULL, NULL, NULL, NULL, 1, 'Salah isi', '2024-02-15 06:33:53', '2024-02-15 06:33:53'),
(176, 'FP0095', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-02-15 06:34:08', '2024-02-15 06:34:08'),
(177, 'FP0095', NULL, NULL, NULL, NULL, 1, 'Salah isi', '2024-02-15 06:39:04', '2024-02-15 06:39:04'),
(178, 'FP0090', NULL, NULL, NULL, NULL, 1, NULL, '2024-02-15 06:41:05', '2024-02-15 06:41:05'),
(179, 'FP0097', 'Siapa ini', '2024-02-16', '2024-02-16', 'public/W4KzIRCAoV7UZ1jzKz9oBnXdztk23rt9FhsSZDq5.xlsx', 2, 'DISUBMIT MAINTENANCE', '2024-02-15 06:42:53', '2024-02-15 06:42:53'),
(180, 'FP0095', NULL, NULL, NULL, 'public/HZraPU8LA0jQQN1MohK6lRqD8akmT1WVShoRNErp.pdf', 1, 'Sedang Ditindaklanjuti', '2024-02-15 06:45:47', '2024-02-15 06:45:47'),
(181, 'FP0095', 'Oke Siapp', '2024-02-16', '2024-02-17', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 06:46:17', '2024-02-15 06:46:17'),
(182, 'FP0095', 'Oke Siapp', '2024-02-16', '2024-02-17', 'public/1N2Xk3dPKXMxnsIwe1YC50r4G7uNqIubuAxdpEjo.pdf', 1, 'Sedang Ditindaklanjuti', '2024-02-15 06:49:49', '2024-02-15 06:49:49'),
(183, 'FP0095', 'Oke Siapp', '2024-02-16', '2024-02-17', NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-15 06:50:00', '2024-02-15 06:50:00'),
(184, 'FP0101', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-15 07:21:52', '2024-02-15 07:21:52'),
(185, 'FP0102', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-15 07:23:20', '2024-02-15 07:23:20'),
(186, 'FP0103', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-15 07:25:21', '2024-02-15 07:25:21'),
(187, 'FP0104', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-15 07:31:27', '2024-02-15 07:31:27'),
(188, 'FP0104', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 07:34:59', '2024-02-15 07:34:59'),
(189, 'FP0104', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-15 07:35:44', '2024-02-15 07:35:44'),
(190, 'FP0104', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-02-15 07:36:46', '2024-02-15 07:36:46'),
(191, 'FP0104', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-02-15 07:48:23', '2024-02-15 07:48:23'),
(192, 'FP0103', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 07:51:23', '2024-02-15 07:51:23'),
(194, 'FP0102', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 07:54:47', '2024-02-15 07:54:47'),
(195, 'FP0102', 'WOKEHH SIAPP', '2024-02-15', '2024-02-17', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 07:55:04', '2024-02-15 07:55:04'),
(196, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-17', 'assets/attachment/Mesin Rusak.jpg', 1, 'Sedang Ditindaklanjuti', '2024-02-15 08:00:46', '2024-02-15 08:00:46'),
(197, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-17', 'assets/attachment/gunung.jpg', 1, 'Sedang Ditindaklanjuti', '2024-02-15 08:04:06', '2024-02-15 08:04:06'),
(198, 'FP0101', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 08:07:20', '2024-02-15 08:07:20'),
(199, 'FP0101', 'OKE SIAPPKAN SEMUANYA', '2024-02-16', '2024-02-17', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-15 08:07:39', '2024-02-15 08:07:39'),
(200, 'FP0101', 'OKE SIAPPKAN SEMUANYA', '2024-02-16', '2024-02-17', 'assets/attachment/Mesin Rusak.jpg', 1, 'Sedang Ditindaklanjuti', '2024-02-15 08:09:07', '2024-02-15 08:09:07'),
(201, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-17', 'assets/attachment/Tutorial Pembuatan Akun di Certiport.pdf', 1, 'Sedang Ditindaklanjuti', '2024-02-15 08:12:32', '2024-02-15 08:12:32'),
(202, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-17', 'assets/attachment/PanduanTesting Apps for AstraTech.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-02-15 08:13:11', '2024-02-15 08:13:11'),
(203, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-17', 'assets/attachment/PK_42 review by RIF (1).docx', 1, 'Sedang Ditindaklanjuti', '2024-02-15 08:13:37', '2024-02-15 08:13:37'),
(204, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-17', 'assets/attachment/Microsoft Certification.docx', 1, 'Sedang Ditindaklanjuti', '2024-02-16 01:02:24', '2024-02-16 01:02:24'),
(205, 'FP0105', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-16 01:29:47', '2024-02-16 01:29:47'),
(206, 'FP0105', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-16 01:30:05', '2024-02-16 01:30:05'),
(207, 'FP0105', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-16 01:30:05', '2024-02-16 01:30:05'),
(208, 'FP0105', NULL, NULL, NULL, 'assets/attachment/gunung.jpg', 1, 'Sedang Ditindaklanjuti', '2024-02-16 01:32:48', '2024-02-16 01:32:48'),
(209, 'FP0106', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-16 01:37:24', '2024-02-16 01:37:24'),
(210, 'FP0106', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-16 01:37:44', '2024-02-16 01:37:44'),
(211, 'FP0106', NULL, NULL, NULL, 'assets/attachment/Microsoft Certification (1).docx', 1, 'Sedang Ditindaklanjuti', '2024-02-16 01:38:42', '2024-02-16 01:38:42'),
(212, 'FP0106', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-16 12:03:47', '2024-02-16 12:03:47'),
(213, 'FP0107', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-02-26 01:42:17', '2024-02-26 01:42:17'),
(214, 'FP0107', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-26 01:42:53', '2024-02-26 01:42:53'),
(215, 'FP0107', 'Ganti Sparepart', '2024-02-16', '2024-02-13', 'assets/attachment/PanduanTesting Apps for AstraTech.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-02-26 01:43:38', '2024-02-26 01:43:38'),
(216, 'FP0107', 'Ganti Sparepart', '2024-02-16', '2024-02-13', NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-26 01:44:43', '2024-02-26 01:44:43'),
(217, 'FP0107', NULL, NULL, NULL, NULL, 1, 'Ada data yang kurang', '2024-02-26 01:45:31', '2024-02-26 01:45:31'),
(218, 'FP0107', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-02-26 01:54:53', '2024-02-26 01:54:53'),
(219, 'FP0107', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-02-26 01:55:16', '2024-02-26 01:55:16'),
(220, 'FP0107', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-02-26 01:55:54', '2024-02-26 01:55:54'),
(221, 'FP0105', NULL, '2024-02-15', '2024-02-16', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-26 02:20:32', '2024-02-26 02:20:32'),
(222, 'FP0105', NULL, '2024-02-15', '2024-02-17', NULL, 1, 'Sedang Ditindaklanjuti', '2024-02-26 02:22:03', '2024-02-26 02:22:03'),
(223, 'FP0105', NULL, '2024-02-15', '2024-02-15', 'assets/attachment/gunung.jpg', 1, 'Sedang Ditindaklanjuti', '2024-02-26 04:18:05', '2024-02-26 04:18:05'),
(224, 'FP0108', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-03-01 02:40:35', '2024-03-01 02:40:35'),
(225, 'FP0108', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-01 02:48:23', '2024-03-01 02:48:23'),
(226, 'FP0108', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-03-01 02:50:10', '2024-03-01 02:50:10'),
(227, 'FP0108', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-03-01 06:14:52', '2024-03-01 06:14:52'),
(228, 'FP0109', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-03-04 09:11:45', '2024-03-04 09:11:45'),
(229, 'FP0109', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-04 09:11:52', '2024-03-04 09:11:52'),
(230, 'FP0109', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-03-04 09:11:58', '2024-03-04 09:11:58'),
(231, 'FP0109', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-03-04 09:12:04', '2024-03-04 09:12:04'),
(232, 'FP0109', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-03-04 09:12:14', '2024-03-04 09:12:14'),
(233, 'FP0110', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-03-04 10:34:26', '2024-03-04 10:34:26'),
(234, 'FP0110', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-05 00:54:39', '2024-03-05 00:54:39'),
(235, 'FP0110', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-03-05 00:54:51', '2024-03-05 00:54:51'),
(236, 'FP0110', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-03-05 00:55:00', '2024-03-05 00:55:00'),
(237, 'FP0110', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-03-05 00:55:15', '2024-03-05 00:55:15'),
(238, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', 'assets/attachment/Microsoft Certification.pdf', 1, 'Sedang Ditindaklanjuti', '2024-03-05 01:04:00', '2024-03-05 01:04:00'),
(239, 'FP0108', NULL, NULL, NULL, NULL, 1, 'Salah Isi', '2024-03-05 01:06:06', '2024-03-05 01:06:06'),
(240, 'FP0106', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-03-06 04:17:11', '2024-03-06 04:17:11'),
(241, 'FP0111', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-03-06 04:21:43', '2024-03-06 04:21:43'),
(242, 'FP0112', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-03-06 06:07:01', '2024-03-06 06:07:01'),
(243, 'FP0112', NULL, NULL, NULL, NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-06 06:10:48', '2024-03-06 06:10:48'),
(244, 'FP0112', 'Perbaiki Sparepart', '2024-03-09', '2024-03-05', 'assets/attachment/PanduanTesting Apps for AstraTech.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-03-06 06:11:13', '2024-03-06 06:11:13'),
(245, 'FP0112', 'Perbaiki Sparepart', '2024-03-09', '2024-03-05', NULL, 2, 'DISUBMIT MAINTENANCE', '2024-03-06 06:11:29', '2024-03-06 06:11:29'),
(246, 'FP0112', NULL, NULL, NULL, NULL, 2, 'Dikonfirmasi Dept.Maintenance', '2024-03-06 06:13:00', '2024-03-06 06:13:00'),
(247, 'FP0108', NULL, NULL, NULL, NULL, 2, 'DISUBMIT MAINTENANCE', '2024-03-06 06:16:37', '2024-03-06 06:16:37'),
(248, 'FP0112', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-03-06 06:18:10', '2024-03-06 06:18:10'),
(249, 'FP0108', NULL, NULL, NULL, NULL, 3, 'Diclosed Production', '2024-03-06 06:18:22', '2024-03-06 06:18:22'),
(250, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-12 02:11:43', '2024-03-12 02:11:43'),
(251, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-15', NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-12 02:18:34', '2024-03-12 02:18:34'),
(252, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', 'assets/attachment/adasi-icon.png', 1, 'Sedang Ditindaklanjuti', '2024-03-12 02:43:55', '2024-03-12 02:43:55'),
(253, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-12 03:06:10', '2024-03-12 03:06:10'),
(254, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-15', 'assets/attachment/card.jpg', 1, 'Sedang Ditindaklanjuti', '2024-03-12 03:06:55', '2024-03-12 03:06:55'),
(255, 'FP0103', 'SIAPPP', '2024-02-16', '2024-02-15', NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-12 03:07:29', '2024-03-12 03:07:29'),
(256, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', 'assets/attachment/apple-touch-icon.png', 1, 'Sedang Ditindaklanjuti', '2024-03-12 03:11:21', '2024-03-12 03:11:21'),
(257, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', NULL, 1, 'Sedang Ditindaklanjuti', '2024-03-12 03:11:39', '2024-03-12 03:11:39'),
(258, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', 'assets/attachment/product-2.jpg', 1, 'Sedang Ditindaklanjuti', '2024-03-12 03:15:15', '2024-03-12 03:15:15'),
(259, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', '', 1, 'Sedang Ditindaklanjuti', '2024-03-12 03:15:21', '2024-03-12 03:15:21'),
(260, 'FP0113', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-03-13 06:49:27', '2024-03-13 06:49:27'),
(261, 'FP0113', NULL, NULL, NULL, '', 1, 'Sedang Ditindaklanjuti', '2024-03-13 06:49:55', '2024-03-13 06:49:55'),
(262, 'FP0113', 'Pengecekan Mesin', '2024-03-14', '2024-03-14', 'assets/attachment/Jadwal Preventive Cutting-Tools.xlsx', 1, 'Sedang Ditindaklanjuti', '2024-03-13 06:50:48', '2024-03-13 06:50:48'),
(263, 'FP0113', 'Pengecekan Mesin', '2024-03-14', '2024-03-14', 'assets/attachment/Jadwal Preventive Cutting-Tools.pdf', 1, 'Sedang Ditindaklanjuti', '2024-03-13 06:51:42', '2024-03-13 06:51:42'),
(264, 'FP0113', 'Pengecekan Mesin', '2024-03-14', '2024-03-14', '', 2, 'Disubmit Maintenance', '2024-03-13 06:52:30', '2024-03-13 06:52:30'),
(265, 'FP0113', NULL, NULL, NULL, '', 1, 'Pengisiannya Salah', '2024-03-13 06:53:11', '2024-03-13 06:53:11'),
(266, 'FP0113', NULL, NULL, NULL, '', 2, 'Disubmit Maintenance', '2024-03-13 06:53:33', '2024-03-13 06:53:33'),
(267, 'FP0113', NULL, NULL, NULL, '', 2, 'Dikonfirmasi Dept.Maintenance', '2024-03-13 06:53:42', '2024-03-13 06:53:42'),
(268, 'FP0113', NULL, NULL, NULL, '', 3, 'Diclosed Production', '2024-03-13 06:53:56', '2024-03-13 06:53:56'),
(269, 'FP0114', NULL, NULL, NULL, NULL, 0, 'Form FPP Dibuat', '2024-03-18 01:09:08', '2024-03-18 01:09:08'),
(270, 'FP0114', NULL, NULL, NULL, '', 1, 'Sedang Ditindaklanjuti', '2024-03-18 01:09:24', '2024-03-18 01:09:24'),
(271, 'FP0114', NULL, NULL, NULL, '', 2, 'Disubmit Maintenance', '2024-03-18 01:09:38', '2024-03-18 01:09:38'),
(272, 'FP0114', NULL, NULL, NULL, '', 2, 'Dikonfirmasi Dept.Maintenance', '2024-03-18 01:09:53', '2024-03-18 01:09:53'),
(273, 'FP0114', NULL, NULL, NULL, '', 3, 'Diclosed Production', '2024-03-18 01:10:07', '2024-03-18 01:10:07'),
(274, 'FP0105', 'Salah Isi', '2024-02-15', '2024-02-15', 'assets/attachment/Muka Aku.jpg', 1, 'Sedang Ditindaklanjuti', '2024-03-18 01:46:44', '2024-03-18 01:46:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_materials`
--

CREATE TABLE `type_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `type_materials`
--

INSERT INTO `type_materials` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'GO4OF', NULL, NULL),
(2, 'GOA', NULL, NULL),
(3, 'GO5', NULL, NULL),
(4, 'DC11', NULL, NULL),
(5, 'DC53', NULL, NULL),
(6, 'DCMX', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `password`, `pass`, `email`, `telp`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Rian Suryana', 'rian123', '$2y$10$E6sNrRzHm6sVYRUhOCj/VumESko2kA.cVQd.PPy68ktzyKkqqtWee', '123', 'riansuryana@gmail.com', '81312131', 0, '2024-03-06 01:39:05', '2024-03-06 01:39:05'),
(2, 3, 'Mula Imanuael', 'mula', '$2y$10$IhTDRM14zZwA9NhAgBSeKe6jpg6Cli/5ys0fOBP2Zuf3D9R847VgG', '123', 'mulaimanuael@gmail.com', '087765512123', 0, '2024-03-06 01:43:22', '2024-03-06 01:43:22'),
(3, 1, 'Medi Krisnanto', 'admin', '$2y$10$rv.bUocxkvOG1e5AIT7nV.UhPh8AJgM/qDcxdvo89fPcpvjorFQLe', 'admin', 'medikrisnanto@gmail.com', '08214100771', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_preventives`
--
ALTER TABLE `detail_preventives`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `form_f_p_p_s`
--
ALTER TABLE `form_f_p_p_s`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `handlings`
--
ALTER TABLE `handlings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mesins`
--
ALTER TABLE `mesins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schedule_visits`
--
ALTER TABLE `schedule_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tindak_lanjuts`
--
ALTER TABLE `tindak_lanjuts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `type_materials`
--
ALTER TABLE `type_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_preventives`
--
ALTER TABLE `detail_preventives`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `form_f_p_p_s`
--
ALTER TABLE `form_f_p_p_s`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT untuk tabel `handlings`
--
ALTER TABLE `handlings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mesins`
--
ALTER TABLE `mesins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `schedule_visits`
--
ALTER TABLE `schedule_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tindak_lanjuts`
--
ALTER TABLE `tindak_lanjuts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT untuk tabel `type_materials`
--
ALTER TABLE `type_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
