-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 06:52 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikendaraan`
--

-- --------------------------------------------------------

--
-- Table structure for table `cetak`
--

CREATE TABLE `cetak` (
  `id` int(11) NOT NULL,
  `nomor_polisi` varchar(100) NOT NULL,
  `jenis_kendaraan` varchar(100) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip_pegawai` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `keperluan` varchar(100) NOT NULL,
  `keperluan_2` varchar(100) NOT NULL,
  `penumpang` varchar(100) NOT NULL,
  `nama_camat` varchar(100) NOT NULL,
  `nip_camat` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `waktu_huruf` varchar(100) NOT NULL,
  `waktu_angka` varchar(100) NOT NULL,
  `nama_kasubbag` varchar(100) NOT NULL,
  `nilai_voucher` int(11) NOT NULL,
  `jumlah_bbm` int(11) NOT NULL,
  `harga_bbm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cetak`
--

INSERT INTO `cetak` (`id`, `nomor_polisi`, `jenis_kendaraan`, `nama_pegawai`, `nip_pegawai`, `jabatan`, `keperluan`, `keperluan_2`, `penumpang`, `nama_camat`, `nip_camat`, `tanggal`, `waktu_huruf`, `waktu_angka`, `nama_kasubbag`, `nilai_voucher`, `jumlah_bbm`, `harga_bbm`) VALUES
(16, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 'Menyetorkan Usulan Tamsil Januari', '', '2', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', '2023-03-03', 'Satu', '1', 'Nur Fatimah, S.IP', 89600, 7, '12800'),
(17, 'AA 6037 XD', 'Roda 2 (dua)', 'SUPARYO, S. Sos', '19651124 198812 1 001', 'SEKRETARIS CAMAT', 'Rapat PMI', '', '1', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', '2023-03-03', 'Satu', '1', 'Nur Fatimah, S.IP', 25600, 2, '12800'),
(27, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 'Studi Banding', '', '4', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', '2023-05-13', 'Dua', '2', 'Nur Fatimah, S.IP', 133000, 10, '13300'),
(28, 'AA 9609 UD', 'Roda 2 (dua)', 'Dra. DWI SUPRAPTI', '19650903 199203 2 006', 'Kasi Kesos ', 'Rapat', '', '1', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', '2023-06-01', 'Satu', '1', 'Nur Fatimah, S.IP', 266000, 20, '13300'),
(29, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 'Menyetorkan Usulan Tamsil Juni', '', '3', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', '2023-06-09', 'Satu', '1', 'Nur Fatimah, S.IP', 87500, 7, '12500');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbbm` int(11) NOT NULL,
  `no_pol` varchar(100) NOT NULL,
  `jen_kendaraan` varchar(100) NOT NULL,
  `nama_peg` varchar(100) NOT NULL,
  `no_induk_peg` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbbm`, `no_pol`, `jen_kendaraan`, `nama_peg`, `no_induk_peg`, `jabatan`, `jumlah`, `tanggal`) VALUES
(20, 2, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 7, '2023-07-25 04:44:46'),
(21, 1, 'AA 6037 XD', 'Roda 2 (dua)', 'SUPARYO, S. Sos', '19651124 198812 1 001', 'SEKRETARIS CAMAT', 2, '2023-07-25 04:44:38'),
(22, 1, 'AA 9883 SD', 'Roda 2 (dua)', 'NUR FATIMAH, S.IP', '19750210 200701 2 028', 'Kasubag Umum dan Kepegawaian', 2, '2023-07-25 04:44:30'),
(23, 1, 'AA 9792 RD', 'Roda 2 (dua)', 'EVI RETNAWATI', '19821225 201406 2 009', 'Pengadministrasi Keuangan', 2, '2023-07-25 04:44:22'),
(24, 2, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 10, '2023-07-25 04:44:12'),
(25, 1, 'AA 6131 XM', 'Roda 2 (dua)', 'ROHMAT ZUHRI, S.IP', '19720218 199301 1 001', 'Kasi Tata Pemerintahan', 2, '2023-07-25 04:44:05'),
(26, 1, 'AA 9883 SD', 'Roda 2 (dua)', 'NUR FATIMAH, S.IP', '19750210 200701 2 028', 'Kasubag Umum dan Kepegawaian', 2, '2023-07-25 04:43:56'),
(27, 1, 'AA 9792 RD', 'Roda 2 (dua)', 'EVI RETNAWATI', '19821225 201406 2 009', 'Pengadministrasi Keuangan', 2, '2023-07-25 04:43:49'),
(28, 2, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 7, '2023-07-25 04:43:41'),
(29, 1, 'AA 9792 RD', 'Roda 2 (dua)', 'EVI RETNAWATI', '19821225 201406 2 009', 'Pengadministrasi Keuangan', 2, '2023-07-25 04:43:32'),
(30, 1, 'AA 6341 XM', 'Roda 2 (dua)', 'NIKEN BUDI WAHYUNI,S.M', '19730311 199203 2 003', 'Kasubag Perencanaan dan Keuangan', 2, '2023-07-25 04:43:21'),
(31, 1, 'AA 9609 UD', 'Roda 2 (dua)', 'Dra. DWI SUPRAPTI', '19650903 199203 2 006', 'Kasi Kesos ', 2, '2023-07-25 04:43:11'),
(34, 1, 'AA 9747 SD', 'Roda 2 (dua)', 'SARJA', '19660212 198611 1 001', 'Pengadministrasi Umum', 2, '2023-07-25 04:43:02'),
(35, 1, 'AA 6037 XD', 'Roda 2 (dua)', 'SUPARYO, S. Sos', '19651124 198812 1 001', 'SEKRETARIS CAMAT', 20, '2023-07-25 04:42:51'),
(36, 2, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 73, '2023-07-25 04:42:43'),
(37, 1, 'AA 9792 RD', 'Roda 2 (dua)', 'EVI RETNAWATI', '19821225 201406 2 009', 'Pengadministrasi Keuangan', 26, '2023-07-25 04:42:34'),
(38, 2, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 10, '2023-07-25 04:42:24'),
(39, 1, 'AA 9609 UD', 'Roda 2 (dua)', 'Dra. DWI SUPRAPTI', '19650903 199203 2 006', 'Kasi Kesos ', 20, '2023-07-25 04:42:14'),
(40, 2, 'AA 126 D', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT', 7, '2023-06-09 02:32:11');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `idkendaraan` int(11) NOT NULL,
  `no_polisi` varchar(100) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `j_kendaraan` varchar(100) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `jab` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`idkendaraan`, `no_polisi`, `merek`, `j_kendaraan`, `nama_pegawai`, `nip`, `jab`) VALUES
(1, 'AA 126 D', 'TOYOTA', 'Roda 4 (empat)', 'Drs. H. BAMBANG WIDADI', '19650528 199203 1 007', 'CAMAT'),
(5, 'AA 6037 XD', 'YAMAHA JUPITER CW', 'Roda 2 (dua)', 'SUPARYO, S. Sos', '19651124 198812 1 001', 'SEKRETARIS CAMAT'),
(7, 'AA 9883 SD', 'YAMAHA VEGA', 'Roda 2 (dua)', 'NUR FATIMAH, S.IP', '19750210 200701 2 028', 'Kasubag Umum dan Kepegawaian'),
(8, 'AA 9610 UD', 'YAMAHA JUPITER CW', 'Roda 2 (dua)', 'Jaelan, S.pd.,M.Pd', '19660311 199102 1 002', 'Kasi Pemberdayaan Masyarakat'),
(9, 'AA 9609 UD', 'YAMAHA JUPITER CW', 'Roda 2 (dua)', 'Dra. DWI SUPRAPTI', '19650903 199203 2 006', 'Kasi Kesos '),
(10, 'AA 9608 UD', 'YAMAHA JUPITER CW', 'Roda 2 (dua)', 'PARIJO,S.Pd', '19660101 199103 1 027', 'Kasi Ketentraman dan Ketertiban'),
(11, 'AA 6131 XM', 'YAMAHA JUPITER CW', 'Roda 2 (dua)', 'ROHMAT ZUHRI, S.IP', '19720218 1993011 001', 'Kasi Tata Pemerintahan'),
(12, 'AA 9792 RD', 'YAMAHA VEGA', 'Roda 2 (dua)', 'EVI RETNAWATI', '19821225 201406 2 009', 'Pengadministrasi Keuangan'),
(13, 'AA 9790 RD', 'YAMAHA VEGA', 'Roda 2 (dua)', 'SUDARTI', '19650505 198710 2 001', 'Pengadministrasi Keuangan'),
(14, 'AA 9749 SD', 'YAMAHA VEGA', 'Roda 2 (dua)', 'HARUNUROSID', '19650710 200701 1 030', 'Pengadministrasi Umum'),
(17, 'AA 9753 SD', 'YAMAHA VEGA', 'Roda 2 (dua)', 'SLAMET', '19670610 200701 1 023', 'Pengadministrasi Umum'),
(18, 'AA 6341 XM', ' 	YAMAHA FREGO', 'Roda 2 (dua)', 'NIKEN BUDI WAHYUNI,S.M', '19730311 199203 2 003', 'Kasubag Perencanaan dan Keuangan'),
(19, 'AA 9756 SD', 'YAMAHA VEGA', 'Roda 2 (dua)', 'SUKARNI', '19690411 198903 2 008', 'Pengadministrasi Umum'),
(20, 'AA 9747 SD', 'YAMAHA VEGA', 'Roda 2 (dua)', 'SARJA', '19660212 198611 1 001', 'Pengadministrasi Umum');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nick` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `nick`) VALUES
(1, 'admin', 'bulusbarat', 'Admin'),
(2, 'gilang', '1qaz2wsx', 'GILANG');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbbm` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbbm`, `keterangan`, `jumlah`, `tanggal`) VALUES
(11, 1, '2023', 240, '2023-03-03 03:36:00'),
(12, 2, '2023', 840, '2023-03-03 04:12:30'),
(15, 0, '2023', 20, '2023-05-18 08:01:17'),
(19, 1, '2023', 20, '2023-05-19 05:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `pajak`
--

CREATE TABLE `pajak` (
  `idpajak` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `no_polisi` varchar(100) NOT NULL,
  `tahun_kendaraan` varchar(100) NOT NULL,
  `jatuh_tempo` varchar(100) NOT NULL,
  `5_tahun_awal` varchar(100) NOT NULL,
  `5_tahun_akhir` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pajak`
--

INSERT INTO `pajak` (`idpajak`, `merek`, `no_polisi`, `tahun_kendaraan`, `jatuh_tempo`, `5_tahun_awal`, `5_tahun_akhir`, `keterangan`) VALUES
(4, 'TOYOTA', 'AA 126 D', '2019', '2024-04-26', '2024', '2029', '-'),
(5, 'YAMAHA JUPITER CW', 'AA 6037 XD', '2020', '2024-03-26', '2025', '2030', '-'),
(6, 'YAMAHA VEGA', 'AA 9883 SD', '2014', '2024-05-18', '2019', '2024', '-'),
(7, 'YAMAHA JUPITER CW', 'AA 9610 UD', '2019', '2023-08-06', '2024', '2029', '-'),
(8, 'YAMAHA JUPITER CW', 'AA 9609 UD', '2019', '2023-08-06', '2024', '2029', '-'),
(9, 'YAMAHA JUPITER CW', 'AA 9608 UD', '2019', '2023-08-06', '2024', '2029', '-'),
(10, 'YAMAHA JUPITER CW', 'AA 6131 XM', '2016', '2023-11-16', '2021', '2026', '-'),
(11, 'YAMAHA VEGA', 'AA 9792 RD', '2013', '2024-04-23', '2023', '2028', '-'),
(12, 'YAMAHA VEGA', 'AA 9790 RD', '2013', '2024-05-25', '2023', '2028', '-'),
(13, 'YAMAHA VEGA', 'AA 9749 SD', '2013', '2023-10-12', '2018', '2023', 'GANTI TNKB'),
(14, 'YAMAHA VEGA', 'AA 9747 SD', '2013', '2023-10-11', '2018', '2023', 'GANTI TNKB'),
(15, 'YAMAHA VEGA', 'AA 9756 SD', '2013', '2023-10-11', '2018', '2023', 'GANTI TNKB'),
(16, 'YAMAHA VEGA', 'AA 9753 SD', '2013', '2023-10-11', '2018', '2023', 'GANTI TNKB'),
(17, 'YAMAHA FREGO', 'AA 6341 XM', '2022', '2024-06-10', '2023', '2027', '-');

-- --------------------------------------------------------

--
-- Table structure for table `stok_bbm`
--

CREATE TABLE `stok_bbm` (
  `idbbm` int(11) NOT NULL,
  `jenis_kendaraan` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_bbm`
--

INSERT INTO `stok_bbm` (`idbbm`, `jenis_kendaraan`, `stok`) VALUES
(1, 'Roda 2 (dua)', 174),
(2, 'Roda 4 (empat)', 726);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cetak`
--
ALTER TABLE `cetak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`idkendaraan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`idpajak`);

--
-- Indexes for table `stok_bbm`
--
ALTER TABLE `stok_bbm`
  ADD PRIMARY KEY (`idbbm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cetak`
--
ALTER TABLE `cetak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `idkendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pajak`
--
ALTER TABLE `pajak`
  MODIFY `idpajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stok_bbm`
--
ALTER TABLE `stok_bbm`
  MODIFY `idbbm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
