-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Jul 2018 pada 20.34
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cargo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_order`
--

CREATE TABLE IF NOT EXISTS `delivery_order` (
`ID` int(11) NOT NULL,
  `NOMOR_DO` varchar(100) DEFAULT NULL,
  `ID_TUJUAN` int(11) DEFAULT NULL,
  `TGL_DO_MSK` varchar(15) DEFAULT NULL,
  `TGL_PENGIRIMAN` varchar(15) DEFAULT NULL,
  `ID_PELANGGAN` int(11) DEFAULT NULL,
  `NOMOR_INVOICE` varchar(10) DEFAULT NULL,
  `TANGGAL_INVOICE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `delivery_order`
--

INSERT INTO `delivery_order` (`ID`, `NOMOR_DO`, `ID_TUJUAN`, `TGL_DO_MSK`, `TGL_PENGIRIMAN`, `ID_PELANGGAN`, `NOMOR_INVOICE`, `TANGGAL_INVOICE`) VALUES
(1, '001', 1, '18-07-2018', '19-07-2018', 2, '001', '18-07-2018'),
(2, '003', 1, '18-07-2018', '19-07-2018', 2, '001', '18-07-2018');

-- --------------------------------------------------------

--
-- Struktur dari tabel `do_detail`
--

CREATE TABLE IF NOT EXISTS `do_detail` (
`ID` int(11) NOT NULL,
  `ID_DO` int(11) DEFAULT NULL,
  `ID_BARANG` int(11) DEFAULT NULL,
  `BERAT` double DEFAULT NULL,
  `HARGA` double DEFAULT NULL,
  `JUMLAH` double DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `do_detail`
--

INSERT INTO `do_detail` (`ID`, `ID_DO`, `ID_BARANG`, `BERAT`, `HARGA`, `JUMLAH`) VALUES
(1, 1, 1, 10, 550000, 550000),
(2, 1, 2, 1, 300000, 300000),
(3, 2, 4, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `do_jasa`
--

CREATE TABLE IF NOT EXISTS `do_jasa` (
`ID` int(11) NOT NULL,
  `ID_DO` int(11) DEFAULT NULL,
  `ID_JASA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_barang`
--

CREATE TABLE IF NOT EXISTS `master_barang` (
`id_barang` int(11) NOT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `nama_barang` text NOT NULL,
  `jumlah` varchar(255) DEFAULT NULL,
  `harga_total` varchar(255) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `kode_barang`, `nama_barang`, `jumlah`, `harga_total`, `id_satuan`) VALUES
(1, 'P-0013202', 'Beras', '1', '5000', 6),
(2, 'P-0043353', 'Gula', '0', '0', 6),
(3, 'P-0038739', 'Garam', '0', '0', 6),
(4, 'P-849292', 'ZTE', '0', '0', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jasa`
--

CREATE TABLE IF NOT EXISTS `master_jasa` (
`id_jasa` int(11) NOT NULL,
  `nama_jasa` varchar(255) DEFAULT NULL,
  `biaya` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `master_jasa`
--

INSERT INTO `master_jasa` (`id_jasa`, `nama_jasa`, `biaya`) VALUES
(1, 'Jasa Angkut', '300000'),
(2, 'Jasa Angkut Ekstra', '900000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pelanggan`
--

CREATE TABLE IF NOT EXISTS `master_pelanggan` (
`id_pelanggan` int(11) NOT NULL,
  `kode_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `npwp` varchar(50) NOT NULL,
  `akun_debit` varchar(255) DEFAULT NULL,
  `akun_kredit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `master_pelanggan`
--

INSERT INTO `master_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `telp`, `email`, `npwp`, `akun_debit`, `akun_kredit`) VALUES
(1, 'A0001', 'jhoe ramadhan', 'jl. ketintang ', '085706002655', 'jhoeramadhan@gmail.com', '908090000000', '1', '2'),
(2, 'A0002', 'Gita Suara', 'jl. Raden Saleh', '031-925648', 'gita_suara@gmail.com', '6464666', '13', '40'),
(3, 'A0003', 'Juned Geo', 'Jl. Soemolo waru ', '031-888777', 'junedgeo@gmail.com', '00005546', NULL, NULL),
(4, 'A0004', 'Helena', 'jl. Bratang Binangun', '031-446653', 'helena@gmail.com', '4446555', NULL, NULL),
(5, 'A0005', 'Reynald', 'jl. Ahmad Yani', '013-544455', 'reynald@gmail.com', '47903878', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_rute`
--

CREATE TABLE IF NOT EXISTS `master_rute` (
`id_rute` int(255) NOT NULL,
  `asal` varchar(255) DEFAULT NULL,
  `tujuan_provinsi` varchar(255) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `biaya` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=982 ;

--
-- Dumping data untuk tabel `master_rute`
--

INSERT INTO `master_rute` (`id_rute`, `asal`, `tujuan_provinsi`, `tujuan`, `biaya`) VALUES
(1, 'Surabaya', 'Jawa Timur', 'Pacitan Kota', '550000'),
(2, 'Surabaya', 'Jawa Timur', 'Pacitan Pringkuku', '550000'),
(3, 'Surabaya', 'Jawa Timur', 'Pacitan Donorojo', '550000'),
(4, 'Surabaya', 'Jawa Timur', 'Pacitan Punung', '550000'),
(5, 'Surabaya', 'Jawa Timur', 'Pacitan Bandar', '550000'),
(6, 'Surabaya', 'Jawa Timur', 'Pacitan Nawangan', '550000'),
(7, 'Surabaya', 'Jawa Timur', 'Pacitan Arjosari', '550000'),
(8, 'Surabaya', 'Jawa Timur', 'Pacitan Tegalombo', '550000'),
(9, 'Surabaya', 'Jawa Timur', 'Pacitan Kebon Agung', '550000'),
(10, 'Surabaya', 'Jawa Timur', 'Pacitan Tulakan', '550000'),
(11, 'Surabaya', 'Jawa Timur', 'Pacitan Ngadirojo', '550000'),
(12, 'Surabaya', 'Jawa Timur', 'Pacitan Sudimoro', '550000'),
(13, 'Surabaya', 'Jawa Timur', 'Ponorogo Babadan', '550000'),
(14, 'Surabaya', 'Jawa Timur', 'Ponorogo Kota', '550000'),
(15, 'Surabaya', 'Jawa Timur', 'Ponorogo Jenangan', '550000'),
(16, 'Surabaya', 'Jawa Timur', 'Ponorogo Jetis', '550000'),
(17, 'Surabaya', 'Jawa Timur', 'Ponorogo Mlarak', '550000'),
(18, 'Surabaya', 'Jawa Timur', 'Ponorogo Siman', '550000'),
(19, 'Surabaya', 'Jawa Timur', 'Ponorogo Ngebel', '550000'),
(20, 'Surabaya', 'Jawa Timur', 'Ponorogo Pudak', '550000'),
(21, 'Surabaya', 'Jawa Timur', 'Ponorogo Pulung', '550000'),
(22, 'Surabaya', 'Jawa Timur', 'Ponorogo Sawoo', '550000'),
(23, 'Surabaya', 'Jawa Timur', 'Ponorogo Sooko', '550000'),
(24, 'Surabaya', 'Jawa Timur', 'Ponorogo Bungkal', '550000'),
(25, 'Surabaya', 'Jawa Timur', 'Ponorogo Ngrayun', '550000'),
(26, 'Surabaya', 'Jawa Timur', 'Ponorogo Sambit', '550000'),
(27, 'Surabaya', 'Jawa Timur', 'Ponorogo Slahung', '550000'),
(28, 'Surabaya', 'Jawa Timur', 'Ponorogo Badegan', '550000'),
(29, 'Surabaya', 'Jawa Timur', 'Ponorogo Balong', '550000'),
(30, 'Surabaya', 'Jawa Timur', 'Ponorogo Jambon', '550000'),
(31, 'Surabaya', 'Jawa Timur', 'Ponorogo Kauman', '550000'),
(32, 'Surabaya', 'Jawa Timur', 'Ponorogo Sampung', '550000'),
(33, 'Surabaya', 'Jawa Timur', 'Ponorogo Sukorejo', '550000'),
(34, 'Surabaya', 'Jawa Timur', 'Trenggalek Bendungan', '550000'),
(35, 'Surabaya', 'Jawa Timur', 'Trenggalek Kota', '550000'),
(36, 'Surabaya', 'Jawa Timur', 'Trenggalek Pogalan', '550000'),
(37, 'Surabaya', 'Jawa Timur', 'Trenggalek Durenan', '550000'),
(38, 'Surabaya', 'Jawa Timur', 'Trenggalek Karangan', '550000'),
(39, 'Surabaya', 'Jawa Timur', 'Trenggalek Pule', '550000'),
(40, 'Surabaya', 'Jawa Timur', 'Trenggalek Suruh', '550000'),
(41, 'Surabaya', 'Jawa Timur', 'Trenggalek Tugu', '550000'),
(42, 'Surabaya', 'Jawa Timur', 'Trenggalek Gandusari', '550000'),
(43, 'Surabaya', 'Jawa Timur', 'Trenggalek Watulimo', '550000'),
(44, 'Surabaya', 'Jawa Timur', 'Trenggalek Kampak', '550000'),
(45, 'Surabaya', 'Jawa Timur', 'Trenggalek Dongko', '550000'),
(46, 'Surabaya', 'Jawa Timur', 'Trenggalek Panggul', '550000'),
(47, 'Surabaya', 'Jawa Timur', 'Trenggalek Munjungan', '550000'),
(48, 'Surabaya', 'Jawa Timur', 'Tulungagung Kedungwaru', '500000'),
(49, 'Surabaya', 'Jawa Timur', 'Tulungagung Ngantru', '500000'),
(50, 'Surabaya', 'Jawa Timur', 'Tulungagung Kota', '500000'),
(51, 'Surabaya', 'Jawa Timur', 'Tulungagung Boyolangu', '500000'),
(52, 'Surabaya', 'Jawa Timur', 'Tulungagung Ngunut', '500000'),
(53, 'Surabaya', 'Jawa Timur', 'Tulungagung Sumbergempol', '500000'),
(54, 'Surabaya', 'Jawa Timur', 'Tulungagung Kalidawir', '500000'),
(55, 'Surabaya', 'Jawa Timur', 'Tulungagung Pucang Laban', '500000'),
(56, 'Surabaya', 'Jawa Timur', 'Tulungagung Rejotangan', '500000'),
(57, 'Surabaya', 'Jawa Timur', 'Tulungagung Tanggung Gunung', '500000'),
(58, 'Surabaya', 'Jawa Timur', 'Tulungagung Bandung', '500000'),
(59, 'Surabaya', 'Jawa Timur', 'Tulungagung Besuki', '500000'),
(60, 'Surabaya', 'Jawa Timur', 'Tulungagung Campur Darat', '500000'),
(61, 'Surabaya', 'Jawa Timur', 'Tulungagung Pakel', '500000'),
(62, 'Surabaya', 'Jawa Timur', 'Tulungagung Gondang', '500000'),
(63, 'Surabaya', 'Jawa Timur', 'Tulungagung Karangrejo', '500000'),
(64, 'Surabaya', 'Jawa Timur', 'Tulungagung Pager Wojo', '500000'),
(65, 'Surabaya', 'Jawa Timur', 'Tulungagung Kauman', '500000'),
(66, 'Surabaya', 'Jawa Timur', 'Tulungagung Sendang', '500000'),
(67, 'Surabaya', 'Jawa Timur', 'Kediri Gampingrejo', '500000'),
(68, 'Surabaya', 'Jawa Timur', 'Kediri Gurah', '500000'),
(69, 'Surabaya', 'Jawa Timur', 'Kediri Pagu', '500000'),
(70, 'Surabaya', 'Jawa Timur', 'Kediri Papar', '500000'),
(71, 'Surabaya', 'Jawa Timur', 'Kediri Kunjang', '500000'),
(72, 'Surabaya', 'Jawa Timur', 'Kediri Pare', '500000'),
(73, 'Surabaya', 'Jawa Timur', 'Kediri Plemahan', '500000'),
(74, 'Surabaya', 'Jawa Timur', 'Kediri Purwoasri', '500000'),
(75, 'Surabaya', 'Jawa Timur', 'Kediri Kandangan', '500000'),
(76, 'Surabaya', 'Jawa Timur', 'Kediri Kepung', '500000'),
(77, 'Surabaya', 'Jawa Timur', 'Kediri Puncu', '500000'),
(78, 'Surabaya', 'Jawa Timur', 'Kediri Ngancar', '500000'),
(79, 'Surabaya', 'Jawa Timur', 'Kediri Plosoklaten', '500000'),
(80, 'Surabaya', 'Jawa Timur', 'Kediri Wates', '500000'),
(81, 'Surabaya', 'Jawa Timur', 'Kediri Ngadiluwih', '500000'),
(82, 'Surabaya', 'Jawa Timur', 'Kediri Kandat', '500000'),
(83, 'Surabaya', 'Jawa Timur', 'Kediri Kras', '500000'),
(84, 'Surabaya', 'Jawa Timur', 'Kediri Ringinrejo', '500000'),
(85, 'Surabaya', 'Jawa Timur', 'Kediri Mojo', '500000'),
(86, 'Surabaya', 'Jawa Timur', 'Kediri Banyakan', '500000'),
(87, 'Surabaya', 'Jawa Timur', 'Kediri Grogol', '500000'),
(88, 'Surabaya', 'Jawa Timur', 'Kediri Semen', '500000'),
(89, 'Surabaya', 'Jawa Timur', 'Kediri Tarokan', '500000'),
(90, 'Surabaya', 'Jawa Timur', 'Malang Bululawang', '500000'),
(91, 'Surabaya', 'Jawa Timur', 'MalangKota', '500000'),
(92, 'Surabaya', 'Jawa Timur', 'Malang Gondanglegi', '500000'),
(93, 'Surabaya', 'Jawa Timur', 'Malang Pagelaran', '500000'),
(94, 'Surabaya', 'Jawa Timur', 'Malang Tajinan', '500000'),
(95, 'Surabaya', 'Jawa Timur', 'Malang Kepanjen', '500000'),
(96, 'Surabaya', 'Jawa Timur', 'Malang Lawang', '500000'),
(97, 'Surabaya', 'Jawa Timur', 'Malang Pakis', '500000'),
(98, 'Surabaya', 'Jawa Timur', 'Malang Singosari', '500000'),
(99, 'Surabaya', 'Jawa Timur', 'Malang Jabung', '500000'),
(100, 'Surabaya', 'Jawa Timur', 'Malang Poncokusumo', '500000'),
(101, 'Surabaya', 'Jawa Timur', 'Malang Tumpang', '500000'),
(102, 'Surabaya', 'Jawa Timur', 'Malang Wajak', '500000'),
(103, 'Surabaya', 'Jawa Timur', 'Malang Ampelgading', '500000'),
(104, 'Surabaya', 'Jawa Timur', 'Malang Dampit', '500000'),
(105, 'Surabaya', 'Jawa Timur', 'Malang Tirto Yudo', '500000'),
(106, 'Surabaya', 'Jawa Timur', 'Malang Turen', '500000'),
(107, 'Surabaya', 'Jawa Timur', 'Malang Bantur', '500000'),
(108, 'Surabaya', 'Jawa Timur', 'Malang Donomulyo', '500000'),
(109, 'Surabaya', 'Jawa Timur', 'Malang Gedangan', '500000'),
(110, 'Surabaya', 'Jawa Timur', 'Malang Pagak', '500000'),
(111, 'Surabaya', 'Jawa Timur', 'Malang Sumbermanjing', '500000'),
(112, 'Surabaya', 'Jawa Timur', 'Malang Kalipare', '500000'),
(113, 'Surabaya', 'Jawa Timur', 'Malang Kromengan', '500000'),
(114, 'Surabaya', 'Jawa Timur', 'Malang Ngajum', '500000'),
(115, 'Surabaya', 'Jawa Timur', 'Malang Pakisaji', '500000'),
(116, 'Surabaya', 'Jawa Timur', 'Malang Sumber Pucung', '500000'),
(117, 'Surabaya', 'Jawa Timur', 'Malang Wonosari', '500000'),
(118, 'Surabaya', 'Jawa Timur', 'Malang Dau', '500000'),
(119, 'Surabaya', 'Jawa Timur', 'Malang Karangploso', '500000'),
(120, 'Surabaya', 'Jawa Timur', 'Malang Kasembon', '500000'),
(121, 'Surabaya', 'Jawa Timur', 'Malang Pujon', '500000'),
(122, 'Surabaya', 'Jawa Timur', 'Malang Ngantang', '500000'),
(123, 'Surabaya', 'Jawa Timur', 'Malang Wagir', '500000'),
(124, 'Surabaya', 'Jawa Timur', 'Lumajang Kota', '500000'),
(125, 'Surabaya', 'Jawa Timur', 'Lumajang Sukodono', '500000'),
(126, 'Surabaya', 'Jawa Timur', 'Lumajang Sumbersuko', '500000'),
(127, 'Surabaya', 'Jawa Timur', 'Lumajang Tekung', '500000'),
(128, 'Surabaya', 'Jawa Timur', 'Lumajang Jatiroto', '500000'),
(129, 'Surabaya', 'Jawa Timur', 'Lumajang Kedungjajang', '500000'),
(130, 'Surabaya', 'Jawa Timur', 'Lumajang Klakah', '500000'),
(131, 'Surabaya', 'Jawa Timur', 'Lumajang Randuagung', '500000'),
(132, 'Surabaya', 'Jawa Timur', 'Lumajang Ranuyoso', '500000'),
(133, 'Surabaya', 'Jawa Timur', 'Lumajang Kunir', '500000'),
(134, 'Surabaya', 'Jawa Timur', 'Lumajang Rowokangkung', '500000'),
(135, 'Surabaya', 'Jawa Timur', 'Lumajang Tempeh', '500000'),
(136, 'Surabaya', 'Jawa Timur', 'Lumajang Yosowilangun', '500000'),
(137, 'Surabaya', 'Jawa Timur', 'Lumajang Candipuro', '500000'),
(138, 'Surabaya', 'Jawa Timur', 'Lumajang Pasirian', '500000'),
(139, 'Surabaya', 'Jawa Timur', 'Lumajang Pronojiwo', '500000'),
(140, 'Surabaya', 'Jawa Timur', 'Lumajang Tempursari', '500000'),
(141, 'Surabaya', 'Jawa Timur', 'Lumajang Pasrujambe', '500000'),
(142, 'Surabaya', 'Jawa Timur', 'Lumajang Senduro', '500000'),
(143, 'Surabaya', 'Jawa Timur', 'Lumajang Gucialit', '500000'),
(144, 'Surabaya', 'Jawa Timur', 'Lumajang Padang', '500000'),
(145, 'Surabaya', 'Jawa Timur', 'Jember Arjasa', '500000'),
(146, 'Surabaya', 'Jawa Timur', 'Jember Kota', '500000'),
(147, 'Surabaya', 'Jawa Timur', 'Jember Jelbuk', '500000'),
(148, 'Surabaya', 'Jawa Timur', 'Jember Kaliwates', '500000'),
(149, 'Surabaya', 'Jawa Timur', 'Jember Panti', '500000'),
(150, 'Surabaya', 'Jawa Timur', 'Jember Patrang', '500000'),
(151, 'Surabaya', 'Jawa Timur', 'Jember Sukorambi', '500000'),
(152, 'Surabaya', 'Jawa Timur', 'Jember Sukowono', '500000'),
(153, 'Surabaya', 'Jawa Timur', 'Jember Kalisat', '500000'),
(154, 'Surabaya', 'Jawa Timur', 'Jember Ledokombo', '500000'),
(155, 'Surabaya', 'Jawa Timur', 'Jember Silo', '500000'),
(156, 'Surabaya', 'Jawa Timur', 'Jember Sumberjambe', '500000'),
(157, 'Surabaya', 'Jawa Timur', 'Jember Ajung', '500000'),
(158, 'Surabaya', 'Jawa Timur', 'Jember Mayang', '500000'),
(159, 'Surabaya', 'Jawa Timur', 'Jember Mumbulsari', '500000'),
(160, 'Surabaya', 'Jawa Timur', 'Jember Pakusari', '500000'),
(161, 'Surabaya', 'Jawa Timur', 'Jember Sumbersari', '500000'),
(162, 'Surabaya', 'Jawa Timur', 'Jember Tempurejo', '500000'),
(163, 'Surabaya', 'Jawa Timur', 'Jember Ambulu', '500000'),
(164, 'Surabaya', 'Jawa Timur', 'Jember Balung', '500000'),
(165, 'Surabaya', 'Jawa Timur', 'Jember Jenggawah', '500000'),
(166, 'Surabaya', 'Jawa Timur', 'Jember Rambipuji', '500000'),
(167, 'Surabaya', 'Jawa Timur', 'Jember Wuluhan', '500000'),
(168, 'Surabaya', 'Jawa Timur', 'Jember bangsalsari', '500000'),
(169, 'Surabaya', 'Jawa Timur', 'Jember Semboro', '500000'),
(170, 'Surabaya', 'Jawa Timur', 'Jember Tanggul', '500000'),
(171, 'Surabaya', 'Jawa Timur', 'Jember Umbulsari', '500000'),
(172, 'Surabaya', 'Jawa Timur', 'Jember Sumber baru', '500000'),
(173, 'Surabaya', 'Jawa Timur', 'Jember Gumuk Mas', '500000'),
(174, 'Surabaya', 'Jawa Timur', 'Jember Jombang', '500000'),
(175, 'Surabaya', 'Jawa Timur', 'Jember Kencong', '500000'),
(176, 'Surabaya', 'Jawa Timur', 'Jember Puger', '500000'),
(177, 'Surabaya', 'Jawa Timur', 'Banyuwangi Kota', '550000'),
(178, 'Surabaya', 'Jawa Timur', 'Banyuwangi Giri', '550000'),
(179, 'Surabaya', 'Jawa Timur', 'Banyuwangi Glagah', '550000'),
(180, 'Surabaya', 'Jawa Timur', 'Banyuwangi Kalipuro', '550000'),
(181, 'Surabaya', 'Jawa Timur', 'Banyuwangi Wongsorejo', '550000'),
(182, 'Surabaya', 'Jawa Timur', 'Banyuwangi Kabat', '550000'),
(183, 'Surabaya', 'Jawa Timur', 'Banyuwangi Rogojampi', '550000'),
(184, 'Surabaya', 'Jawa Timur', 'Banyuwangi Singojuruh', '550000'),
(185, 'Surabaya', 'Jawa Timur', 'Banyuwangi Songgon', '550000'),
(186, 'Surabaya', 'Jawa Timur', 'Banyuwangi Cluring', '550000'),
(187, 'Surabaya', 'Jawa Timur', 'Banyuwangi Muncar', '550000'),
(188, 'Surabaya', 'Jawa Timur', 'Banyuwangi Srono', '550000'),
(189, 'Surabaya', 'Jawa Timur', 'Banyuwangi Tegal Dlimo', '550000'),
(190, 'Surabaya', 'Jawa Timur', 'Banyuwangi Bangorejo', '550000'),
(191, 'Surabaya', 'Jawa Timur', 'Banyuwangi Gambiran', '550000'),
(192, 'Surabaya', 'Jawa Timur', 'Banyuwangi Pasanggrahan', '550000'),
(193, 'Surabaya', 'Jawa Timur', 'Banyuwangi Purwoharjo', '550000'),
(194, 'Surabaya', 'Jawa Timur', 'Banyuwangi Genteng', '550000'),
(195, 'Surabaya', 'Jawa Timur', 'Banyuwangi Glenmore', '550000'),
(196, 'Surabaya', 'Jawa Timur', 'Banyuwangi Kalibaru', '550000'),
(197, 'Surabaya', 'Jawa Timur', 'Banyuwangi Sempu', '550000'),
(198, 'Surabaya', 'Jawa Timur', 'Bondowoso Kota', '500000'),
(199, 'Surabaya', 'Jawa Timur', 'Bondowoso Tenggarang', '500000'),
(200, 'Surabaya', 'Jawa Timur', 'Bondowoso Wonosari', '500000'),
(201, 'Surabaya', 'Jawa Timur', 'Bondowoso Cermee', '500000'),
(202, 'Surabaya', 'Jawa Timur', 'Bondowoso Klabang', '500000'),
(203, 'Surabaya', 'Jawa Timur', 'Bondowoso Prajekan', '500000'),
(204, 'Surabaya', 'Jawa Timur', 'Bondowoso Tapen', '500000'),
(205, 'Surabaya', 'Jawa Timur', 'Bondowoso Pujer', '500000'),
(206, 'Surabaya', 'Jawa Timur', 'Bondowoso Sempol', '500000'),
(207, 'Surabaya', 'Jawa Timur', 'Bondowoso Sukosari', '500000'),
(208, 'Surabaya', 'Jawa Timur', 'Bondowoso Sumberwringin', '500000'),
(209, 'Surabaya', 'Jawa Timur', 'Bondowoso Tlogosari', '500000'),
(210, 'Surabaya', 'Jawa Timur', 'Bondowoso Grujugan', '500000'),
(211, 'Surabaya', 'Jawa Timur', 'Bondowoso Maesan', '500000'),
(212, 'Surabaya', 'Jawa Timur', 'Bondowoso Tamanan', '500000'),
(213, 'Surabaya', 'Jawa Timur', 'Bondowoso Binakal', '500000'),
(214, 'Surabaya', 'Jawa Timur', 'Bondowoso Curahdami', '500000'),
(215, 'Surabaya', 'Jawa Timur', 'Bondowoso Pakem', '500000'),
(216, 'Surabaya', 'Jawa Timur', 'Bondowoso Tegalampel', '500000'),
(217, 'Surabaya', 'Jawa Timur', 'Bondowoso Wringin', '500000'),
(218, 'Surabaya', 'Jawa Timur', 'Situbondo Panji', '500000'),
(219, 'Surabaya', 'Jawa Timur', 'Situbondo Kota', '500000'),
(220, 'Surabaya', 'Jawa Timur', 'Situbondo Arjasa', '500000'),
(221, 'Surabaya', 'Jawa Timur', 'Situbondo Jangkar', '500000'),
(222, 'Surabaya', 'Jawa Timur', 'Situbondo Kapongan', '500000'),
(223, 'Surabaya', 'Jawa Timur', 'Situbondo Mangaran', '500000'),
(224, 'Surabaya', 'Jawa Timur', 'Situbondo Asembagus', '500000'),
(225, 'Surabaya', 'Jawa Timur', 'Situbondo Banyuputih', '500000'),
(226, 'Surabaya', 'Jawa Timur', 'Situbondo Banyuglugur', '500000'),
(227, 'Surabaya', 'Jawa Timur', 'Situbondo Besuki', '500000'),
(228, 'Surabaya', 'Jawa Timur', 'Situbondo Jatibanteng', '500000'),
(229, 'Surabaya', 'Jawa Timur', 'Situbondo Bungatan', '500000'),
(230, 'Surabaya', 'Jawa Timur', 'Situbondo Mlandingan', '500000'),
(231, 'Surabaya', 'Jawa Timur', 'Situbondo Suboh', '500000'),
(232, 'Surabaya', 'Jawa Timur', 'Situbondo Sumbermalang', '500000'),
(233, 'Surabaya', 'Jawa Timur', 'Situbondo Kendit', '500000'),
(234, 'Surabaya', 'Jawa Timur', 'Situbondo Panarukan', '500000'),
(235, 'Surabaya', 'Jawa Timur', 'Probolinggo Bantaran', '500000'),
(236, 'Surabaya', 'Jawa Timur', 'Probolinggo Kota anyar', '500000'),
(237, 'Surabaya', 'Jawa Timur', 'Probolinggo Kuripan', '500000'),
(238, 'Surabaya', 'Jawa Timur', 'Probolinggo Sukapura', '500000'),
(239, 'Surabaya', 'Jawa Timur', 'Probolinggo Sumber', '500000'),
(240, 'Surabaya', 'Jawa Timur', 'Probolinggo Wonomerto', '500000'),
(241, 'Surabaya', 'Jawa Timur', 'Probolinggo Lumbang', '500000'),
(242, 'Surabaya', 'Jawa Timur', 'Probolinggo Sumber Asih', '500000'),
(243, 'Surabaya', 'Jawa Timur', 'Probolinggo Tongas', '500000'),
(244, 'Surabaya', 'Jawa Timur', 'Probolinggo Banyu anyar', '500000'),
(245, 'Surabaya', 'Jawa Timur', 'Probolinggo Leces', '500000'),
(246, 'Surabaya', 'Jawa Timur', 'Probolinggo Tegal siwalan', '500000'),
(247, 'Surabaya', 'Jawa Timur', 'Probolinggo Dringu', '500000'),
(248, 'Surabaya', 'Jawa Timur', 'Probolinggo Gending', '500000'),
(249, 'Surabaya', 'Jawa Timur', 'Probolinggo Krejengan', '500000'),
(250, 'Surabaya', 'Jawa Timur', 'Probolinggo Pajarakan', '500000'),
(251, 'Surabaya', 'Jawa Timur', 'Probolinggo Besuki', '500000'),
(252, 'Surabaya', 'Jawa Timur', 'Probolinggo Gading', '500000'),
(253, 'Surabaya', 'Jawa Timur', 'Probolinggo Kraksaan', '500000'),
(254, 'Surabaya', 'Jawa Timur', 'Probolinggo Kota anyar', '500000'),
(255, 'Surabaya', 'Jawa Timur', 'Probolinggo Paiton', '500000'),
(256, 'Surabaya', 'Jawa Timur', 'Probolinggo Pakuniran', '500000'),
(257, 'Surabaya', 'Jawa Timur', 'Probolinggo Krucil', '500000'),
(258, 'Surabaya', 'Jawa Timur', 'Probolinggo Maros', '500000'),
(259, 'Surabaya', 'Jawa Timur', 'Probolinggo Tiris', '500000'),
(260, 'Surabaya', 'Jawa Timur', 'Pasuruan Kejayan', '400000'),
(261, 'Surabaya', 'Jawa Timur', 'Pasuruan Kota', '400000'),
(262, 'Surabaya', 'Jawa Timur', 'Pasuruan Lumbang', '400000'),
(263, 'Surabaya', 'Jawa Timur', 'Pasuruan Pasrepan', '400000'),
(264, 'Surabaya', 'Jawa Timur', 'Pasuruan Puspo', '400000'),
(265, 'Surabaya', 'Jawa Timur', 'Pasuruan Tosari', '400000'),
(266, 'Surabaya', 'Jawa Timur', 'Pasuruan Tutur', '400000'),
(267, 'Surabaya', 'Jawa Timur', 'Pasuruan Pandaan', '400000'),
(268, 'Surabaya', 'Jawa Timur', 'Pasuruan Purwodadi', '400000'),
(269, 'Surabaya', 'Jawa Timur', 'Pasuruan Purwosari', '400000'),
(270, 'Surabaya', 'Jawa Timur', 'Pasuruan Sukorejo', '400000'),
(271, 'Surabaya', 'Jawa Timur', 'Pasuruan Beji', '400000'),
(272, 'Surabaya', 'Jawa Timur', 'Pasuruan Gempol', '400000'),
(273, 'Surabaya', 'Jawa Timur', 'Pasuruan Prigen', '400000'),
(274, 'Surabaya', 'Jawa Timur', 'Pasuruan Bangil', '400000'),
(275, 'Surabaya', 'Jawa Timur', 'Pasuruan Kraton', '400000'),
(276, 'Surabaya', 'Jawa Timur', 'Pasuruan Rembang', '400000'),
(277, 'Surabaya', 'Jawa Timur', 'Pasuruan Wonorejo', '400000'),
(278, 'Surabaya', 'Jawa Timur', 'Pasuruan Pohjentrek', '400000'),
(279, 'Surabaya', 'Jawa Timur', 'Pasuruan Grati', '400000'),
(280, 'Surabaya', 'Jawa Timur', 'Pasuruan Lekok', '400000'),
(281, 'Surabaya', 'Jawa Timur', 'Pasuruan Nguling', '400000'),
(282, 'Surabaya', 'Jawa Timur', 'Pasuruan Winongan', '400000'),
(283, 'Surabaya', 'Jawa Timur', 'Pasuruan Gondang wetan', '400000'),
(284, 'Surabaya', 'Jawa Timur', 'Pasuruan Rejoso', '400000'),
(285, 'Surabaya', 'Jawa Timur', 'Sidoarjo Candipuro', '300000'),
(286, 'Surabaya', 'Jawa Timur', 'Sidoarjo Kota', '300000'),
(287, 'Surabaya', 'Jawa Timur', 'Sidoarjo Jabon', '300000'),
(288, 'Surabaya', 'Jawa Timur', 'Sidoarjo Krembung', '300000'),
(289, 'Surabaya', 'Jawa Timur', 'Sidoarjo Sorong', '300000'),
(290, 'Surabaya', 'Jawa Timur', 'Sidoarjo Tanggulangin', '300000'),
(291, 'Surabaya', 'Jawa Timur', 'Sidoarjo Sukodono', '300000'),
(292, 'Surabaya', 'Jawa Timur', 'Sidoarjo Wonoayu', '300000'),
(293, 'Surabaya', 'Jawa Timur', 'Sidoarjo Tulangan', '300000'),
(294, 'Surabaya', 'Jawa Timur', 'Sidoarjo Balong Bendo', '300000'),
(295, 'Surabaya', 'Jawa Timur', 'Sidoarjo Krian', '300000'),
(296, 'Surabaya', 'Jawa Timur', 'Sidoarjo Prambon', '300000'),
(297, 'Surabaya', 'Jawa Timur', 'Sidoarjo Tarik', '300000'),
(298, 'Surabaya', 'Jawa Timur', 'Sidoarjo Taman ', '300000'),
(299, 'Surabaya', 'Jawa Timur', 'Sidoarjo Waru', '300000'),
(300, 'Surabaya', 'Jawa Timur', 'Sidoarjo Buduran', '300000'),
(301, 'Surabaya', 'Jawa Timur', 'Sidoarjo Gedangan', '300000'),
(302, 'Surabaya', 'Jawa Timur', 'Sidoarjo Sedati', '300000'),
(303, 'Surabaya', 'Jawa Timur', 'Mojokerto Bangsal ', '400000'),
(304, 'Surabaya', 'Jawa Timur', 'Mojokerto Kota', '400000'),
(305, 'Surabaya', 'Jawa Timur', 'Mojokerto Dlanggu', '400000'),
(306, 'Surabaya', 'Jawa Timur', 'Mojokerto Kutorejo', '400000'),
(307, 'Surabaya', 'Jawa Timur', 'Mojokerto Mojoanyar', '400000'),
(308, 'Surabaya', 'Jawa Timur', 'Mojokerto Mojosari', '400000'),
(309, 'Surabaya', 'Jawa Timur', 'Mojokerto Pungging', '400000'),
(310, 'Surabaya', 'Jawa Timur', 'Mojokerto Ngoro', '400000'),
(311, 'Surabaya', 'Jawa Timur', 'Mojokerto Gondang', '400000'),
(312, 'Surabaya', 'Jawa Timur', 'Mojokerto Jatirejo', '400000'),
(313, 'Surabaya', 'Jawa Timur', 'Mojokerto Pacet', '400000'),
(314, 'Surabaya', 'Jawa Timur', 'Mojokerto Trawas', '400000'),
(315, 'Surabaya', 'Jawa Timur', 'Mojokerto Puri', '400000'),
(316, 'Surabaya', 'Jawa Timur', 'Mojokerto Sooko', '400000'),
(317, 'Surabaya', 'Jawa Timur', 'Mojokerto Trowulan', '400000'),
(318, 'Surabaya', 'Jawa Timur', 'Mojokerto Kremlagi', '400000'),
(319, 'Surabaya', 'Jawa Timur', 'Mojokerto Dawar Blandong', '400000'),
(320, 'Surabaya', 'Jawa Timur', 'Mojokerto Gedek', '400000'),
(321, 'Surabaya', 'Jawa Timur', 'Mojokerto Jetis', '400000'),
(322, 'Surabaya', 'Jawa Timur', 'Jombang Kota', '400000'),
(323, 'Surabaya', 'Jawa Timur', 'Jombang Peterongan', '400000'),
(324, 'Surabaya', 'Jawa Timur', 'Jombang Diwek', '400000'),
(325, 'Surabaya', 'Jawa Timur', 'Jombang Jogo Roto', '400000'),
(326, 'Surabaya', 'Jawa Timur', 'Jombang Sumobito', '400000'),
(327, 'Surabaya', 'Jawa Timur', 'Jombang Bareng', '400000'),
(328, 'Surabaya', 'Jawa Timur', 'Jombang Mojoagung', '400000'),
(329, 'Surabaya', 'Jawa Timur', 'Jombang Mojowarno', '400000'),
(330, 'Surabaya', 'Jawa Timur', 'Jombang Wonosalam', '400000'),
(331, 'Surabaya', 'Jawa Timur', 'Jombang Bandar Kedung Mulyo', '400000'),
(332, 'Surabaya', 'Jawa Timur', 'Jombang Gudo', '400000'),
(333, 'Surabaya', 'Jawa Timur', 'Jombang Ngoro', '400000'),
(334, 'Surabaya', 'Jawa Timur', 'Jombang Perak', '400000'),
(335, 'Surabaya', 'Jawa Timur', 'Jombang Kesamben', '400000'),
(336, 'Surabaya', 'Jawa Timur', 'Jombang Megaluh', '400000'),
(337, 'Surabaya', 'Jawa Timur', 'Jombang Tembelang', '400000'),
(338, 'Surabaya', 'Jawa Timur', 'Jombang Kabuh', '400000'),
(339, 'Surabaya', 'Jawa Timur', 'Jombang Kudu', '400000'),
(340, 'Surabaya', 'Jawa Timur', 'Jombang Ngusikan', '400000'),
(341, 'Surabaya', 'Jawa Timur', 'Jombang Plandaan', '400000'),
(342, 'Surabaya', 'Jawa Timur', 'Jombang Ploso ', '400000'),
(343, 'Surabaya', 'Jawa Timur', 'Nganjuk Bagor', '500000'),
(344, 'Surabaya', 'Jawa Timur', 'Nganjuk Kota', '500000'),
(345, 'Surabaya', 'Jawa Timur', 'Nganjuk Rejoso', '500000'),
(346, 'Surabaya', 'Jawa Timur', 'Nganjuk Wilangan', '500000'),
(347, 'Surabaya', 'Jawa Timur', 'Nganjuk Gondang', '500000'),
(348, 'Surabaya', 'Jawa Timur', 'Nganjuk Jatikalen', '500000'),
(349, 'Surabaya', 'Jawa Timur', 'Nganjuk Lengkong', '500000'),
(350, 'Surabaya', 'Jawa Timur', 'Nganjuk Ngluyu', '500000'),
(351, 'Surabaya', 'Jawa Timur', 'Nganjuk Patianrowo', '500000'),
(352, 'Surabaya', 'Jawa Timur', 'Nganjuk Ngronggot', '500000'),
(353, 'Surabaya', 'Jawa Timur', 'Nganjuk Prambon', '500000'),
(354, 'Surabaya', 'Jawa Timur', 'Nganjuk Baron', '500000'),
(355, 'Surabaya', 'Jawa Timur', 'Nganjuk Kertosono', '500000'),
(356, 'Surabaya', 'Jawa Timur', 'Nganjuk Sukomoro', '500000'),
(357, 'Surabaya', 'Jawa Timur', 'Nganjuk Pace ', '500000'),
(358, 'Surabaya', 'Jawa Timur', 'Nganjuk Tanjunganom', '500000'),
(359, 'Surabaya', 'Jawa Timur', 'Nganjuk Berbek', '500000'),
(360, 'Surabaya', 'Jawa Timur', 'Nganjuk Loceret', '500000'),
(361, 'Surabaya', 'Jawa Timur', 'Nganjuk Ngetos', '500000'),
(362, 'Surabaya', 'Jawa Timur', 'Nganjuk Sawahan', '500000'),
(363, 'Surabaya', 'Jawa Timur', 'Madiun Kota', '500000'),
(364, 'Surabaya', 'Jawa Timur', 'Madiun Jiean', '500000'),
(365, 'Surabaya', 'Jawa Timur', 'Madiun Sawahan', '500000'),
(366, 'Surabaya', 'Jawa Timur', 'Madiun Balerejo', '500000'),
(367, 'Surabaya', 'Jawa Timur', 'Madiun Mejayan', '500000'),
(368, 'Surabaya', 'Jawa Timur', 'Madiun Wonoasri', '500000'),
(369, 'Surabaya', 'Jawa Timur', 'Madiun Gemarang', '500000'),
(370, 'Surabaya', 'Jawa Timur', 'Madiun Pilang kenceng', '500000'),
(371, 'Surabaya', 'Jawa Timur', 'Madiun Saradan', '500000'),
(372, 'Surabaya', 'Jawa Timur', 'Madiun Dagangan', '500000'),
(373, 'Surabaya', 'Jawa Timur', 'Madiun Kare', '500000'),
(374, 'Surabaya', 'Jawa Timur', 'Madiun Wungu', '500000'),
(375, 'Surabaya', 'Jawa Timur', 'Madiun Dolopo', '500000'),
(376, 'Surabaya', 'Jawa Timur', 'Madiun Geger', '500000'),
(377, 'Surabaya', 'Jawa Timur', 'Madiun Kebonsari', '500000'),
(378, 'Surabaya', 'Jawa Timur', 'Magetan Panekan', '550000'),
(379, 'Surabaya', 'Jawa Timur', 'Magetan Plaosan', '550000'),
(380, 'Surabaya', 'Jawa Timur', 'Magetan Poncol', '550000'),
(381, 'Surabaya', 'Jawa Timur', 'Magetan Magetan', '550000'),
(382, 'Surabaya', 'Jawa Timur', 'Magetan Parang', '550000'),
(383, 'Surabaya', 'Jawa Timur', 'Magetan Ngariboyo', '550000'),
(384, 'Surabaya', 'Jawa Timur', 'Magetan Lembeyan', '550000'),
(385, 'Surabaya', 'Jawa Timur', 'Magetan Kawedanan', '550000'),
(386, 'Surabaya', 'Jawa Timur', 'Magetan Takeran', '550000'),
(387, 'Surabaya', 'Jawa Timur', 'Magetan Sukomoro', '550000'),
(388, 'Surabaya', 'Jawa Timur', 'Magetan Bendo', '550000'),
(389, 'Surabaya', 'Jawa Timur', 'Magetan Maospati', '550000'),
(390, 'Surabaya', 'Jawa Timur', 'Magetan Barat', '550000'),
(391, 'Surabaya', 'Jawa Timur', 'Magetan karangrejo', '550000'),
(392, 'Surabaya', 'Jawa Timur', 'Magetan Kartoharjo', '550000'),
(393, 'Surabaya', 'Jawa Timur', 'Magetan Karas', '550000'),
(394, 'Surabaya', 'Jawa Timur', 'Ngawi Kota', '550000'),
(395, 'Surabaya', 'Jawa Timur', 'Ngawi Pitu', '550000'),
(396, 'Surabaya', 'Jawa Timur', 'Ngawi Bringin', '550000'),
(397, 'Surabaya', 'Jawa Timur', 'Ngawi Karangjati', '550000'),
(398, 'Surabaya', 'Jawa Timur', 'Ngawi Kwadungan', '550000'),
(399, 'Surabaya', 'Jawa Timur', 'Ngawi Padas', '550000'),
(400, 'Surabaya', 'Jawa Timur', 'Ngawi Pangkur', '550000'),
(401, 'Surabaya', 'Jawa Timur', 'Ngawi Geneng', '550000'),
(402, 'Surabaya', 'Jawa Timur', 'Ngawi Kendal', '550000'),
(403, 'Surabaya', 'Jawa Timur', 'Ngawi Kedunggalar', '550000'),
(404, 'Surabaya', 'Jawa Timur', 'Ngawi Paron', '550000'),
(405, 'Surabaya', 'Jawa Timur', 'Ngawi Jogorogo', '550000'),
(406, 'Surabaya', 'Jawa Timur', 'Ngawi Ngrambe', '550000'),
(407, 'Surabaya', 'Jawa Timur', 'Ngawi Sine', '550000'),
(408, 'Surabaya', 'Jawa Timur', 'Ngawi Karanganyar', '550000'),
(409, 'Surabaya', 'Jawa Timur', 'Ngawi Mantingan', '550000'),
(410, 'Surabaya', 'Jawa Timur', 'Ngawi Widodaren', '550000'),
(411, 'Surabaya', 'Jawa Timur', 'Bojonegoro Kota', '350000'),
(412, 'Surabaya', 'Jawa Timur', 'Bojonegoro Dander', '350000'),
(413, 'Surabaya', 'Jawa Timur', 'Bojonegoro Kapas', '350000'),
(414, 'Surabaya', 'Jawa Timur', 'Bojonegoro Trucuk', '350000'),
(415, 'Surabaya', 'Jawa Timur', 'Bojonegoro Balen', '350000'),
(416, 'Surabaya', 'Jawa Timur', 'Bojonegoro Kanor', '350000'),
(417, 'Surabaya', 'Jawa Timur', 'Bojonegoro Sukosewu', '350000'),
(418, 'Surabaya', 'Jawa Timur', 'Bojonegoro Sumberejo', '350000'),
(419, 'Surabaya', 'Jawa Timur', 'Bojonegoro Baureno', '350000'),
(420, 'Surabaya', 'Jawa Timur', 'Bojonegoro Kedungadem', '350000'),
(421, 'Surabaya', 'Jawa Timur', 'Bojonegoro Kepoh Baru', '350000'),
(422, 'Surabaya', 'Jawa Timur', 'Bojonegoro Sugihwaras', '350000'),
(423, 'Surabaya', 'Jawa Timur', 'Bojonegoro Bubulan', '350000'),
(424, 'Surabaya', 'Jawa Timur', 'Bojonegoro Gondang', '350000'),
(425, 'Surabaya', 'Jawa Timur', 'Bojonegoro Margomulyo', '350000'),
(426, 'Surabaya', 'Jawa Timur', 'Bojonegoro Ngambon', '350000'),
(427, 'Surabaya', 'Jawa Timur', 'Bojonegoro Ngraho', '350000'),
(428, 'Surabaya', 'Jawa Timur', 'Bojonegoro Sekar', '350000'),
(429, 'Surabaya', 'Jawa Timur', 'Bojonegoro Tambakrejo', '350000'),
(430, 'Surabaya', 'Jawa Timur', 'Bojonegoro Temayang', '350000'),
(431, 'Surabaya', 'Jawa Timur', 'Bojonegoro Kalitidu', '350000'),
(432, 'Surabaya', 'Jawa Timur', 'Bojonegoro Kasiman', '350000'),
(433, 'Surabaya', 'Jawa Timur', 'Bojonegoro Kedewan', '350000'),
(434, 'Surabaya', 'Jawa Timur', 'Bojonegoro Malo', '350000'),
(435, 'Surabaya', 'Jawa Timur', 'Bojonegoro Ngasem', '350000'),
(436, 'Surabaya', 'Jawa Timur', 'Bojonegoro Padangan', '350000'),
(437, 'Surabaya', 'Jawa Timur', 'Bojonegoro Purwosari', '350000'),
(438, 'Surabaya', 'Jawa Timur', 'Tuban Kota', '500000'),
(439, 'Surabaya', 'Jawa Timur', 'Tuban Kerek', '500000'),
(440, 'Surabaya', 'Jawa Timur', 'Tuban Montong', '500000'),
(441, 'Surabaya', 'Jawa Timur', 'Tuban Merakurak', '500000'),
(442, 'Surabaya', 'Jawa Timur', 'Tuban Palang', '500000'),
(443, 'Surabaya', 'Jawa Timur', 'Tuban Widang', '500000'),
(444, 'Surabaya', 'Jawa Timur', 'Tuban Plumpang', '500000'),
(445, 'Surabaya', 'Jawa Timur', 'Tuban Semanding', '500000'),
(446, 'Surabaya', 'Jawa Timur', 'Tuban Rengel', '500000'),
(447, 'Surabaya', 'Jawa Timur', 'Tuban Soko', '500000'),
(448, 'Surabaya', 'Jawa Timur', 'Tuban Bangilan', '500000'),
(449, 'Surabaya', 'Jawa Timur', 'Tuban Kenduruan', '500000'),
(450, 'Surabaya', 'Jawa Timur', 'Tuban Parengan', '500000'),
(451, 'Surabaya', 'Jawa Timur', 'Tuban Senori', '500000'),
(452, 'Surabaya', 'Jawa Timur', 'Tuban Singgahan', '500000'),
(453, 'Surabaya', 'Jawa Timur', 'Tuban Bancar', '500000'),
(454, 'Surabaya', 'Jawa Timur', 'Tuban Jatirogo', '500000'),
(455, 'Surabaya', 'Jawa Timur', 'Tuban Jenu', '500000'),
(456, 'Surabaya', 'Jawa Timur', 'Tuban Tambakboyo', '500000'),
(457, 'Surabaya', 'Jawa Timur', 'Lamongan Glagah', '350000'),
(458, 'Surabaya', 'Jawa Timur', 'Lamongan Deket', '350000'),
(459, 'Surabaya', 'Jawa Timur', 'Lamongan Karangbinangun', '350000'),
(460, 'Surabaya', 'Jawa Timur', 'Lamongan Kota', '350000'),
(461, 'Surabaya', 'Jawa Timur', 'Lamongan Sarirejo', '350000'),
(462, 'Surabaya', 'Jawa Timur', 'Lamongan Tikung', '350000'),
(463, 'Surabaya', 'Jawa Timur', 'Lamongan Bluluk', '350000'),
(464, 'Surabaya', 'Jawa Timur', 'Lamongan Kambangbahu', '350000'),
(465, 'Surabaya', 'Jawa Timur', 'Lamongan Mantup', '350000'),
(466, 'Surabaya', 'Jawa Timur', 'Lamongan Modo', '350000'),
(467, 'Surabaya', 'Jawa Timur', 'Lamongan Ngimbang', '350000'),
(468, 'Surabaya', 'Jawa Timur', 'Lamongan Sambeng', '350000'),
(469, 'Surabaya', 'Jawa Timur', 'Lamongan Sukorame', '350000'),
(470, 'Surabaya', 'Jawa Timur', 'Lamongan Babat', '350000'),
(471, 'Surabaya', 'Jawa Timur', 'Lamongan Kedungpring', '350000'),
(472, 'Surabaya', 'Jawa Timur', 'Lamongan Pucuk', '350000'),
(473, 'Surabaya', 'Jawa Timur', 'Lamongan Sugio', '350000'),
(474, 'Surabaya', 'Jawa Timur', 'Lamongan Kalitengah', '350000'),
(475, 'Surabaya', 'Jawa Timur', 'Lamongan Karang Geneng', '350000'),
(476, 'Surabaya', 'Jawa Timur', 'Lamongan Maduran', '350000'),
(477, 'Surabaya', 'Jawa Timur', 'Lamongan Sekaran', '350000'),
(478, 'Surabaya', 'Jawa Timur', 'Lamongan Sukodadi', '350000'),
(479, 'Surabaya', 'Jawa Timur', 'Lamongan Turi', '350000'),
(480, 'Surabaya', 'Jawa Timur', 'Lamongan Brondong', '350000'),
(481, 'Surabaya', 'Jawa Timur', 'Lamongan Laren', '350000'),
(482, 'Surabaya', 'Jawa Timur', 'Lamongan Paciran', '350000'),
(483, 'Surabaya', 'Jawa Timur', 'Lamongan Solokuro', '350000'),
(484, 'Surabaya', 'Jawa Timur', 'Gresik Kota', '300000'),
(485, 'Surabaya', 'Jawa Timur', 'Gresik Kebomas', '300000'),
(486, 'Surabaya', 'Jawa Timur', 'Gresik Manyar', '300000'),
(487, 'Surabaya', 'Jawa Timur', 'Gresik Bungah', '300000'),
(488, 'Surabaya', 'Jawa Timur', 'Gresik Sidayu', '300000'),
(489, 'Surabaya', 'Jawa Timur', 'Gresik Balong Panggang', '300000'),
(490, 'Surabaya', 'Jawa Timur', 'Gresik Benjeng', '300000'),
(491, 'Surabaya', 'Jawa Timur', 'Gresik Duduk Sampean', '300000'),
(492, 'Surabaya', 'Jawa Timur', 'Gresik Cerme', '300000'),
(493, 'Surabaya', 'Jawa Timur', 'Gresik Kedamean', '300000'),
(494, 'Surabaya', 'Jawa Timur', 'Gresik Menganti', '300000'),
(495, 'Surabaya', 'Jawa Timur', 'Gresik Driyorejo', '300000'),
(496, 'Surabaya', 'Jawa Timur', 'Gresik Wringin Anom', '300000'),
(497, 'Surabaya', 'Jawa Timur', 'Gresik Dukun', '300000'),
(498, 'Surabaya', 'Jawa Timur', 'Gresik Panceng', '300000'),
(499, 'Surabaya', 'Jawa Timur', 'Gresik Ujung Pangkah', '300000'),
(500, 'Surabaya', 'Jawa Timur', 'Gresik Tambak', '300000'),
(501, 'Surabaya', 'Jawa Timur', 'Gresik Sangkapura', '300000'),
(502, 'Surabaya', 'Jawa Timur', 'Bangkalan Kota', '300000'),
(503, 'Surabaya', 'Jawa Timur', 'Bangkalan Kamal', '300000'),
(504, 'Surabaya', 'Jawa Timur', 'Bangkalan Socah', '300000'),
(505, 'Surabaya', 'Jawa Timur', 'Bangkalan Burneh', '300000'),
(506, 'Surabaya', 'Jawa Timur', 'Bangkalan Tragah', '300000'),
(507, 'Surabaya', 'Jawa Timur', 'Bangkalan Kwanyar', '300000'),
(508, 'Surabaya', 'Jawa Timur', 'Bangkalan Labang', '300000'),
(509, 'Surabaya', 'Jawa Timur', 'Bangkalan Tanah Merah', '300000'),
(510, 'Surabaya', 'Jawa Timur', 'Bangkalan Galis', '300000'),
(511, 'Surabaya', 'Jawa Timur', 'Bangkalan Blega', '300000'),
(512, 'Surabaya', 'Jawa Timur', 'Bangkalan Konang', '300000'),
(513, 'Surabaya', 'Jawa Timur', 'Bangkalan Modung', '300000'),
(514, 'Surabaya', 'Jawa Timur', 'Bangkalan Kokop', '300000'),
(515, 'Surabaya', 'Jawa Timur', 'Bangkalan Sepulu', '300000'),
(516, 'Surabaya', 'Jawa Timur', 'Bangkalan Tanjungbumi', '300000'),
(517, 'Surabaya', 'Jawa Timur', 'Bangkalan Arosbaya', '300000'),
(518, 'Surabaya', 'Jawa Timur', 'Bangkalan Geger', '300000'),
(519, 'Surabaya', 'Jawa Timur', 'Bangkalan Klampis', '300000'),
(520, 'Surabaya', 'Jawa Timur', 'Sampang Kota', '350000'),
(521, 'Surabaya', 'Jawa Timur', 'Sampang Torjun', '350000'),
(522, 'Surabaya', 'Jawa Timur', 'Sampang Jrengik', '350000'),
(523, 'Surabaya', 'Jawa Timur', 'Sampang Kedungdung', '350000'),
(524, 'Surabaya', 'Jawa Timur', 'Sampang Sreseh', '350000'),
(525, 'Surabaya', 'Jawa Timur', 'Sampang Tambelangan', '350000'),
(526, 'Surabaya', 'Jawa Timur', 'Sampang Banyuates', '350000'),
(527, 'Surabaya', 'Jawa Timur', 'Sampang Ketapang', '350000'),
(528, 'Surabaya', 'Jawa Timur', 'Sampang Robatal', '350000'),
(529, 'Surabaya', 'Jawa Timur', 'Sampang Sokobanah', '350000'),
(530, 'Surabaya', 'Jawa Timur', 'Sampang Camplong', '350000'),
(531, 'Surabaya', 'Jawa Timur', 'Sampang Omben', '350000'),
(532, 'Surabaya', 'Jawa Timur', 'Pamekasan Kota', '500000'),
(533, 'Surabaya', 'Jawa Timur', 'Pamekasan Tlanakan', '500000'),
(534, 'Surabaya', 'Jawa Timur', 'Pamekasan Palengaan', '500000'),
(535, 'Surabaya', 'Jawa Timur', 'Pamekasan Proppo', '500000'),
(536, 'Surabaya', 'Jawa Timur', 'Pamekasan Galis', '500000'),
(537, 'Surabaya', 'Jawa Timur', 'Pamekasan Larangan', '500000'),
(538, 'Surabaya', 'Jawa Timur', 'Pamekasan Pademawu', '500000'),
(539, 'Surabaya', 'Jawa Timur', 'Pamekasan Kadur', '500000'),
(540, 'Surabaya', 'Jawa Timur', 'Pamekasan Pakong', '500000'),
(541, 'Surabaya', 'Jawa Timur', 'Pamekasan Pegantenan', '500000'),
(542, 'Surabaya', 'Jawa Timur', 'Pamekasan Batu Marmar', '500000'),
(543, 'Surabaya', 'Jawa Timur', 'Pamekasan Pasean', '500000'),
(544, 'Surabaya', 'Jawa Timur', 'Pamekasan Waru', '500000'),
(545, 'Surabaya', 'Jawa Timur', 'Sumenep Kalianget', '550000'),
(546, 'Surabaya', 'Jawa Timur', 'Sumenep Kota Sumenep', '550000'),
(547, 'Surabaya', 'Jawa Timur', 'Sumenep Manding', '550000'),
(548, 'Surabaya', 'Jawa Timur', 'Sumenep Talango', '550000'),
(549, 'Surabaya', 'Jawa Timur', 'Sumenep Bluto', '550000'),
(550, 'Surabaya', 'Jawa Timur', 'Sumenep Gili Genteng', '550000'),
(551, 'Surabaya', 'Jawa Timur', 'Sumenep Lenteng', '550000'),
(552, 'Surabaya', 'Jawa Timur', 'Sumenep Saronggi', '550000'),
(553, 'Surabaya', 'Jawa Timur', 'Sumenep Ganding', '550000'),
(554, 'Surabaya', 'Jawa Timur', 'Sumenep Guluk Guluk', '550000'),
(555, 'Surabaya', 'Jawa Timur', 'Sumenep Pragaan', '550000'),
(556, 'Surabaya', 'Jawa Timur', 'Sumenep Ambunten', '550000'),
(557, 'Surabaya', 'Jawa Timur', 'Sumenep Dasuk', '550000'),
(558, 'Surabaya', 'Jawa Timur', 'Sumenep Pasongsongan', '550000'),
(559, 'Surabaya', 'Jawa Timur', 'Sumenep Rubaru', '550000'),
(560, 'Surabaya', 'Jawa Timur', 'Sumenep Batang Batang', '550000'),
(561, 'Surabaya', 'Jawa Timur', 'Sumenep Batu Putih', '550000'),
(562, 'Surabaya', 'Jawa Timur', 'Sumenep Dungkek', '550000'),
(563, 'Surabaya', 'Jawa Timur', 'Sumenep Gapura', '550000'),
(564, 'Surabaya', 'Jawa Timur', 'Sumenep Nonggunong', '550000'),
(565, 'Surabaya', 'Jawa Timur', 'Sumenep Gayam', '550000'),
(566, 'Surabaya', 'Jawa Timur', 'Sumenep Raas', '550000'),
(567, 'Surabaya', 'Jawa Timur', 'Sumenep Masalembu', '550000'),
(568, 'Surabaya', 'Jawa Timur', 'Sumenep Arjasa', '550000'),
(569, 'Surabaya', 'Jawa Timur', 'Sumenep Sapeken', '550000'),
(570, 'Surabaya', 'Jawa Timur', 'Kota Kediri ', '500000'),
(571, 'Surabaya', 'Jawa Timur', 'Kota Kediri Pesantren', '500000'),
(572, 'Surabaya', 'Jawa Timur', 'Kota Kediri Mojoroto', '500000'),
(573, 'Surabaya', 'Jawa Timur', 'Kota Blitar Sukorejo', '500000'),
(574, 'Surabaya', 'Jawa Timur', 'Kota Blitar', '500000'),
(575, 'Surabaya', 'Jawa Timur', 'Kota Blitar Kepanjen Kidul', '500000'),
(576, 'Surabaya', 'Jawa Timur', 'Kota Blitar Sanan Wetan', '500000'),
(577, 'Surabaya', 'Jawa Timur', 'Kota Malang Kedung Kandang', '400000'),
(578, 'Surabaya', 'Jawa Timur', 'Kota Malang Sukun', '400000'),
(579, 'Surabaya', 'Jawa Timur', 'Kota Malang Klojen', '400000'),
(580, 'Surabaya', 'Jawa Timur', 'Kota Malang Blimbing', '400000'),
(581, 'Surabaya', 'Jawa Timur', 'Kota Malang Lowokwaru', '400000'),
(582, 'Surabaya', 'Jawa Timur', 'Kota Probolinggo Kademangan', '500000'),
(583, 'Surabaya', 'Jawa Timur', 'Kota Probolinggo Wonoasih', '500000'),
(584, 'Surabaya', 'Jawa Timur', 'Kota Probolinggo Mayangan', '500000'),
(585, 'Surabaya', 'Jawa Timur', 'Kota Pasuruan Gadingrejo', '350000'),
(586, 'Surabaya', 'Jawa Timur', 'Kota Pasuruan Purworejo', '350000'),
(587, 'Surabaya', 'Jawa Timur', 'Kota Pasuruan Bugul kidul', '350000'),
(588, 'Surabaya', 'Jawa Timur', 'Kota Mojokerto Prajurit kulon', '400000'),
(589, 'Surabaya', 'Jawa Timur', 'Kota Mojokerto Mojokerto', '400000'),
(590, 'Surabaya', 'Jawa Timur', 'Kota Mojokerto Magersari', '400000'),
(591, 'Surabaya', 'Jawa Timur', 'Kota Madiun Mangu harjo', '500000'),
(592, 'Surabaya', 'Jawa Timur', 'Kota Madiun Taman', '500000'),
(593, 'Surabaya', 'Jawa Timur', 'Kota Madiun Kartoharjo', '500000'),
(594, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Bubutan', '300000'),
(595, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Surabaya', '300000'),
(596, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Genteng', '300000'),
(597, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Gubeng', '300000'),
(598, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Krembangan', '300000'),
(599, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Simokerto', '300000'),
(600, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Tegal Sari', '300000'),
(601, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Bulak', '300000'),
(602, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Kenjeran', '300000'),
(603, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Pabean Cantian', '300000'),
(604, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Semampir', '300000'),
(605, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Tambak sari', '300000'),
(606, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Gunung Anyar', '300000'),
(607, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Mulyorejo', '300000'),
(608, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Rungkut', '300000'),
(609, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Sukolilo', '300000'),
(610, 'Surabaya', 'Jawa Timur', 'Surabaya Tenggilis Mejoyo', '300000'),
(611, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Dukuh Pakis', '300000'),
(612, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Gayungan', '300000'),
(613, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Jambangan', '300000'),
(614, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Sawahan', '300000'),
(615, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Wiyung', '300000'),
(616, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Wonocolo', '300000'),
(617, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Wonokromo', '300000'),
(618, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Asemrowo', '300000'),
(619, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Benowo', '300000'),
(620, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Karang pilang', '300000'),
(621, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Lakar santri', '300000'),
(622, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Pakal', '300000'),
(623, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Sambikerep', '300000'),
(624, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Sukomanunggal', '300000'),
(625, 'Surabaya', 'Jawa Timur', 'Kota Surabaya Tandes', '300000'),
(626, 'Surabaya', 'Jawa Timur', 'Kota Batu', '500000'),
(627, 'Surabaya', 'Jawa Timur', 'Kota Batu Junrejo', '500000'),
(628, 'Surabaya', 'Jawa Timur', 'Kota Batu Bumiaji', '500000'),
(629, 'Surabaya', 'Bali', 'Jembrana Negara', '1900000'),
(630, 'Surabaya', 'Bali', 'Jembrana Kota', '1900000'),
(631, 'Surabaya', 'Bali', 'Jembrana Gilimanuk', '1900000'),
(632, 'Surabaya', 'Bali', 'Jembrana Melaya', '1900000'),
(633, 'Surabaya', 'Bali', 'Jembrana Mendoya', '1900000'),
(634, 'Surabaya', 'Bali', 'Jembrana Perkutatan', '1900000'),
(635, 'Surabaya', 'Bali', 'Tabanan Kota', '1900000'),
(636, 'Surabaya', 'Bali', 'Tabanan Kerambitan', '1900000'),
(637, 'Surabaya', 'Bali', 'Tabanan Pupuan', '1900000'),
(638, 'Surabaya', 'Bali', 'Tabanan Selemadeg', '1900000'),
(639, 'Surabaya', 'Bali', 'Tabanan Baturiti', '1900000'),
(640, 'Surabaya', 'Bali', 'Tabanan Penebel', '1900000'),
(641, 'Surabaya', 'Bali', 'Tabanan Kediri', '1900000'),
(642, 'Surabaya', 'Bali', 'Tabanan Marga', '1900000'),
(643, 'Surabaya', 'Bali', 'Badung Kuta', '1900000'),
(644, 'Surabaya', 'Bali', 'Badung Kota', '1900000'),
(645, 'Surabaya', 'Bali', 'Badung Kuta Utara', '1900000'),
(646, 'Surabaya', 'Bali', 'Badung Mengwi', '1900000'),
(647, 'Surabaya', 'Bali', 'Badung Abiansemal', '1900000'),
(648, 'Surabaya', 'Bali', 'Badung Petang', '1900000'),
(649, 'Surabaya', 'Bali', 'Badung Kuta Selatan', '1900000'),
(650, 'Surabaya', 'Bali', 'Gianyar Kota', '1900000'),
(651, 'Surabaya', 'Bali', 'Gianyar Blahbatuh', '1900000'),
(652, 'Surabaya', 'Bali', 'Gianyar Tampak siring', '1900000'),
(653, 'Surabaya', 'Bali', 'Gianyar Sukawati', '1900000'),
(654, 'Surabaya', 'Bali', 'Gianyar Ubud', '1900000'),
(655, 'Surabaya', 'Bali', 'Gianyar Payangan', '1900000'),
(656, 'Surabaya', 'Bali', 'Gianyar Tegal Lalang', '1900000'),
(657, 'Surabaya', 'Bali', 'Gianyar Batu bulan', '1900000'),
(658, 'Surabaya', 'Bali', 'Klungkang Klungkang', '2000000'),
(659, 'Surabaya', 'Bali', 'Klungkang Banjarangkan', '2000000'),
(660, 'Surabaya', 'Bali', 'Klungkang Dawan', '2000000'),
(661, 'Surabaya', 'Bali', 'Klungkang Nusa Penida', '1850000'),
(662, 'Surabaya', 'Bali', 'Nusa Dua', '1900000'),
(663, 'Surabaya', 'Bali', 'Bangli Tembuku', '1850000'),
(664, 'Surabaya', 'Bali', 'Bangli Kota', '1850000'),
(665, 'Surabaya', 'Bali', 'Bangli Susut', '1850000'),
(666, 'Surabaya', 'Bali', 'Bangli Kintamani', '1850000'),
(667, 'Surabaya', 'Bali', 'Karangasem Kota', '2000000'),
(668, 'Surabaya', 'Bali', 'Karangasem Bebandem', '2000000'),
(669, 'Surabaya', 'Bali', 'Karangasem Manggis', '2000000'),
(670, 'Surabaya', 'Bali', 'Karangasem Rendang', '2000000'),
(671, 'Surabaya', 'Bali', 'Karangasem Selat', '2000000'),
(672, 'Surabaya', 'Bali', 'Karangasem Sidemen', '2000000'),
(673, 'Surabaya', 'Bali', 'Karangasem Abang', '2000000'),
(674, 'Surabaya', 'Bali', 'Karangasem Kubu', '2000000'),
(675, 'Surabaya', 'Bali', 'Buleleng Kota', '2000000'),
(676, 'Surabaya', 'Bali', 'Buleleng Sukasada', '1950000'),
(677, 'Surabaya', 'Bali', 'Buleleng Sawan', '1950000'),
(678, 'Surabaya', 'Bali', 'Buleleng Tejakula', '1950000'),
(679, 'Surabaya', 'Bali', 'Buleleng Kubutambahan', '1950000'),
(680, 'Surabaya', 'Bali', 'Buleleng Banjarangkan', '1950000'),
(681, 'Surabaya', 'Bali', 'Buleleng Seririt', '1950000'),
(682, 'Surabaya', 'Bali', 'Buleleng Busung Biu', '1950000'),
(683, 'Surabaya', 'Bali', 'Buleleng Gerokgak', '1950000'),
(684, 'Surabaya', 'Bali', 'Kota Denpasar Barat', '1950000'),
(685, 'Surabaya', 'Bali', 'Kota Denpasar Timur', '1950000'),
(686, 'Surabaya', 'Bali', 'Denpasar Slt', '1950000'),
(687, 'Surabaya', 'Bali', 'Sanur', '1950000'),
(688, 'Surabaya', 'N T B', 'Lombok Barat Lombok Barat', '2850000'),
(689, 'Surabaya', 'N T B', 'Lombok Barat Gerung', '2850000'),
(690, 'Surabaya', 'N T B', 'Lombok Barat Mangsit', '2850000'),
(691, 'Surabaya', 'N T B', 'Lombok Barat Sekotong Tengah', '2950000'),
(692, 'Surabaya', 'N T B', 'Lombok Barat Lembar', '2800000'),
(693, 'Surabaya', 'N T B', 'Lombok Barat Kuripan', '2800000'),
(694, 'Surabaya', 'N T B', 'Lombok Barat Labu api', '2800000'),
(695, 'Surabaya', 'N T B', 'Lombok Barat Kediri', '2800000'),
(696, 'Surabaya', 'N T B', 'Lombok Barat Lingsar', '2800000'),
(697, 'Surabaya', 'N T B', 'Lombok Barat Narmada', '2950000'),
(698, 'Surabaya', 'N T B', 'Lombok Barat Batu Layar', '2800000'),
(699, 'Surabaya', 'N T B', 'Lombok Barat Gunung Sari', '2800000'),
(700, 'Surabaya', 'N T B', 'Lombok Barat Pemenang', '2950000'),
(701, 'Surabaya', 'N T B', 'Lombok Barat Tanjung', '3200000'),
(702, 'Surabaya', 'N T B', 'Lombok Barat Bayan', '3100000'),
(703, 'Surabaya', 'N T B', 'Lombok Barat Gangga', '3100000'),
(704, 'Surabaya', 'N T B', 'Lombok Barat Kayangan', '3100000'),
(705, 'Surabaya', 'N T B', 'Lombok Tengah Praya', '3050000'),
(706, 'Surabaya', 'N T B', 'Lombok Tengah Praya Tengah', '3150000'),
(707, 'Surabaya', 'N T B', 'Lombok Tengah Kuta Mataram', '3150000'),
(708, 'Surabaya', 'N T B', 'Lombok Tengah Janapria', '3150000'),
(709, 'Surabaya', 'N T B', 'Lombok Tengah Kopang', '3150000'),
(710, 'Surabaya', 'N T B', 'Lombok Tengah Praya Timur', '3150000'),
(711, 'Surabaya', 'N T B', 'Lombok Tengah Pujut', '3150000'),
(712, 'Surabaya', 'N T B', 'Lombok Tengah Praya Barat', '3150000'),
(713, 'Surabaya', 'N T B', 'Lombok Tengah Praya Brt Daya', '3150000'),
(714, 'Surabaya', 'N T B', 'Lombok Tengah Jonggat', '3150000'),
(715, 'Surabaya', 'N T B', 'Lombok Tengah Pringgarata', '3150000'),
(716, 'Surabaya', 'N T B', 'Lombok Tengah Batukliang', '3150000'),
(717, 'Surabaya', 'N T B', 'Lombok Tengah Batukliang Utr', '3150000'),
(718, 'Surabaya', 'N T B', 'Lombok Timur Selong', '3100000'),
(719, 'Surabaya', 'N T B', 'Lombok Timur Sukamulia', '3100000'),
(720, 'Surabaya', 'N T B', 'Lombok Timur Suralaga', '3100000'),
(721, 'Surabaya', 'N T B', 'Lombok Timur Labuhan Haji', '3100000'),
(722, 'Surabaya', 'N T B', 'Lombok Timur Jerowaru', '3100000'),
(723, 'Surabaya', 'N T B', 'Lombok Timur Keruak', '3100000'),
(724, 'Surabaya', 'N T B', 'Lombok Timur Sakra Timur', '3100000'),
(725, 'Surabaya', 'N T B', 'Lombok Timur Sakra Barat', '3100000'),
(726, 'Surabaya', 'N T B', 'Lombok Timur Sakra', '3100000'),
(727, 'Surabaya', 'N T B', 'Lombok Timur Terara', '3100000'),
(728, 'Surabaya', 'N T B', 'Lombok Timur Montong Gading', '3100000'),
(729, 'Surabaya', 'N T B', 'Lombok Timur Mas Bagig', '3100000'),
(730, 'Surabaya', 'N T B', 'Lombok Timur Sikur', '3100000'),
(731, 'Surabaya', 'N T B', 'Lombok Timur Pringgasela', '3100000'),
(732, 'Surabaya', 'N T B', 'Lombok Timur Aikmel', '3100000'),
(733, 'Surabaya', 'N T B', 'Lombok Timur Wanasaba', '3100000'),
(734, 'Surabaya', 'N T B', 'Lombok Timur Pringgabaya', '3100000'),
(735, 'Surabaya', 'N T B', 'Lombok Timur Sembalun', '3100000'),
(736, 'Surabaya', 'N T B', 'Lombok Timur Sambelia', '3600000'),
(737, 'Surabaya', 'N T B', 'Lombok Timur Suela', '3100000'),
(738, 'Surabaya', 'N T B', 'Sumbawa Sumbawa', '3600000'),
(739, 'Surabaya', 'N T B', 'Sumbawa Sumbawa Besar', '3600000'),
(740, 'Surabaya', 'N T B', 'Sumbawa Lape Lopok', '3600000'),
(741, 'Surabaya', 'N T B', 'Sumbawa Moyohulu', '3600000'),
(742, 'Surabaya', 'N T B', 'Sumbawa Moyohilir', '6100000'),
(743, 'Surabaya', 'N T B', 'Sumbawa Labangka', '3650000'),
(744, 'Surabaya', 'N T B', 'Sumbawa Plampang', '3650000'),
(745, 'Surabaya', 'N T B', 'Sumbawa Empang', '6400000'),
(746, 'Surabaya', 'N T B', 'Sumbawa Batu Lanteh', '3650000'),
(747, 'Surabaya', 'N T B', 'Sumbawa Lunyuk', '3650000'),
(748, 'Surabaya', 'N T B', 'Sumbawa Ropang', '3650000'),
(749, 'Surabaya', 'N T B', 'Sumbawa Labuhan Badas', '3650000'),
(750, 'Surabaya', 'N T B', 'Sumbawa Alas', '6400000'),
(751, 'Surabaya', 'N T B', 'Sumbawa Alas Barat', '3650000'),
(752, 'Surabaya', 'N T B', 'Sumbawa Utan Rhee', '3650000'),
(753, 'Surabaya', 'N T B', 'Dompu Kota', '3150000'),
(754, 'Surabaya', 'N T B', 'Dompu Pajo', '3150000'),
(755, 'Surabaya', 'N T B', 'Dompu Hu''u', '3150000'),
(756, 'Surabaya', 'N T B', 'Dompu Kilo', '3150000'),
(757, 'Surabaya', 'N T B', 'Dompu Woja', '3150000'),
(758, 'Surabaya', 'N T B', 'Dompu Manggelewa', '3150000'),
(759, 'Surabaya', 'N T B', 'Dompu Kempo', '3150000'),
(760, 'Surabaya', 'N T B', 'Dompu Pekat', '3150000'),
(761, 'Surabaya', 'N T B', 'Bima Mada Pangga', '3700000'),
(762, 'Surabaya', 'N T B', 'Bima Kota', '3700000'),
(763, 'Surabaya', 'N T B', 'Bima Donggo', '3700000'),
(764, 'Surabaya', 'N T B', 'Bima Bolo', '3700000'),
(765, 'Surabaya', 'N T B', 'Bima Tambora', '3700000'),
(766, 'Surabaya', 'N T B', 'Bima Sanggar', '3700000'),
(767, 'Surabaya', 'N T B', 'Bima Woha', '3700000'),
(768, 'Surabaya', 'N T B', 'Bima Monta', '3700000'),
(769, 'Surabaya', 'N T B', 'Bima Wawo', '3700000'),
(770, 'Surabaya', 'N T B', 'Bima Belo', '3700000'),
(771, 'Surabaya', 'N T B', 'Bima Langgudu', '3700000'),
(772, 'Surabaya', 'N T B', 'Bima Ambalawi', '3700000'),
(773, 'Surabaya', 'N T B', 'Bima Lambu', '3750000'),
(774, 'Surabaya', 'N T B', 'Bima Sape', '3750000'),
(775, 'Surabaya', 'N T B', 'Bima Wera', '3750000'),
(776, 'Surabaya', 'N T B', 'Sumbawa Barat Seteluk', '3400000'),
(777, 'Surabaya', 'N T B', 'Sumbawa Barat Brang Rea', '3400000'),
(778, 'Surabaya', 'N T B', 'Sumbawa Barat Taliwang', '3400000'),
(779, 'Surabaya', 'N T B', 'Sumbawa Barat Jereweh', '3400000'),
(780, 'Surabaya', 'N T B', 'Sumbawa Barat Sekongkang', '3400000'),
(781, 'Surabaya', 'N T B', 'Kota Mataram ', '2750000'),
(782, 'Surabaya', 'N T B', 'Kota Mataram Cakranegara', '2750000'),
(783, 'Surabaya', 'N T B', 'Kota Mataram Ampenan', '2750000'),
(784, 'Surabaya', 'N T B', 'Kota Bima Asakota', '3700000'),
(785, 'Surabaya', 'N T B', 'Kota Bima Rasanae Barat', '3700000'),
(786, 'Surabaya', 'N T B', 'Kota Bima Rasanae Timur', '3700000'),
(787, 'Surabaya', 'N T T', 'Sumba Barat Lamboya', '9150000'),
(788, 'Surabaya', 'N T T', 'Sumba Barat Kota Waikabubak', '9150000'),
(789, 'Surabaya', 'N T T', 'Sumba Barat Loli', '9150000'),
(790, 'Surabaya', 'N T T', 'Sumba Barat Wanokaka', '9150000'),
(791, 'Surabaya', 'N T T', 'Sumba Barat Wewewa Barat', '9150000'),
(792, 'Surabaya', 'N T T', 'Sumba Barat Wewewa Selatan', '9150000'),
(793, 'Surabaya', 'N T T', 'Sumba Barat Wewewa Timur', '9150000'),
(794, 'Surabaya', 'N T T', 'Sumba Barat Kodi', '9150000'),
(795, 'Surabaya', 'N T T', 'Sumba Barat Kodi Bangedo', '9150000'),
(796, 'Surabaya', 'N T T', 'Sumba Barat Wewewa Utara', '9150000'),
(797, 'Surabaya', 'N T T', 'Sumba Barat Laura', '9150000'),
(798, 'Surabaya', 'N T T', 'Sumba Barat Mamboro', '9150000'),
(799, 'Surabaya', 'N T T', 'Sumba Barat Tana Righu', '9150000'),
(800, 'Surabaya', 'N T T', 'Sumba Barat Katikutana', '9150000'),
(801, 'Surabaya', 'N T T', 'Sumba Barat Umbu Ratu Nggay', '9150000'),
(802, 'Surabaya', 'N T T', 'Sumba Timur Kota Waingapu', '9150000'),
(803, 'Surabaya', 'N T T', 'Sumba Timur Haharu', '9150000'),
(804, 'Surabaya', 'N T T', 'Sumba Timur Lewa', '9150000'),
(805, 'Surabaya', 'N T T', 'Sumba Timur Nggaha Oriangu', '9150000'),
(806, 'Surabaya', 'N T T', 'Sumba Timur Tabundung', '9150000'),
(807, 'Surabaya', 'N T T', 'Sumba Timur Pandawai', '9150000'),
(808, 'Surabaya', 'N T T', 'Sumba Timur Matawai La Pawu', '9150000'),
(809, 'Surabaya', 'N T T', 'Sumba Timur Paberiwai', '9150000'),
(810, 'Surabaya', 'N T T', 'Sumba Timur Karepa', '9150000'),
(811, 'Surabaya', 'N T T', 'Sumba Timur Pinupahar', '9150000'),
(812, 'Surabaya', 'N T T', 'Sumba Timur Pahunga Lodu', '9150000'),
(813, 'Surabaya', 'N T T', 'Sumba Timur Rindi', '9150000'),
(814, 'Surabaya', 'N T T', 'Sumba Timur Umalulu', '9150000'),
(815, 'Surabaya', 'N T T', 'Sumba Timur Wula Waijelu', '9150000'),
(816, 'Surabaya', 'N T T', 'Sumba Timur Kahaungu Eti', '9150000'),
(817, 'Surabaya', 'N T T', 'Kupang Tengah', '8850000'),
(818, 'Surabaya', 'N T T', 'Kupang Timur', '8850000'),
(819, 'Surabaya', 'N T T', 'Kupang Amarasi', '8850000');
INSERT INTO `master_rute` (`id_rute`, `asal`, `tujuan_provinsi`, `tujuan`, `biaya`) VALUES
(820, 'Surabaya', 'N T T', 'Kupang Amarasi Barat', '8850000'),
(821, 'Surabaya', 'N T T', 'Kupang Amarasi Selatan', '8850000'),
(822, 'Surabaya', 'N T T', 'Kupang Amarasi Timur', '8850000'),
(823, 'Surabaya', 'N T T', 'Kupang Barat', '8850000'),
(824, 'Surabaya', 'N T T', 'Kupang Nekemese', '8850000'),
(825, 'Surabaya', 'N T T', 'Kupang Semau', '8850000'),
(826, 'Surabaya', 'N T T', 'Kupang Amabi Oefeto Timur', '8850000'),
(827, 'Surabaya', 'N T T', 'Kupang Fatuleu', '8850000'),
(828, 'Surabaya', 'N T T', 'Kupang Sulamu', '8850000'),
(829, 'Surabaya', 'N T T', 'Kupang Amfoang Barat Laut', '8850000'),
(830, 'Surabaya', 'N T T', 'Kupang Amfoang Selatan', '8850000'),
(831, 'Surabaya', 'N T T', 'Kupang Amfoang Barat Daya', '8850000'),
(832, 'Surabaya', 'N T T', 'Kupang Amfoang Utara', '8850000'),
(833, 'Surabaya', 'N T T', 'Kupang Takari', '8850000'),
(834, 'Surabaya', 'N T T', 'Kupang Hawu Mehara', '9750000'),
(835, 'Surabaya', 'N T T', 'Kupang Sabu Liae', '9750000'),
(836, 'Surabaya', 'N T T', 'Kupang Raijua', '9750000'),
(837, 'Surabaya', 'N T T', 'Kupang Sabu Timur', '9750000'),
(838, 'Surabaya', 'N T T', 'Kupang Sabu Barat', '9750000'),
(839, 'Surabaya', 'N T T', 'TIMTENGSEL Mollo Slt', '10900000'),
(840, 'Surabaya', 'N T T', 'TIMTENGSEL MolloUtr', '10900000'),
(841, 'Surabaya', 'N T T', 'TIMTENGSEL Fatumnasi', '10900000'),
(842, 'Surabaya', 'N T T', 'TIMTENGSEL Amanuban Brt', '10900000'),
(843, 'Surabaya', 'N T T', 'TIMTENGSEL Batu Putih', '10900000'),
(844, 'Surabaya', 'N T T', 'TIMTENGSEL Kota Soe', '10900000'),
(845, 'Surabaya', 'N T T', 'TIMTENGSEL Amanuban Slt', '10900000'),
(846, 'Surabaya', 'N T T', 'Timor Tengah Selatan Kalbano', '10900000'),
(847, 'Surabaya', 'N T T', 'Timor Tengah Selatan Kualin', '10900000'),
(848, 'Surabaya', 'N T T', 'TIMTENGSEL Kuan Fatu', '10900000'),
(849, 'Surabaya', 'N T T', 'TIMTENGSEL Amanatun Slt', '10900000'),
(850, 'Surabaya', 'N T T', 'Timor Tengah Selatan Boking', '10900000'),
(851, 'Surabaya', 'N T T', 'Timor Tengah Selatan Kie', '10900000'),
(852, 'Surabaya', 'N T T', 'Timor Tengah Selatan Kotolin', '10900000'),
(853, 'Surabaya', 'N T T', 'Timor Tengah Selatan Tionas', '10900000'),
(854, 'Surabaya', 'N T T', 'Timor Tengah Selatan Nunkolo', '10900000'),
(855, 'Surabaya', 'N T T', 'TIMTENGSEL Amanatun Utr', '10900000'),
(856, 'Surabaya', 'N T T', 'TIMTENGSEL Amanuban Tmr', '10900000'),
(857, 'Surabaya', 'N T T', 'TIMTENGSEL Amanuban Tengah', '10900000'),
(858, 'Surabaya', 'N T T', 'Timor Tengah Selatan Oenino', '10900000'),
(859, 'Surabaya', 'N T T', 'Timor Tengah Selatan Polen', '10900000'),
(860, 'Surabaya', 'N T T', 'TIMTENG Utr Kota Kefamenanu', '10300000'),
(861, 'Surabaya', 'N T T', 'TIMTENG Utr Miomafo Tmr', '11750000'),
(862, 'Surabaya', 'N T T', 'TIMTENG Utr Miomafo Brt', '11750000'),
(863, 'Surabaya', 'N T T', 'Timor Tengah Utara Noemuti', '11750000'),
(864, 'Surabaya', 'N T T', 'Timor Tengah Utara Insana', '11750000'),
(865, 'Surabaya', 'N T T', 'TIMTENG Utr Insana Utr', '11750000'),
(866, 'Surabaya', 'N T T', 'TIMTENG Utr Biboku Anleu', '11750000'),
(867, 'Surabaya', 'N T T', 'TIMTENG Utr Biboki Slt', '11750000'),
(868, 'Surabaya', 'N T T', 'TIMTENG Utr Biboki Utr', '11750000'),
(869, 'Surabaya', 'N T T', 'Timor Tengah Utara Kalabahi', '11750000'),
(870, 'Surabaya', 'N T T', 'Belu Atambua', '11750000'),
(871, 'Surabaya', 'N T T', 'Belu Tasifeto Barat', '11750000'),
(872, 'Surabaya', 'N T T', 'Belu Kakuluk Mesak', '11750000'),
(873, 'Surabaya', 'N T T', 'Belu Lamakmen', '11750000'),
(874, 'Surabaya', 'N T T', 'Belu Raihat', '11750000'),
(875, 'Surabaya', 'N T T', 'Belu Tasifeto Timur', '11750000'),
(876, 'Surabaya', 'N T T', 'Belu Kobalima', '11750000'),
(877, 'Surabaya', 'N T T', 'Belu Malaka Tengah', '11750000'),
(878, 'Surabaya', 'N T T', 'Belu Malaka Timur', '11750000'),
(879, 'Surabaya', 'N T T', 'Belu Sasita Mean', '11750000'),
(880, 'Surabaya', 'N T T', 'Belu Malaka Barat', '11750000'),
(881, 'Surabaya', 'N T T', 'Belu Rinhat', '11750000'),
(882, 'Surabaya', 'N T T', 'AlorBarat Laut', '13000000'),
(883, 'Surabaya', 'N T T', 'Alor Teluk Mutiara', '13000000'),
(884, 'Surabaya', 'N T T', 'AlorBarat Daya', '13000000'),
(885, 'Surabaya', 'N T T', 'Alor Selatan', '13000000'),
(886, 'Surabaya', 'N T T', 'Alor Tengah Utara', '13000000'),
(887, 'Surabaya', 'N T T', 'Alor Timur', '13000000'),
(888, 'Surabaya', 'N T T', 'Alor Timur Laut', '13000000'),
(889, 'Surabaya', 'N T T', 'Alor Pantar', '13000000'),
(890, 'Surabaya', 'N T T', 'Alor Pantar Barat', '13000000'),
(891, 'Surabaya', 'N T T', 'Lembata Ile Ape', '11950000'),
(892, 'Surabaya', 'N T T', 'Lembata Nubatukan', '11950000'),
(893, 'Surabaya', 'N T T', 'Lembata Atadei', '11950000'),
(894, 'Surabaya', 'N T T', 'Lembata Lebatukan', '11950000'),
(895, 'Surabaya', 'N T T', 'Lembata Nagawutung', '11950000'),
(896, 'Surabaya', 'N T T', 'Lembata Wulandoni', '11950000'),
(897, 'Surabaya', 'N T T', 'Lembata Buyasari', '11950000'),
(898, 'Surabaya', 'N T T', 'Lembata Omesuri', '11950000'),
(899, 'Surabaya', 'N T T', 'Flores Timur Ile Mandiri', '11100000'),
(900, 'Surabaya', 'N T T', 'Flores Timur Larantuka', '11100000'),
(901, 'Surabaya', 'N T T', 'Flores Timur Tanjung Bunga', '11100000'),
(902, 'Surabaya', 'N T T', 'Flores Timur Titehena', '11100000'),
(903, 'Surabaya', 'N T T', 'Flores Timur Wulanggitang', '11100000'),
(904, 'Surabaya', 'N T T', 'Flores Timur Adonara Timur', '11100000'),
(905, 'Surabaya', 'N T T', 'Flores Timur Ile Boleng', '11100000'),
(906, 'Surabaya', 'N T T', 'Flores Timur Kelubagolit', '11100000'),
(907, 'Surabaya', 'N T T', 'Flores Timur Witihama', '11100000'),
(908, 'Surabaya', 'N T T', 'Flores Timur Adonara Barat', '11100000'),
(909, 'Surabaya', 'N T T', 'Flores Timur Wotan Ulu Mado', '11100000'),
(910, 'Surabaya', 'N T T', 'Flores Timur Solor Barat', '11100000'),
(911, 'Surabaya', 'N T T', 'Flores Timur Solor Timur', '11100000'),
(912, 'Surabaya', 'N T T', 'Sikka Kewapante', '11100000'),
(913, 'Surabaya', 'N T T', 'Sikka Lela', '11100000'),
(914, 'Surabaya', 'N T T', 'Sikka Maumere', '11100000'),
(915, 'Surabaya', 'N T T', 'Sikka Mego', '11100000'),
(916, 'Surabaya', 'N T T', 'Sikka Nitta', '11100000'),
(917, 'Surabaya', 'N T T', 'Sikka Paga', '11100000'),
(918, 'Surabaya', 'N T T', 'Sikka Palue', '11100000'),
(919, 'Surabaya', 'N T T', 'Sikka Alok', '11100000'),
(920, 'Surabaya', 'N T T', 'Sikka Bola', '11100000'),
(921, 'Surabaya', 'N T T', 'Sikka Talibura', '11100000'),
(922, 'Surabaya', 'N T T', 'Sikka Waigete', '11100000'),
(923, 'Surabaya', 'N T T', 'Ende Kota', '11100000'),
(924, 'Surabaya', 'N T T', 'Ende Ende Selatan', '11100000'),
(925, 'Surabaya', 'N T T', 'Ende Pulau Ende', '11100000'),
(926, 'Surabaya', 'N T T', 'Ende Nanga Panda', '11100000'),
(927, 'Surabaya', 'N T T', 'Ende Ndona', '11100000'),
(928, 'Surabaya', 'N T T', 'Ende Ndona Timur', '11100000'),
(929, 'Surabaya', 'N T T', 'Ende Detusoko', '11100000'),
(930, 'Surabaya', 'N T T', 'Ende Kelimutu', '11100000'),
(931, 'Surabaya', 'N T T', 'Ende Wolo Waru', '11100000'),
(932, 'Surabaya', 'N T T', 'Ende Wolo Jita', '11100000'),
(933, 'Surabaya', 'N T T', 'Ende Lio Timur', '11100000'),
(934, 'Surabaya', 'N T T', 'Ende Detukeli', '11100000'),
(935, 'Surabaya', 'N T T', 'Ende Kotabaru', '11100000'),
(936, 'Surabaya', 'N T T', 'Ende Maukaro', '11100000'),
(937, 'Surabaya', 'N T T', 'Ende Magekoba Maurole', '11100000'),
(938, 'Surabaya', 'N T T', 'Ende Wewaria', '11100000'),
(939, 'Surabaya', 'N T T', 'Ngada Aimere', '12100000'),
(940, 'Surabaya', 'N T T', 'Ngada Bajawa', '12100000'),
(941, 'Surabaya', 'N T T', 'Ngada Jere buu', '12100000'),
(942, 'Surabaya', 'N T T', 'NgadaBawa', '12100000'),
(943, 'Surabaya', 'N T T', 'Ngada Wogomang Ulewa', '12100000'),
(944, 'Surabaya', 'N T T', 'Ngada Boawae', '12100000'),
(945, 'Surabaya', 'N T T', 'Ngada Soa', '12100000'),
(946, 'Surabaya', 'N T T', 'Ngada Keo Tengah', '12100000'),
(947, 'Surabaya', 'N T T', 'Ngada Maupongo', '12100000'),
(948, 'Surabaya', 'N T T', 'Ngada Nangaroro', '12100000'),
(949, 'Surabaya', 'N T T', 'Ngada Aesesa', '12100000'),
(950, 'Surabaya', 'N T T', 'Ngada Riung', '12100000'),
(951, 'Surabaya', 'N T T', 'Ngada Riung Barat', '12100000'),
(952, 'Surabaya', 'N T T', 'Ngada Wolowae', '12100000'),
(953, 'Surabaya', 'N T T', 'Manggarai Ruteng', '8650000'),
(954, 'Surabaya', 'N T T', 'Manggarai Wae RII', '8650000'),
(955, 'Surabaya', 'N T T', 'Manggarai Cibal', '8650000'),
(956, 'Surabaya', 'N T T', 'Manggarai Lambaleda', '8650000'),
(957, 'Surabaya', 'N T T', 'Manggarai Reo', '8650000'),
(958, 'Surabaya', 'N T T', 'Manggarai Langke Rembong', '8650000'),
(959, 'Surabaya', 'N T T', 'Manggarai Satarmese', '8650000'),
(960, 'Surabaya', 'N T T', 'Manggarai Mborong', '8650000'),
(961, 'Surabaya', 'N T T', 'Manggarai Ponco Ranaka', '8650000'),
(962, 'Surabaya', 'N T T', 'Manggarai Elar', '8650000'),
(963, 'Surabaya', 'N T T', 'Manggarai Kota Komba', '8650000'),
(964, 'Surabaya', 'N T T', 'Manggarai Sambi Rambas', '8650000'),
(965, 'Surabaya', 'N T T', 'Rote Ndao Rote Barat Laut', '9150000'),
(966, 'Surabaya', 'N T T', 'Rote Ndao Lobalain', '9150000'),
(967, 'Surabaya', 'N T T', 'Rote Ndao Rote Barat Daya', '9150000'),
(968, 'Surabaya', 'N T T', 'Rote Ndao Pantai Baru', '9150000'),
(969, 'Surabaya', 'N T T', 'Rote Ndao Rote Tengah', '9150000'),
(970, 'Surabaya', 'N T T', 'Rote Ndao Rote Timur', '9150000'),
(971, 'Surabaya', 'N T T', 'Manggarai Barat Komodo', '8650000'),
(972, 'Surabaya', 'N T T', 'Manggarai Barat Sanonggoang', '8650000'),
(973, 'Surabaya', 'N T T', 'Manggarai Barat Kuwus', '8650000'),
(974, 'Surabaya', 'N T T', 'Manggarai Barat Macang Pacar', '8650000'),
(975, 'Surabaya', 'N T T', 'Manggarai Barat Lembor', '8650000'),
(976, 'Surabaya', 'N T T', 'Kota Kupang Kelapa Lima', '8100000'),
(977, 'Surabaya', 'N T T', 'Kota Kupang Oebobo', '8100000'),
(978, 'Surabaya', 'N T T', 'Kota Kupang Alak', '8100000'),
(979, 'Surabaya', 'N T T', 'Kota Kupang Maulafa', '8100000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_satuan`
--

CREATE TABLE IF NOT EXISTS `master_satuan` (
`id_satuan` int(11) NOT NULL,
  `kode_satuan` varchar(50) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL,
  `konversi` varchar(255) DEFAULT NULL,
  `satuan_utama` varchar(255) DEFAULT NULL,
  `tipe_satuan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `master_satuan`
--

INSERT INTO `master_satuan` (`id_satuan`, `kode_satuan`, `nama_satuan`, `konversi`, `satuan_utama`, `tipe_satuan`) VALUES
(2, 'kg', 'Kilogram', '1000', 'gr', 'Berat'),
(3, 'gr', 'Gram', '1', 'gr', 'Berat'),
(4, 'L', 'Liter', '1000', 'ml', 'Volume'),
(5, 'm', 'Meter', '1', '', 'Luas'),
(6, 'ton', 'Ton', '1', 'ton', 'Berat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor`
--

CREATE TABLE IF NOT EXISTS `nomor` (
`ID` int(11) NOT NULL,
  `NOMOR` int(11) DEFAULT NULL,
  `JENIS` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `nomor`
--

INSERT INTO `nomor` (`ID`, `NOMOR`, `JENIS`) VALUES
(1, 2, 'Invoice');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `departemen` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nama_user`, `foto`, `departemen`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin.jpeg', '8', 'direktur'),
(2, 'manager', '1d0258c2440a8d19e716292b231e3190', 'manager', '', '9', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_order`
--
ALTER TABLE `delivery_order`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `do_detail`
--
ALTER TABLE `do_detail`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `do_jasa`
--
ALTER TABLE `do_jasa`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
 ADD PRIMARY KEY (`id_barang`) USING BTREE;

--
-- Indexes for table `master_jasa`
--
ALTER TABLE `master_jasa`
 ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
 ADD PRIMARY KEY (`id_pelanggan`) USING BTREE;

--
-- Indexes for table `master_rute`
--
ALTER TABLE `master_rute`
 ADD PRIMARY KEY (`id_rute`);

--
-- Indexes for table `master_satuan`
--
ALTER TABLE `master_satuan`
 ADD PRIMARY KEY (`id_satuan`) USING BTREE;

--
-- Indexes for table `nomor`
--
ALTER TABLE `nomor`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_order`
--
ALTER TABLE `delivery_order`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `do_detail`
--
ALTER TABLE `do_detail`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `do_jasa`
--
ALTER TABLE `do_jasa`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_jasa`
--
ALTER TABLE `master_jasa`
MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_rute`
--
ALTER TABLE `master_rute`
MODIFY `id_rute` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=982;
--
-- AUTO_INCREMENT for table `master_satuan`
--
ALTER TABLE `master_satuan`
MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nomor`
--
ALTER TABLE `nomor`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
