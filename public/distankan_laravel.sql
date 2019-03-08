-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2019 at 08:13 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distankan_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_proyeks`
--

CREATE TABLE `daftar_proyeks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nomor_proyek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_proyek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai_proyek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selesai_proyek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggaran` int(11) NOT NULL,
  `sisa_anggaran` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_proyeks`
--

INSERT INTO `daftar_proyeks` (`id`, `user_id`, `nomor_proyek`, `nama_proyek`, `mulai_proyek`, `selesai_proyek`, `anggaran`, `sisa_anggaran`, `status`, `ket`, `created_at`, `updated_at`) VALUES
(1, 1, 'NP001', 'Membangun Gedung Aula', '2019-02-01', '2019-08-31', 2000000000, 2000000000, 'Sedang Berjalan', '', NULL, NULL),
(3, 1, 'NP003', 'Pembangunan Musholah Kantor', '02/06/2019', '03/31/2019', 50000000, 50000000, 'Ditolak', '', '2019-02-05 22:54:46', '2019-02-05 22:54:46'),
(7, 1, 'NP005', 'Buat Acara Lagi', '02/19/2019', '02/28/2019', 50000000, 50000000, 'Selesai', '', '2019-02-18 23:39:49', '2019-02-18 23:39:49'),
(8, 1, 'NP07', 'Buat Acara Lagi nih', '02/21/2019', '02/21/2019', 50000000, 50000000, 'Menunggu Persetujuan', '', '2019-02-20 23:43:03', '2019-02-21 08:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_proyeks`
--

CREATE TABLE `kegiatan_proyeks` (
  `id` int(10) UNSIGNED NOT NULL,
  `proyek_id` int(10) UNSIGNED NOT NULL,
  `kegiatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `anggaran` int(11) NOT NULL,
  `gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan_proyeks`
--

INSERT INTO `kegiatan_proyeks` (`id`, `proyek_id`, `kegiatan`, `unit`, `satuan`, `harga`, `anggaran`, `gambar`, `created_at`, `updated_at`) VALUES
(11, 1, 'kegiatan', 10, 'Pcs', 1000, 10000, 'kucing.jpg', '2019-02-05 22:22:29', '2019-02-05 22:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktifitas`
--

CREATE TABLE `log_aktifitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `aksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_aktifitas`
--

INSERT INTO `log_aktifitas` (`id`, `user_id`, `aksi`, `ket`, `alasan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tambah Proyek', 'Proyek Membuat Taman Kantor', '', '2019-01-29 17:00:00', NULL);

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
(2, '2019_01_25_013832_create_daftar_proyeks_table', 1),
(3, '2019_01_25_013925_create_kegiatan_proyeks_table', 1),
(4, '2019_01_25_014033_create_log_aktifitas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nip` int(11) NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nip`, `nama`, `jabatan`, `password`, `foto`, `status`, `ket`, `waktu_login`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 123456789, 'fandi', 'Pegawai', 'abc123', 'foto.jpg', 'aktif', '', '2019-02-19 03:47:29', NULL, NULL, NULL),
(2, 123123123, 'monalisa', 'Kepala Sub Bagian Program', 'abc123', 'mona.jpg', 'aktif', '', '2019-01-25 15:38:38', NULL, NULL, NULL),
(3, 1234567, 'Ahmad Afandi', 'Kepala Dinas', 'abc123', 'foto.jpg', 'aktif', '', '2019-02-21 20:12:16', NULL, NULL, '2019-02-21 20:12:16'),
(4, 12345, 'Ricky Ramadhan', 'Pegawai', 'abc123', 'foto.jpg', 'tidak aktif', '', '2019-02-22 04:23:02', NULL, NULL, '2019-02-21 21:23:02'),
(6, 987654321, 'Ratih Lestari', 'Pegawai', 'abc123', '-', 'aktif', '-', '2019-02-22 07:04:25', NULL, '2019-02-21 22:19:01', '2019-02-22 00:04:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_proyeks`
--
ALTER TABLE `daftar_proyeks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `daftar_proyeks_nomor_proyek_unique` (`nomor_proyek`),
  ADD KEY `daftar_proyeks_user_id_foreign` (`user_id`);

--
-- Indexes for table `kegiatan_proyeks`
--
ALTER TABLE `kegiatan_proyeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_proyeks_proyek_id_foreign` (`proyek_id`);

--
-- Indexes for table `log_aktifitas`
--
ALTER TABLE `log_aktifitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_aktifitas_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_proyeks`
--
ALTER TABLE `daftar_proyeks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kegiatan_proyeks`
--
ALTER TABLE `kegiatan_proyeks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `log_aktifitas`
--
ALTER TABLE `log_aktifitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_proyeks`
--
ALTER TABLE `daftar_proyeks`
  ADD CONSTRAINT `daftar_proyeks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kegiatan_proyeks`
--
ALTER TABLE `kegiatan_proyeks`
  ADD CONSTRAINT `kegiatan_proyeks_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `daftar_proyeks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_aktifitas`
--
ALTER TABLE `log_aktifitas`
  ADD CONSTRAINT `log_aktifitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
