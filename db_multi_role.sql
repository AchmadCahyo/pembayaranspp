-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Apr 2024 pada 04.30
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_multi_role`
--

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
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `kompetensi_keahlian` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `kompetensi_keahlian`, `created_at`, `updated_at`) VALUES
(1, '10 RPL 1', 'Rekayasa Perangkat Lunak', '2024-03-11 19:57:24', '2024-03-11 19:57:24'),
(2, '11 RPL 1', 'Rekayasa Perangkat Lunak', '2024-03-13 21:33:55', '2024-03-13 21:33:55'),
(3, '10 TKJ 1', 'Teknik Komputer dan Jaringan', '2024-03-13 21:34:28', '2024-03-13 21:34:28'),
(4, '11 TKJ 1', 'Teknik Komputer dan Jaringan', '2024-03-14 19:42:07', '2024-03-14 19:42:07'),
(5, '10 ANM 1', 'Animasi', '2024-03-14 19:42:32', '2024-03-14 19:42:32');

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
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_11_030026_create_kelas_table', 1),
(7, '2024_03_11_091251_create_spps_table', 1),
(8, '2024_03_12_010941_create_siswas_table', 1),
(9, '2024_03_13_040806_create_siswas_table', 2),
(10, '2024_03_15_030542_create_pembayarans_table', 3),
(11, '2024_03_16_054111_add_total_bayar_to_pembayarans_table', 4);

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
-- Struktur dari tabel `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `spp_id` bigint(20) UNSIGNED NOT NULL,
  `nama_penginput` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_bayar` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `siswa_id`, `tanggal_bayar`, `bulan`, `spp_id`, `nama_penginput`, `created_at`, `updated_at`, `total_bayar`) VALUES
(5, 5, '2024-03-25', 'Januari', 1, 'bayu', '2024-03-24 21:41:26', '2024-03-24 21:41:26', 100000),
(7, 14, '2024-03-25', 'Januari', 1, 'bayu', '2024-03-25 00:17:11', '2024-03-25 00:17:11', 200000),
(8, 11, '2024-03-13', 'Februari', 1, 'Noval', '2024-03-26 21:19:48', '2024-03-26 21:19:48', 200000);

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
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nisn` bigint(20) NOT NULL,
  `nis` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` bigint(20) NOT NULL,
  `spp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` text DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `nisn`, `nis`, `nama`, `kelas_id`, `alamat`, `no_telp`, `spp_id`, `created_at`, `updated_at`, `password`, `email`) VALUES
(5, 8936, 892363, 'Paijo', 4, 'Surabaya', 987654300981, 1, '2024-03-18 01:06:57', '2024-03-19 20:57:23', '$2y$12$rDrIzNe50rioNQzPpR6mU.RYAoMnQVtcpy6b4QTldOQdvLqewT7Q2', 'paijo56@gmail.com'),
(11, 8976, 823627, 'tester', 1, 'Malang', 97327632870, 1, '2024-03-21 20:58:43', '2024-03-21 20:58:43', '$2y$12$S3KWfQYnalIhkBqwgAM4deJA9dXBaPeTP4X1SLcT0PldQzZpEHfMa', 'test@gmail.com'),
(14, 9867, 896756, 'Luna', 3, 'Sukun', 89763782736, 1, '2024-03-25 00:16:48', '2024-03-25 00:16:48', '$2y$12$1gAIBgdFWymWDE5tVTM8pOEW1OxqnnXA57KSyrpshALwoCIhnhwLu', 'luna@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spps`
--

CREATE TABLE `spps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` bigint(20) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `spps`
--

INSERT INTO `spps` (`id`, `tahun`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 2024, 300000, '2024-03-11 19:57:42', '2024-03-11 19:57:42'),
(2, 2024, 100000, '2024-03-14 23:21:23', '2024-03-14 23:21:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` bigint(20) NOT NULL DEFAULT 3,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'bayu', 'bayu@gmail.com', NULL, '$2y$12$mx8njLWH80lW58LDBaA97u0i4S/tKTwAa5tk7dckrIf3yQOgeCUMa', 1, NULL, '2024-03-13 21:23:32', '2024-03-13 21:23:32'),
(5, 'ayu', 'ayu@gmail.com', NULL, '$2y$12$lHtTrnOTK6voTOIVA1EsReCeYVMAcYezt3Pnf1c0FHJzSMTPHDarG', 2, NULL, '2024-03-13 21:23:32', '2024-03-13 21:23:32'),
(13, 'Noval', 'nopal78@gmail.com', NULL, '$2y$12$8T3aK2DxIbkT/GjsxR652O3f.IikiBVYvlwEc3w6forN6U6Q8MQEG', 2, NULL, '2024-03-26 20:43:16', '2024-03-26 20:43:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_siswa_id_foreign` (`siswa_id`),
  ADD KEY `pembayarans_spp_id_foreign` (`spp_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`),
  ADD KEY `siswas_spp_id_foreign` (`spp_id`);

--
-- Indeks untuk tabel `spps`
--
ALTER TABLE `spps`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `spps`
--
ALTER TABLE `spps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
