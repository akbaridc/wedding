-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2023 pada 19.47
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `acara`
--

CREATE TABLE `acara` (
  `id` int(11) NOT NULL,
  `id_mempelai` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `is_finished` int(2) DEFAULT NULL,
  `is_other_place` int(2) DEFAULT NULL,
  `tempat_other` varchar(100) DEFAULT NULL,
  `alamat_other` text DEFAULT NULL,
  `type` enum('Akad Nikah','Resepsi') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `acara`
--

INSERT INTO `acara` (`id`, `id_mempelai`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `is_finished`, `is_other_place`, `tempat_other`, `alamat_other`, `type`, `created_at`, `updated_at`) VALUES
(15, 3, '2023-07-13', '09:00:00', NULL, 1, NULL, NULL, NULL, 'Akad Nikah', '2023-05-09 23:51:05', '2023-05-09 16:51:05'),
(16, 3, '2023-07-13', '12:00:00', NULL, 1, NULL, NULL, NULL, 'Resepsi', '2023-05-09 23:51:05', '2023-05-09 16:51:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `audio`
--

CREATE TABLE `audio` (
  `id` int(11) NOT NULL,
  `source` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `audio`
--

INSERT INTO `audio` (`id`, `source`, `created_at`, `updated_at`) VALUES
(2, 'Audio-1683782134HhRCiUn.mp3', '2023-05-11 12:15:34', '2023-05-11 05:15:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `position` enum('primary','second') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `banner`
--

INSERT INTO `banner` (`id`, `foto`, `position`, `created_at`, `updated_at`) VALUES
(7, 'Banner-1683725352CUh3dnK.jpg', 'second', '2023-05-10 20:29:14', '2023-05-10 13:29:14'),
(8, 'Banner-1683725467NsTR4Ui.jpg', 'primary', '2023-05-10 20:31:08', '2023-05-10 13:31:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galery`
--

INSERT INTO `galery` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(39, 'Galery-1683705875t72HRYJ.jpg', '2023-05-10 15:04:41', '2023-05-10 08:04:41'),
(40, 'Galery-1683705876SxAFqtX.jpg', '2023-05-10 15:04:41', '2023-05-10 08:04:41'),
(41, 'Galery-1683705876txloEsB.jpg', '2023-05-10 15:04:41', '2023-05-10 08:04:41'),
(42, 'Galery-16837058777VSa41u.jpg', '2023-05-10 15:04:41', '2023-05-10 08:04:41'),
(43, 'Galery-1683705878pWTYhe5.jpg', '2023-05-10 15:04:41', '2023-05-10 08:04:41'),
(44, 'Galery-1683705879Xdwv96x.jpg', '2023-05-10 15:04:41', '2023-05-10 08:04:41'),
(45, 'Galery-1683705880VmEJuza.jpg', '2023-05-10 15:04:41', '2023-05-10 08:04:41'),
(46, 'Galery-1683705881nqDXVUl.jpg', '2023-05-10 15:04:41', '2023-05-10 08:04:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `maps`
--

CREATE TABLE `maps` (
  `id` int(11) NOT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `maps`
--

INSERT INTO `maps` (`id`, `alamat`, `created_at`, `updated_at`) VALUES
(2, '<iframe style=\"box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; width: 100%\" class=\"rounded\" src=\"https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1173.592238821942!2d113.52791480996952!3d-8.354545300518852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zOMKwMjEnMTQuMyJTIDExM8KwMzEnNDAuNiJF!5e0!3m2!1sid!2sid!4v1683104492063!5m2!1sid!2sid\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2023-05-10 21:57:57', '2023-05-10 14:57:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mempelai`
--

CREATE TABLE `mempelai` (
  `id` int(11) NOT NULL,
  `nama_panggilan` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `orang_tua` varchar(255) DEFAULT NULL,
  `is_gender` int(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mempelai`
--

INSERT INTO `mempelai` (`id`, `nama_panggilan`, `nama_lengkap`, `alamat`, `foto`, `orang_tua`, `is_gender`, `created_at`, `updated_at`) VALUES
(2, 'Akbar', 'Akbar Imawan Dwi Cahya', 'Dsn Curah Rejo RT 001 / RW 025, Desa Cangkring, Kec. Jenggawah, Kab. Jember', 'Image-1683560748gSk2fI8.jpg', 'Suparno & (Almh) Nining W', 1, '2023-05-08 22:45:48', '2023-05-08 15:45:48'),
(3, 'Aisyah', 'Aisyah Nora Kurniawati', 'Dusun Kepel Rt 001 / Rw 001, Desa Ampel, Kec. Wuluhan, Kab. Jember', 'Image-16835608646s1zFwn.jpg', 'Sunardi & Mudrikah', 2, '2023-05-08 22:47:44', '2023-05-08 15:47:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mempelai_detail`
--

CREATE TABLE `mempelai_detail` (
  `id` int(11) NOT NULL,
  `id_mempelai` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mempelai_detail`
--

INSERT INTO `mempelai_detail` (`id`, `id_mempelai`, `nama`, `link`, `icon`, `created_at`, `updated_at`) VALUES
(15, 2, 'Instagram', 'https://www.instagram.com/akbaridc_/', 'bi-instagram', '2023-05-11 10:40:26', '2023-05-11 03:40:26'),
(16, 2, 'Facebook', 'https://www.facebook.com/rt4rw6', 'bi-facebook', '2023-05-11 10:40:26', '2023-05-11 03:40:26'),
(17, 2, 'Linkedin', 'https://www.linkedin.com/in/akbaridc/', 'bi-linkedin', '2023-05-11 10:40:26', '2023-05-11 03:40:26'),
(18, 3, 'Instagram', 'https://www.instagram.com/aisyahnoraa/', 'bi-instagram', '2023-05-11 10:41:11', '2023-05-11 03:41:11'),
(19, 3, 'Facebook', 'https://www.facebook.com/aisyah.n.kurniawati', 'bi-facebook', '2023-05-11 10:41:11', '2023-05-11 03:41:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id` int(11) NOT NULL,
  `rekening` varchar(50) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id`, `rekening`, `logo`, `color`, `created_at`, `updated_at`) VALUES
(2, 'BCA', 'Rekening-16837784683DqrXjH.png', '#1473e6', '2023-05-10 22:57:53', '2023-05-10 15:57:53'),
(3, 'BNI', 'Rekening-1683778407oGHMQ5R.png', '#b34200', '2023-05-11 10:56:37', '2023-05-11 03:56:37'),
(4, 'BRI', 'Rekening-1683778419tuqPz36.png', '#014a94', '2023-05-11 10:58:48', '2023-05-11 03:58:48'),
(5, 'MANDIRI', 'Rekening-1683778427uYBKd9J.png', '#459dda', '2023-05-11 10:59:16', '2023-05-11 03:59:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_hadiah`
--

CREATE TABLE `rekening_hadiah` (
  `id` int(11) NOT NULL,
  `id_rekening` int(11) DEFAULT NULL,
  `atas_nama` varchar(100) DEFAULT NULL,
  `nomor_rekening` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekening_hadiah`
--

INSERT INTO `rekening_hadiah` (`id`, `id_rekening`, `atas_nama`, `nomor_rekening`, `created_at`, `updated_at`) VALUES
(2, 2, 'Akbar Imawan Dwi Cahya', '3340464442', '2023-05-10 23:49:16', '2023-05-10 16:49:16'),
(3, 3, 'Aisyah Nora Kurniawati', '1301025960', '2023-05-11 11:01:47', '2023-05-11 04:01:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu_undangan`
--

CREATE TABLE `tamu_undangan` (
  `id` int(11) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `teman_dari` varchar(150) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tamu_undangan`
--

INSERT INTO `tamu_undangan` (`id`, `slug`, `nama`, `telepon`, `teman_dari`, `link`, `created_at`, `updated_at`) VALUES
(7, 'akbar-imawan-dwi-cahya-amdkom', 'Akbar Imawan Dwi Cahya, A.Md.Kom', '1234567', 'emboh', 'http://localhost/wedding/?kepada=akbar-imawan-dwi-cahya-amdkom', '2023-05-11 23:05:12', '2023-05-11 15:23:52'),
(8, 'fgdrgr-awd', 'fgdrgr awd', 'sdhd', 'ssd', 'http://localhost/wedding/?kepada=fgdrgr-awd', '2023-05-11 22:23:52', '2023-05-11 15:23:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu_undangan_detail`
--

CREATE TABLE `tamu_undangan_detail` (
  `id` int(11) NOT NULL,
  `id_tamu_undangan` int(11) DEFAULT NULL,
  `is_hadir` enum('Hadir','Tidak Hadir','Belum Pasti') DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `pesan_balasan` text DEFAULT NULL,
  `tanggal_balasan` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tamu_undangan_detail`
--

INSERT INTO `tamu_undangan_detail` (`id`, `id_tamu_undangan`, `is_hadir`, `pesan`, `pesan_balasan`, `tanggal_balasan`, `created_at`, `updated_at`) VALUES
(3, 7, 'Hadir', 'selamat ya', NULL, NULL, '2023-05-11 23:35:00', '2023-05-11 16:35:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$qIO6SizGyf3859OTLnbn/eCBWPpbwP9yB.IGJCmto4c0QSCDB/lua', '2023-05-05 16:03:35', '2023-05-05 16:03:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `acara`
--
ALTER TABLE `acara`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mempelai`
--
ALTER TABLE `mempelai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mempelai_detail`
--
ALTER TABLE `mempelai_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekening_hadiah`
--
ALTER TABLE `rekening_hadiah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tamu_undangan`
--
ALTER TABLE `tamu_undangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tamu_undangan_detail`
--
ALTER TABLE `tamu_undangan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `acara`
--
ALTER TABLE `acara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `audio`
--
ALTER TABLE `audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mempelai`
--
ALTER TABLE `mempelai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `mempelai_detail`
--
ALTER TABLE `mempelai_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rekening_hadiah`
--
ALTER TABLE `rekening_hadiah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tamu_undangan`
--
ALTER TABLE `tamu_undangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tamu_undangan_detail`
--
ALTER TABLE `tamu_undangan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
