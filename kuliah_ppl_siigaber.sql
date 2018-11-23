-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 Nov 2018 pada 03.42
-- Versi Server: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuliah_ppl_siigaber`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_distribusi`
--

CREATE TABLE `detail_distribusi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_gudang` int(10) UNSIGNED NOT NULL,
  `id_distribusi` int(10) UNSIGNED NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_distribusi`
--

INSERT INTO `detail_distribusi` (`id`, `id_gudang`, `id_distribusi`, `jumlah`) VALUES
(3, 1, 5, 700),
(11, 2, 7, 300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_gudang`
--

CREATE TABLE `detail_gudang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_gudang` int(10) UNSIGNED NOT NULL,
  `id_jenis_beras` int(10) UNSIGNED NOT NULL,
  `jml_gabah` double NOT NULL DEFAULT '0',
  `jml_beras` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_gudang`
--

INSERT INTO `detail_gudang` (`id`, `id_gudang`, `id_jenis_beras`, `jml_gabah`, `jml_beras`) VALUES
(1, 2, 1, 1000, 400),
(2, 1, 1, 2000, 5599),
(3, 1, 2, -100, 3901),
(4, 2, 2, 0, 5600),
(5, 1, 3, -100, 2000),
(6, 2, 3, -200, 9000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penggilingan`
--

CREATE TABLE `detail_penggilingan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_gudang` int(10) UNSIGNED NOT NULL,
  `id_penggilingan` int(10) UNSIGNED NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_penggilingan`
--

INSERT INTO `detail_penggilingan` (`id`, `id_gudang`, `id_penggilingan`, `jumlah`) VALUES
(2, 2, 1, 1000),
(3, 1, 1, 99),
(4, 1, 2, 100),
(5, 1, 3, 1000),
(6, 1, 4, 100),
(7, 2, 4, 200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribusi`
--

CREATE TABLE `distribusi` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `biaya_transport` double NOT NULL DEFAULT '0',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu persetujuan',
  `id_mitra_kerja` int(10) UNSIGNED DEFAULT NULL,
  `id_jenis_beras` int(10) UNSIGNED NOT NULL,
  `tipe` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_desa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kecamatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kepala_desa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `distribusi`
--

