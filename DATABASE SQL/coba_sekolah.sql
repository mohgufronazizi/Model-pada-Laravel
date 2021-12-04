-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Nov 2021 pada 10.10
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coba_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama`) VALUES
(1, 'Informatika'),
(2, 'Desain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `alamat` text DEFAULT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `jk`, `alamat`, `tmp_lahir`, `tgl_lahir`, `telepon`, `id_jurusan`, `nilai`, `foto`) VALUES
('2021010001', 'Sugeng', 'L', 'jalan setan', 'Bandung', '2000-02-28', '08123567899', 1, 80, NULL),
('2021010002', 'Susi Susanti', 'P', 'jalan Mawar', 'Jakarta', '1997-10-02', '08198765432', 2, 85, NULL),
('2021010003', 'Taufik Hidayat', 'L', 'jalan Basket', 'Jakarta', '1997-09-12', '08198767643', 1, 78, NULL),
('2021010004', 'Slamet Raharjo', 'L', 'jalan Biola', 'Malang', '2001-11-02', '08198878365', 2, 98, NULL),
('2021010005', 'Sony Dwi', 'L', 'jalan Panaso', 'Bogor', '2001-09-22', '08198765432', 1, 55, NULL),
('2021010006', 'Bunga', 'P', 'jalan Matahari', 'Malang', '2002-07-14', '08198763643', 2, 88, NULL),
('2021010007', 'Riri', 'L', 'jalan Seruni', 'Kediri', '2000-10-02', '08532765432', 1, 76, ''),
('2021010008', 'Indah', 'P', 'jalan Stan', 'Bogor', '1999-10-02', '08532444432', 2, 91, 'upload/1627233794880.jpg'),
('2021010009', 'Alibabana', 'L', 'arab', 'Nil River', '1998-06-13', '085515313333', 1, 80, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp_siswa`
--

CREATE TABLE `spp_siswa` (
  `id_pembayaran` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `bulan` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spp_siswa`
--

INSERT INTO `spp_siswa` (`id_pembayaran`, `nis`, `tgl_pembayaran`, `bulan`, `nominal`) VALUES
(1, '2021010001', '2021-01-08 08:00:00', 1, 50000),
(2, '2021010001', '2021-01-08 08:00:00', 2, 50000),
(3, '2021010001', '2021-01-08 08:00:00', 3, 50000),
(4, '2021010001', '2021-01-08 08:00:00', 4, 50000),
(5, '2021010001', '2021-01-08 08:00:00', 5, 50000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `spp_siswa`
--
ALTER TABLE `spp_siswa`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `spp_siswa`
--
ALTER TABLE `spp_siswa`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
