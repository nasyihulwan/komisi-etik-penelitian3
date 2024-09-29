-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2024 pada 11.58
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komisi_etik_penelitian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id_members` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `negara` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `org` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id_members`, `email`, `password`, `nama`, `kota`, `negara`, `hp`, `org`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'ali.rahmat.9b.smpn8@gmail.com', '$2y$10$eHyd0U4.DYEg6tT1BbWBeek9zkKx12kP0i5CaiEkgD2zg1xZtabUS', 'Ali Rahmat Hidayatulloh', 'Bandung', 'Indonesia', '082112726622', 'UPI', '2024-05-28 16:57:26', '2024-05-28 16:57:26', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sop-request`
--

CREATE TABLE `sop-request` (
  `id_sop` int(255) NOT NULL,
  `judul` text NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `sumber_dana` varchar(255) NOT NULL,
  `pemberi_hibah` varchar(255) NOT NULL,
  `surat_pernyataan_mandiri` text DEFAULT NULL,
  `formulir_etik` text NOT NULL,
  `proposal` text NOT NULL,
  `bukti_pembayaran` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` enum('belum diperiksa','sedang diperiksa','disetujui','ditolak') NOT NULL DEFAULT 'belum diperiksa',
  `pesan` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `id_members` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_members`);

--
-- Indeks untuk tabel `sop-request`
--
ALTER TABLE `sop-request`
  ADD PRIMARY KEY (`id_sop`),
  ADD KEY `id_members` (`id_members`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id_members` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sop-request`
--
ALTER TABLE `sop-request`
  MODIFY `id_sop` int(255) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sop-request`
--
ALTER TABLE `sop-request`
  ADD CONSTRAINT `sop-request_ibfk_1` FOREIGN KEY (`id_members`) REFERENCES `members` (`id_members`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