INSERT INTO `distribusi` (`id`, `tanggal_mulai`, `tanggal_selesai`, `biaya_transport`, `status`, `id_mitra_kerja`, `id_jenis_beras`, `tipe`, `nama_desa`, `nama_kecamatan`, `nama_kepala_desa`, `created_at`, `updated_at`) VALUES
(1, '2018-11-17', NULL, 0, 'Menunggu persetujuan', 1, 2, 'Umum', NULL, NULL, NULL, '2018-11-17 00:16:03', '2018-11-17 00:16:03'),
(2, '2018-11-17', NULL, 0, 'Menunggu persetujuan', 1, 1, 'Umum', NULL, NULL, NULL, '2018-11-17 00:18:48', '2018-11-17 00:18:48'),
(3, '2018-11-17', NULL, 0, 'Menunggu persetujuan', 1, 1, 'Umum', NULL, NULL, NULL, '2018-11-17 00:19:19', '2018-11-17 00:19:19'),
(4, '2018-11-17', NULL, 0, 'Dalam pengerjaan', 1, 1, 'Umum', NULL, NULL, NULL, '2018-11-17 00:19:47', '2018-11-17 02:29:41'),
(5, '2018-11-17', '2018-11-18', 90, 'Selesai', NULL, 1, 'Raskin', 'Sumbersari', 'Sumbersari', 'KH Wahid Hasyim', '2018-11-17 00:20:04', '2018-11-17 01:32:31'),
(7, '2018-11-17', NULL, 12, 'Selesai', 1, 2, 'Umum', NULL, NULL, NULL, '2018-11-17 01:01:21', '2018-11-17 01:28:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id`, `nama`, `lokasi`, `kapasitas`) VALUES
(1, 'Gudang A', '-', 10000),
(2, 'Gudang B', '-', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_beras`
--

CREATE TABLE `jenis_beras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_beras`
--

INSERT INTO `jenis_beras` (`id`, `nama`) VALUES
(1, 'Pandan Wangi'),
(2, 'Raja Lele'),
(3, 'Pisang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(7, '2018_10_09_113605_create_jenis_beras', 2),
(16, '2018_10_09_121507_create_gudang', 3),
(17, '2018_10_20_133359_create_mitra_kerja', 3),
(22, '2018_10_20_133806_create_pengadaan', 4),
(24, '2018_10_20_134502_create_pengadaan_ke_gudang', 5),
(29, '2018_10_22_112701_create_penggilingan', 6),
(33, '2018_11_14_084701_create_detail_penggilingan', 7),
(34, '2018_11_14_085930_create_detail_gudang', 7),
(35, '2018_11_15_143907_create_distribusi', 8),
(36, '2018_11_15_144409_create_detail_distribusi', 8),
(37, '2018_11_17_114654_add_id_jenis_beras_to_pengadaan', 9),
(38, '2018_11_20_162431_create_sppk_kategori', 10),
(40, '2018_11_20_162647_create_sppk_kriteria', 11),
(41, '2018_11_20_163715_create_sppk', 12),
(42, '2018_11_20_165258_create_sppk_daerah_tujuan', 13),
(47, '2018_11_20_212840_create_sppk_prioritas_kategori', 14),
(48, '2018_11_20_214826_create_sppk_sub_kriteria', 14),
(57, '2018_11_20_215430_create_sppk_prioritas_kriteria', 15),
(58, '2018_11_21_074525_create_sppk_prioritas_sub_kriteria', 15),
(59, '2018_11_21_102227_create_sppk_detail_daerah', 16),
(60, '2018_11_23_083237_add_id_teratas_pada_sppk', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra_kerja`
--

CREATE TABLE `mitra_kerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `alamat` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mitra_kerja`
--

INSERT INTO `mitra_kerja` (`id`, `nama`, `bidang`, `kontak`, `deskripsi`, `alamat`) VALUES
(1, 'Mitra 1', 'Distribusi', '999', '-', '-'),
(2, 'Mitra 2', 'Pengadaan', '888', '-', '-'),
(3, 'Mitra 3', 'Pemasaran', '666', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `biaya` double NOT NULL,
  `biaya_transport` double NOT NULL DEFAULT '0',
  `jenis_pengadaan` enum('Beras','Gabah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mitra_kerja` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_jenis_beras` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengadaan`
--

INSERT INTO `pengadaan` (`id`, `tanggal`, `tanggal_selesai`, `biaya`, `biaya_transport`, `jenis_pengadaan`, `id_mitra_kerja`, `status`, `created_at`, `updated_at`, `id_jenis_beras`) VALUES
(1, '2018-11-17', '2018-11-17', 23000, 2000, 'Beras', 2, 'Selesai', '2018-11-17 04:55:21', '2018-11-17 05:54:20', 2),
(2, '2018-11-17', NULL, 10000, 0, 'Beras', 3, 'Menunggu persetujuan', '2018-11-17 06:01:20', '2018-11-19 23:42:40', 3),
(3, '2018-07-05', NULL, 90000, 0, 'Beras', 1, 'Menunggu persetujuan', '2018-11-19 23:03:24', '2018-11-19 23:03:24', 1),
(4, '2018-11-20', NULL, 1000, 0, 'Beras', 3, 'Menunggu persetujuan', '2018-11-19 23:46:24', '2018-11-19 23:46:24', 3),
(5, '2018-11-20', '2018-11-20', 1000, 1000, 'Beras', 2, 'Selesai', '2018-11-19 23:50:04', '2018-11-20 00:05:20', 2),
(6, '2018-11-20', '2018-11-20', 1000, 0, 'Gabah', 2, 'Selesai', '2018-11-19 23:51:42', '2018-11-19 23:56:29', 3),
(7, '2018-11-20', '2018-11-20', 9999, 9999, 'Beras', 1, 'Selesai', '2018-11-20 00:13:23', '2018-11-20 00:13:41', 1),
(8, '2018-11-20', '2018-11-20', 200, 12345, 'Beras', 1, 'Selesai', '2018-11-20 00:14:02', '2018-11-20 00:14:20', 1),
(9, '2018-11-20', '2018-11-20', 12222, 9000, 'Gabah', 1, 'Selesai', '2018-11-20 00:14:44', '2018-11-20 00:15:01', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan_ke_gudang`
--

CREATE TABLE `pengadaan_ke_gudang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_gudang` int(10) UNSIGNED NOT NULL,
  `id_pengadaan` int(10) UNSIGNED NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengadaan_ke_gudang`
--

INSERT INTO `pengadaan_ke_gudang` (`id`, `id_gudang`, `id_pengadaan`, `jumlah`) VALUES
(1, 1, 1, 120),
(2, 2, 1, 200),
(5, 1, 3, 12),
(6, 2, 3, 23),
(7, 1, 2, 222),
(8, 2, 2, 222),
(9, 1, 4, 100),
(10, 1, 5, 1),
(13, 1, 6, 90),
(14, 1, 7, 3999),
(15, 1, 8, 200),
(16, 1, 9, 3000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggilingan`
--

CREATE TABLE `penggilingan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `biaya` double NOT NULL,
  `biaya_transport` double NOT NULL DEFAULT '0',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu persetujuan',
  `id_mitra_kerja` int(10) UNSIGNED NOT NULL,
  `id_jenis_beras` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penggilingan`
--

INSERT INTO `penggilingan` (`id`, `tanggal_mulai`, `tanggal_selesai`, `biaya`, `biaya_transport`, `status`, `id_mitra_kerja`, `id_jenis_beras`, `created_at`, `updated_at`) VALUES
(1, '2018-11-15', NULL, 20000, 1000, 'Selesai', 1, 1, '2018-11-15 06:50:27', '2018-11-15 07:35:34'),
(2, '2018-11-20', NULL, 9999, 0, 'Menunggu persetujuan', 2, 2, '2018-11-20 00:19:27', '2018-11-20 00:19:27'),
(3, '2018-11-20', NULL, 12345, 9999, 'Selesai', 3, 1, '2018-11-20 00:26:03', '2018-11-20 01:09:06'),
(4, '2018-11-20', NULL, 9000, 9000, 'Selesai', 3, 3, '2018-11-20 00:56:31', '2018-11-20 01:08:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk`
--

CREATE TABLE `sppk` (
  `id` int(10) UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `teratas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_teratas` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk_daerah_tujuan`
--

CREATE TABLE `sppk_daerah_tujuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_desa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kecamatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kepala_desa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kebutuhan` double NOT NULL,
  `jarak` double NOT NULL,
  `biaya` double NOT NULL,
  `tanggal_distribusi` date NOT NULL,
  `rute` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sppk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk_detail_daerah`
--

CREATE TABLE `sppk_detail_daerah` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_prioritas_sub_kriteria` int(10) UNSIGNED NOT NULL,
  `id_daerah_tujuan` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk_kategori`
--

CREATE TABLE `sppk_kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioritas` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sppk_kategori`
--

INSERT INTO `sppk_kategori` (`id`, `nama`, `prioritas`) VALUES
(1, 'Kriteria Utama', 1),
(2, 'Kriteria Penunjang', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk_kriteria`
--

CREATE TABLE `sppk_kriteria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sppk_kriteria`
--

INSERT INTO `sppk_kriteria` (`id`, `nama`, `id_kategori`) VALUES
(1, 'Jumlah Permintaan', 1),
(2, 'Jarak', 1),
(3, 'Tenggang Waktu', 1),
(4, 'Rute', 2),
(5, 'Biaya Distribusi', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk_prioritas_kategori`
--

CREATE TABLE `sppk_prioritas_kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioritas` tinyint(4) NOT NULL,
  `bobot` double NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `id_sppk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk_prioritas_kriteria`
--

CREATE TABLE `sppk_prioritas_kriteria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioritas` tinyint(4) NOT NULL,
  `bobot` double NOT NULL,
  `id_kriteria` int(10) UNSIGNED NOT NULL,
  `id_prioritas_kategori` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk_prioritas_sub_kriteria`
--

CREATE TABLE `sppk_prioritas_sub_kriteria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioritas` tinyint(4) NOT NULL,
  `bobot` double NOT NULL,
  `id_sub_kriteria` int(10) UNSIGNED NOT NULL,
  `id_prioritas_kriteria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppk_sub_kriteria`
--

CREATE TABLE `sppk_sub_kriteria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kriteria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sppk_sub_kriteria`
--

INSERT INTO `sppk_sub_kriteria` (`id`, `nama`, `id_kriteria`) VALUES
(1, '> 500 ton', 1),
(2, '500 - 100 ton', 1),
(3, '< 100 ton', 1),
(4, '> 15 km', 2),
(5, '10 - 15 km', 2),
(6, '< 10 km', 2),
(7, '> 2 minggu', 3),
(8, '1 - 2 minggu', 3),
(9, '< 1 minggu', 3),
(10, 'Mudah', 4),
(11, 'Sedang', 4),
(12, 'Sulit', 4),
(13, '> 2 juta', 5),
(14, '1 - 2 juta', 5),
(15, '< 1 juta', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `remember_token`) VALUES
(1, 'Hairul Anam', 'admin', '$2y$10$ZUoeEH08G7mmgGbOjtFtyemZ73.2l9T9TNVgZLEFVj3CTDI/udeH.', 'Operator', 'SXrY43VhfCPHmoiHAmKc7TH92z01m9bu6Z8HV9v88gzgW5ZxhB6Q5VBpEtVY'),
(4, 'Irsandy', 'gudang', '$2y$10$cuWDvIO3uJa11zkWr7Wageg0htY8/OYmFUg8QDr83N2DqG1VTWQWG', 'Gudang', 'Pfyadwj9Vyv5apgPcQKox2bVmoomp5p2BFCd5jDumpbNWynCz4W4VslXJJNS'),
(5, 'Hamada Ananta', 'manajer', '$2y$10$Nj88SSWJsMIuW0Q/1IGC7..G67PGbStMb0PYQmq.scjpyaIJKqh/e', 'Manajer', 'ffOGai6GbPQjojAcqlVChj9kRnfK2eSvrD5iLYdxuGhckOCANu96Ldab5QQm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_distribusi`
--
ALTER TABLE `detail_distribusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_distribusi_id_gudang_foreign` (`id_gudang`),
  ADD KEY `detail_distribusi_id_distribusi_foreign` (`id_distribusi`);

--
-- Indexes for table `detail_gudang`
--
ALTER TABLE `detail_gudang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_gudang_id_gudang_foreign` (`id_gudang`),
  ADD KEY `detail_gudang_id_jenis_beras_foreign` (`id_jenis_beras`);

--
-- Indexes for table `detail_penggilingan`
--
ALTER TABLE `detail_penggilingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_penggilingan_id_gudang_foreign` (`id_gudang`),
  ADD KEY `detail_penggilingan_id_penggilingan_foreign` (`id_penggilingan`);

--
-- Indexes for table `distribusi`
--
ALTER TABLE `distribusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distribusi_id_mitra_kerja_foreign` (`id_mitra_kerja`),
  ADD KEY `distribusi_id_jenis_beras_foreign` (`id_jenis_beras`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_beras`
--
ALTER TABLE `jenis_beras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra_kerja`
--
ALTER TABLE `mitra_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengadaan_id_mitra_kerja_foreign` (`id_mitra_kerja`),
  ADD KEY `pengadaan_id_jenis_beras_foreign` (`id_jenis_beras`);

--
-- Indexes for table `pengadaan_ke_gudang`
--
ALTER TABLE `pengadaan_ke_gudang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengadaan_ke_gudang_id_gudang_foreign` (`id_gudang`),
  ADD KEY `pengadaan_ke_gudang_id_pengadaan_foreign` (`id_pengadaan`);

--
-- Indexes for table `penggilingan`
--
ALTER TABLE `penggilingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penggilingan_id_mitra_kerja_foreign` (`id_mitra_kerja`),
  ADD KEY `penggilingan_id_jenis_beras_foreign` (`id_jenis_beras`);

--
-- Indexes for table `sppk`
--
ALTER TABLE `sppk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppk_id_teratas_foreign` (`id_teratas`);

--
-- Indexes for table `sppk_daerah_tujuan`
--
ALTER TABLE `sppk_daerah_tujuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppk_daerah_tujuan_id_sppk_foreign` (`id_sppk`);

--
-- Indexes for table `sppk_detail_daerah`
--
ALTER TABLE `sppk_detail_daerah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppk_detail_daerah_id_prioritas_sub_kriteria_foreign` (`id_prioritas_sub_kriteria`),
  ADD KEY `sppk_detail_daerah_id_daerah_tujuan_foreign` (`id_daerah_tujuan`);

--
-- Indexes for table `sppk_kategori`
--
ALTER TABLE `sppk_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sppk_kriteria`
--
ALTER TABLE `sppk_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppk_kriteria_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `sppk_prioritas_kategori`
--
ALTER TABLE `sppk_prioritas_kategori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppk_prioritas_kategori_id_kategori_foreign` (`id_kategori`),
  ADD KEY `sppk_prioritas_kategori_id_sppk_foreign` (`id_sppk`);

--
-- Indexes for table `sppk_prioritas_kriteria`
--
ALTER TABLE `sppk_prioritas_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppk_prioritas_kriteria_id_kriteria_foreign` (`id_kriteria`),
  ADD KEY `sppk_prioritas_kriteria_id_prioritas_kategori_foreign` (`id_prioritas_kategori`);

--
-- Indexes for table `sppk_prioritas_sub_kriteria`
--
ALTER TABLE `sppk_prioritas_sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppk_prioritas_sub_kriteria_id_sub_kriteria_foreign` (`id_sub_kriteria`),
  ADD KEY `sppk_prioritas_sub_kriteria_id_prioritas_kriteria_foreign` (`id_prioritas_kriteria`);

--
-- Indexes for table `sppk_sub_kriteria`
--
ALTER TABLE `sppk_sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppk_sub_kriteria_id_kriteria_foreign` (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_distribusi`
--
ALTER TABLE `detail_distribusi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_gudang`
--
ALTER TABLE `detail_gudang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_penggilingan`
--
ALTER TABLE `detail_penggilingan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `distribusi`
--
ALTER TABLE `distribusi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_beras`
--
ALTER TABLE `jenis_beras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `mitra_kerja`
--
ALTER TABLE `mitra_kerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengadaan_ke_gudang`
--
ALTER TABLE `pengadaan_ke_gudang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `penggilingan`
--
ALTER TABLE `penggilingan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sppk`
--
ALTER TABLE `sppk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sppk_daerah_tujuan`
--
ALTER TABLE `sppk_daerah_tujuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sppk_detail_daerah`
--
ALTER TABLE `sppk_detail_daerah`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sppk_kategori`
--
ALTER TABLE `sppk_kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sppk_kriteria`
--
ALTER TABLE `sppk_kriteria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sppk_prioritas_kategori`
--
ALTER TABLE `sppk_prioritas_kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sppk_prioritas_kriteria`
--
ALTER TABLE `sppk_prioritas_kriteria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sppk_prioritas_sub_kriteria`
--
ALTER TABLE `sppk_prioritas_sub_kriteria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sppk_sub_kriteria`
--
ALTER TABLE `sppk_sub_kriteria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_distribusi`
--
ALTER TABLE `detail_distribusi`
  ADD CONSTRAINT `detail_distribusi_id_distribusi_foreign` FOREIGN KEY (`id_distribusi`) REFERENCES `distribusi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_distribusi_id_gudang_foreign` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_gudang`
--
ALTER TABLE `detail_gudang`
  ADD CONSTRAINT `detail_gudang_id_gudang_foreign` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_gudang_id_jenis_beras_foreign` FOREIGN KEY (`id_jenis_beras`) REFERENCES `jenis_beras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penggilingan`
--
ALTER TABLE `detail_penggilingan`
  ADD CONSTRAINT `detail_penggilingan_id_gudang_foreign` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penggilingan_id_penggilingan_foreign` FOREIGN KEY (`id_penggilingan`) REFERENCES `penggilingan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  ADD CONSTRAINT `distribusi_id_jenis_beras_foreign` FOREIGN KEY (`id_jenis_beras`) REFERENCES `jenis_beras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distribusi_id_mitra_kerja_foreign` FOREIGN KEY (`id_mitra_kerja`) REFERENCES `mitra_kerja` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD CONSTRAINT `pengadaan_id_jenis_beras_foreign` FOREIGN KEY (`id_jenis_beras`) REFERENCES `jenis_beras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengadaan_id_mitra_kerja_foreign` FOREIGN KEY (`id_mitra_kerja`) REFERENCES `mitra_kerja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengadaan_ke_gudang`
--
ALTER TABLE `pengadaan_ke_gudang`
  ADD CONSTRAINT `pengadaan_ke_gudang_id_gudang_foreign` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengadaan_ke_gudang_id_pengadaan_foreign` FOREIGN KEY (`id_pengadaan`) REFERENCES `pengadaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggilingan`
--
ALTER TABLE `penggilingan`
  ADD CONSTRAINT `penggilingan_id_jenis_beras_foreign` FOREIGN KEY (`id_jenis_beras`) REFERENCES `jenis_beras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penggilingan_id_mitra_kerja_foreign` FOREIGN KEY (`id_mitra_kerja`) REFERENCES `mitra_kerja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppk`
--
ALTER TABLE `sppk`
  ADD CONSTRAINT `sppk_id_teratas_foreign` FOREIGN KEY (`id_teratas`) REFERENCES `sppk_daerah_tujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppk_daerah_tujuan`
--
ALTER TABLE `sppk_daerah_tujuan`
  ADD CONSTRAINT `sppk_daerah_tujuan_id_sppk_foreign` FOREIGN KEY (`id_sppk`) REFERENCES `sppk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppk_detail_daerah`
--
ALTER TABLE `sppk_detail_daerah`
  ADD CONSTRAINT `sppk_detail_daerah_id_daerah_tujuan_foreign` FOREIGN KEY (`id_daerah_tujuan`) REFERENCES `sppk_daerah_tujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sppk_detail_daerah_id_prioritas_sub_kriteria_foreign` FOREIGN KEY (`id_prioritas_sub_kriteria`) REFERENCES `sppk_prioritas_sub_kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppk_kriteria`
--
ALTER TABLE `sppk_kriteria`
  ADD CONSTRAINT `sppk_kriteria_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `sppk_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppk_prioritas_kategori`
--
ALTER TABLE `sppk_prioritas_kategori`
  ADD CONSTRAINT `sppk_prioritas_kategori_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `sppk_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sppk_prioritas_kategori_id_sppk_foreign` FOREIGN KEY (`id_sppk`) REFERENCES `sppk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppk_prioritas_kriteria`
--
ALTER TABLE `sppk_prioritas_kriteria`
  ADD CONSTRAINT `sppk_prioritas_kriteria_id_kriteria_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `sppk_kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sppk_prioritas_kriteria_id_prioritas_kategori_foreign` FOREIGN KEY (`id_prioritas_kategori`) REFERENCES `sppk_prioritas_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppk_prioritas_sub_kriteria`
--
ALTER TABLE `sppk_prioritas_sub_kriteria`
  ADD CONSTRAINT `sppk_prioritas_sub_kriteria_id_prioritas_kriteria_foreign` FOREIGN KEY (`id_prioritas_kriteria`) REFERENCES `sppk_prioritas_kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sppk_prioritas_sub_kriteria_id_sub_kriteria_foreign` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sppk_sub_kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppk_sub_kriteria`
--
ALTER TABLE `sppk_sub_kriteria`
  ADD CONSTRAINT `sppk_sub_kriteria_id_kriteria_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `sppk_kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
