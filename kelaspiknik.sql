-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Jul 2024 pada 05.59
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
-- Database: `kelaspiknik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_registrasi`
--

CREATE TABLE `data_registrasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_reg` varchar(20) NOT NULL,
  `kode_trip` varchar(255) NOT NULL,
  `bus` varchar(255) DEFAULT NULL,
  `sekolah` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `ttl` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `penyakit` text NOT NULL,
  `no_tel` varchar(255) NOT NULL,
  `no_wa` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `nm_ortu` varchar(255) NOT NULL,
  `no_tel_ortu1` varchar(255) NOT NULL,
  `no_tel_ortu2` varchar(255) NOT NULL,
  `surat` text NOT NULL,
  `absen1` date DEFAULT NULL,
  `absen2` date DEFAULT NULL,
  `absen3` date DEFAULT NULL,
  `absen4` date DEFAULT NULL,
  `absen5` date DEFAULT NULL,
  `absen6` date DEFAULT NULL,
  `absen7` date DEFAULT NULL,
  `absen8` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_registrasi`
--

INSERT INTO `data_registrasi` (`id`, `id_reg`, `kode_trip`, `bus`, `sekolah`, `nama_lengkap`, `kelas`, `ttl`, `email`, `alamat`, `penyakit`, `no_tel`, `no_wa`, `foto`, `nm_ortu`, `no_tel_ortu1`, `no_tel_ortu2`, `surat`, `absen1`, `absen2`, `absen3`, `absen4`, `absen5`, `absen6`, `absen7`, `absen8`, `created_at`, `updated_at`) VALUES
(1, 'REG072400000', '07NQA', 'Bus 1', 'SDN 02 Rawa Buntu', 'Jono', '5', 'Tangerang Selatan, 2018-06-05', 'jono@mail.com', 'Tangsel', 'Tidak Ada', '08123456789', '01648452515', '37bc2f75bf1bcfe8450a1a41c200364c.jpeg', 'Joni', '081234567890', '08123456789', '7a53928fa4dd31e82c6ef826f341daec.png', '2024-07-24', '2024-07-24', '2024-07-24', NULL, NULL, NULL, NULL, NULL, '2024-07-24 00:09:52', '2024-07-24 03:41:23');

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
(19, '2014_10_12_000000_create_users_table', 2),
(20, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(21, '2014_10_12_100000_create_password_resets_table', 2),
(22, '2019_08_19_000000_create_failed_jobs_table', 2),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(26, '2024_07_16_153547_create_trip_table', 3),
(27, '2024_07_16_055527_create_data_registrasi_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trip`
--

CREATE TABLE `trip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_trip` varchar(255) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `judul_trip` varchar(255) NOT NULL,
  `jumlah_bus` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `trip`
--

INSERT INTO `trip` (`id`, `kode_trip`, `nama_sekolah`, `judul_trip`, `jumlah_bus`, `created_at`, `updated_at`) VALUES
(1, '07NQA', 'SDN 02 Rawa Buntu', 'Field Trip ke Bandung', '3', '2024-07-23 17:09:00', '2024-07-23 17:09:00'),
(2, '07a4U', 'SMK Negeri 12 Tangerang', 'Field Trip ke Jogja', '5', '2024-07-23 22:56:11', '2024-07-23 22:56:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'superadmin@kelaspiknik.com', 'Superadmin', NULL, '$2y$12$SMy09MuxbgYDNYYrgVuaO.bJ1aF//mZbIJH3lt1JZNs5Rh7xlLxc2', NULL, '2024-07-23 16:55:08', '2024-07-23 16:55:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_registrasi`
--
ALTER TABLE `data_registrasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_registrasi_id_reg_unique` (`id_reg`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trip_kode_trip_unique` (`kode_trip`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_registrasi`
--
ALTER TABLE `data_registrasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `trip`
--
ALTER TABLE `trip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
