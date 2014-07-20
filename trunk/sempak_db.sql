-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2014 at 10:59 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sempak_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `asuransi`
--

CREATE TABLE IF NOT EXISTS `asuransi` (
  `Id_Asuransi` int(10) NOT NULL AUTO_INCREMENT,
  `Jenis_Asuransi` enum('KECELAKAAN','SAKIT') NOT NULL,
  `Id_Pengguna` int(10) NOT NULL,
  `Nama_RS` varchar(100) NOT NULL,
  `Alamat_RS` varchar(150) NOT NULL,
  `Tanggal_Masuk` date NOT NULL,
  `Tanggal_Keluar` date NOT NULL,
  `Total_Biaya` int(15) NOT NULL,
  `Santunan` int(15) DEFAULT NULL,
  PRIMARY KEY (`Id_Asuransi`),
  KEY `Id_Pengguna` (`Id_Pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `asuransi`
--

INSERT INTO `asuransi` (`Id_Asuransi`, `Jenis_Asuransi`, `Id_Pengguna`, `Nama_RS`, `Alamat_RS`, `Tanggal_Masuk`, `Tanggal_Keluar`, `Total_Biaya`, `Santunan`) VALUES
(1, 'KECELAKAAN', 4, 'RS. dr.Sardjito', 'Jalan Kamboja Kompleks UGM', '0000-00-00', '0000-00-00', 500000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aula`
--

CREATE TABLE IF NOT EXISTS `aula` (
  `Id_Pinjam_Aula` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Pengguna` int(10) NOT NULL,
  `Nama_Kegiatan` varchar(100) NOT NULL,
  `Ketua_Organisasi` varchar(100) NOT NULL,
  `Peserta` varchar(100) NOT NULL,
  `Jml_Peserta` int(3) NOT NULL,
  `Tanggal_Pinjam` date NOT NULL,
  `Waktu_Pinjam` time NOT NULL,
  `Tanggal_Selesai` date NOT NULL,
  `Waktu_Selesai` time NOT NULL,
  `Status_Penggunaan` enum('Terverifikasi','Waiting','Expired') NOT NULL,
  PRIMARY KEY (`Id_Pinjam_Aula`),
  KEY `Id_Pengguna` (`Id_Pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `aula`
--


-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE IF NOT EXISTS `beasiswa` (
  `Id_Beasiswa` int(10) NOT NULL AUTO_INCREMENT,
  `Id_JB` int(10) NOT NULL,
  `Id_Pengguna` int(10) NOT NULL,
  `Id_Ortu` int(10) NOT NULL,
  `Id_Jurusan` int(10) NOT NULL,
  `Jenjang` enum('D3','S1') NOT NULL,
  `Alamat_Sekarang` varchar(150) NOT NULL,
  `Nama_PT` set('STMIK AMIKOM YOGYAKARTA') DEFAULT NULL,
  `Semester` int(1) NOT NULL,
  `IPK` decimal(4,0) NOT NULL,
  `Prestasi` varchar(500) DEFAULT NULL,
  `Alasan` varchar(500) NOT NULL,
  `No_Rekening` int(10) NOT NULL,
  PRIMARY KEY (`Id_Beasiswa`),
  KEY `Id_JB` (`Id_JB`),
  KEY `Id_Pengguna` (`Id_Pengguna`),
  KEY `Id_Ortu` (`Id_Ortu`),
  KEY `Id_Jurusan` (`Id_Jurusan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `beasiswa`
--


-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE IF NOT EXISTS `informasi` (
  `Id_Informasi` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Pengguna` int(10) NOT NULL,
  `Judul_Info` varchar(200) NOT NULL,
  `Isi_Info` varchar(1000) NOT NULL,
  `Jenis_Info` enum('Aula','Beasiswa','Asuransi') NOT NULL,
  `Tanggal_info` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Informasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`Id_Informasi`, `Id_Pengguna`, `Judul_Info`, `Isi_Info`, `Jenis_Info`, `Tanggal_info`) VALUES
(1, 1, 'judul', 'isi', 'Beasiswa', NULL),
(2, 1, 'judul yang kedua', 'isi yang kedua', 'Aula', NULL),
(3, 1, 'hdfhdf', 'fhdfhd', 'Aula', NULL),
(4, 1, 'xz', 'aa', 'Aula', NULL),
(5, 1, 'sdfbsjhdbfksj', 'fbkdjafbakjsn', 'Aula', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_beasiswa`
--

CREATE TABLE IF NOT EXISTS `jenis_beasiswa` (
  `Id_JB` int(10) NOT NULL AUTO_INCREMENT,
  `Jenis_Beasiswa` varchar(10) DEFAULT NULL,
  `Warna_Beasiswa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id_JB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jenis_beasiswa`
--

INSERT INTO `jenis_beasiswa` (`Id_JB`, `Jenis_Beasiswa`, `Warna_Beasiswa`) VALUES
(1, 'PPA', NULL),
(2, 'BBP/PPA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `Id_Jurusan` int(10) NOT NULL AUTO_INCREMENT,
  `Nama_Jurusan` varchar(30) NOT NULL,
  `Singkatan_Jurusan` char(4) DEFAULT NULL,
  `Warna_Jurusan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Jurusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`Id_Jurusan`, `Nama_Jurusan`, `Singkatan_Jurusan`, `Warna_Jurusan`) VALUES
(1, 'dsv', 'dsvd', '#20B2AA');

-- --------------------------------------------------------

--
-- Table structure for table `keterangan_ortu`
--

CREATE TABLE IF NOT EXISTS `keterangan_ortu` (
  `Id_Ortu` int(10) NOT NULL AUTO_INCREMENT,
  `Nama_Ortu` varchar(100) NOT NULL,
  `Alamat_Ortu` varchar(150) NOT NULL,
  `No_Telp_Ortu` int(15) NOT NULL,
  `Pekerjaan_Ortu` enum('PNS','PEGAWAI SWASTA','WIRASWASTA','TNI/POLRI','NELAYAN/PETANI','LAINNYA') DEFAULT NULL,
  `Penghasilan_Ortu` int(15) DEFAULT NULL,
  `Jml_Tanggungan` int(2) DEFAULT NULL,
  PRIMARY KEY (`Id_Ortu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `keterangan_ortu`
--

INSERT INTO `keterangan_ortu` (`Id_Ortu`, `Nama_Ortu`, `Alamat_Ortu`, `No_Telp_Ortu`, `Pekerjaan_Ortu`, `Penghasilan_Ortu`, `Jml_Tanggungan`) VALUES
(1, 'dkgbskjd', 'sjhdvam', 9889, 'LAINNYA', 45555, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_asuransi`
--

CREATE TABLE IF NOT EXISTS `pendaftaran_asuransi` (
  `Id_Pengguna` int(10) NOT NULL,
  `Id_Periode` int(10) NOT NULL,
  `Tanggal_Daftar_Asuransi` datetime NOT NULL,
  `Id_Asuransi` char(5) NOT NULL,
  `Status_Asuransi` int(1) NOT NULL,
  KEY `Id_Pengguna` (`Id_Pengguna`),
  KEY `Id_Asuransi` (`Id_Asuransi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran_asuransi`
--


-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_beasiswa`
--

CREATE TABLE IF NOT EXISTS `pendaftaran_beasiswa` (
  `Id_Pengguna` int(10) NOT NULL,
  `Id_Periode` int(10) NOT NULL,
  `Tanggal_Daftar_Beasiswa` datetime NOT NULL,
  `Id_Beasiswa` int(10) NOT NULL,
  `Status_Beasiswa` int(1) NOT NULL,
  KEY `Id_Pengguna` (`Id_Pengguna`),
  KEY `Id_Beasiswa` (`Id_Beasiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran_beasiswa`
--


-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `Id_Pengguna` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Ortu` int(10) NOT NULL,
  `Id_Level` int(1) NOT NULL,
  `Nama_Pengguna` varchar(150) NOT NULL,
  `Status_Pengguna` enum('MAHASISWA','KARYAWAN') NOT NULL,
  `NIK_NIM` varchar(10) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Gender` enum('PRIA','WANITA') NOT NULL,
  `No_Telp` int(15) NOT NULL,
  `Alamat` varchar(400) NOT NULL,
  `Tempat_Lahir` varchar(20) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Online` int(1) NOT NULL,
  `Sesi` datetime NOT NULL,
  `Catatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_Pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`Id_Pengguna`, `Id_Ortu`, `Id_Level`, `Nama_Pengguna`, `Status_Pengguna`, `NIK_NIM`, `Password`, `Gender`, `No_Telp`, `Alamat`, `Tempat_Lahir`, `Tanggal_Lahir`, `Email`, `Online`, `Sesi`, `Catatan`) VALUES
(1, 1, 1, 'Urip Tri Prastowo', 'KARYAWAN', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'PRIA', 2147483647, 'Purbalingga', 'Purbalingga', '1993-04-21', 'prastt21@gmail.com', 0, '0000-00-00 00:00:00', NULL),
(2, 0, 2, 'Praditya Kurniawan', 'KARYAWAN', 'operator', '4b583376b2767b923c3e1da60d10de59', 'PRIA', 2147483647, 'Yogyakarta', 'Yogyakarta', '1992-01-06', '', 0, '0000-00-00 00:00:00', NULL),
(3, 1, 3, 'Ratnasari Handaningrum', 'MAHASISWA', '11.02.8042', '9c25e12ed01a7720613081442e598f0a', 'WANITA', 2147483647, 'Yogyakarta', 'Yogyakarta', '1989-07-04', '', 0, '0000-00-00 00:00:00', NULL),
(4, 1, 3, 'ARGA SAPUTRA\r\n', 'MAHASISWA', '', '', 'PRIA', 0, '', '', '0000-00-00', '', 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `Id_Periode` int(10) NOT NULL AUTO_INCREMENT,
  `Tahun` int(4) NOT NULL,
  PRIMARY KEY (`Id_Periode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`Id_Periode`, `Tahun`) VALUES
(1, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `sistem`
--

CREATE TABLE IF NOT EXISTS `sistem` (
  `Status_Sistem` enum('AKTIF','TIDAK AKTIF') NOT NULL,
  `Id_Periode` int(1) NOT NULL,
  `Pengumuman_Sistem` varchar(500) NOT NULL,
  `StatusRequest_Sistem` enum('AKTIF','TIDAK AKTIF') NOT NULL,
  `KarReq_Sistem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sistem`
--

INSERT INTO `sistem` (`Status_Sistem`, `Id_Periode`, `Pengumuman_Sistem`, `StatusRequest_Sistem`, `KarReq_Sistem`) VALUES
('AKTIF', 2, 'Periode Sistem Saat Ini Adalah Tahun 2014', 'AKTIF', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `sys_level`
--

CREATE TABLE IF NOT EXISTS `sys_level` (
  `Id_Level` int(1) NOT NULL AUTO_INCREMENT,
  `Nama_Level` varchar(15) NOT NULL,
  `Deskripsi_Level` varchar(70) NOT NULL,
  `Portal_Level` varchar(40) NOT NULL,
  PRIMARY KEY (`Id_Level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sys_level`
--

INSERT INTO `sys_level` (`Id_Level`, `Nama_Level`, `Deskripsi_Level`, `Portal_Level`) VALUES
(1, 'ADMINISTRATOR', 'Super User', 'dashboard'),
(2, 'OPERATOR', 'Operator', 'dashboard'),
(3, 'PENGGUNA', 'Mahasiswa dan Karyawan', 'dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `sys_level_menu`
--

CREATE TABLE IF NOT EXISTS `sys_level_menu` (
  `id_level_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `hak` varchar(4) NOT NULL,
  PRIMARY KEY (`id_level_menu`),
  KEY `fk_level_menu_menu1_idx` (`id_menu`),
  KEY `fk_level_menu_level1_idx` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `sys_level_menu`
--

INSERT INTO `sys_level_menu` (`id_level_menu`, `id_level`, `id_menu`, `hak`) VALUES
(1, 1, 1, '1111'),
(2, 1, 2, '1111'),
(3, 1, 3, '1111'),
(4, 1, 4, '1111'),
(5, 1, 5, '1111'),
(9, 1, 6, '1111'),
(10, 1, 7, '1111'),
(11, 1, 8, '1111'),
(12, 1, 9, '1111'),
(13, 1, 10, '0100'),
(14, 1, 11, '0100'),
(15, 1, 12, '1111'),
(16, 1, 13, '1111'),
(17, 1, 14, '1111'),
(18, 1, 15, '1111'),
(19, 1, 16, '1111'),
(20, 1, 17, '1111'),
(21, 1, 18, '1111'),
(22, 1, 19, '1111'),
(23, 1, 20, '1111'),
(24, 1, 21, '1111'),
(25, 1, 22, '1111'),
(26, 1, 23, '1111'),
(27, 1, 24, '1111'),
(28, 1, 25, '1111'),
(29, 1, 26, '1111'),
(30, 1, 27, '1111'),
(31, 2, 1, '1111'),
(32, 2, 29, '1111'),
(33, 2, 30, '0110'),
(34, 2, 31, '0110'),
(35, 2, 32, '0110'),
(36, 2, 33, '1111'),
(37, 2, 34, '1111'),
(38, 2, 35, '1111'),
(39, 3, 1, '0100'),
(40, 3, 37, '0100'),
(41, 3, 38, '1100'),
(42, 3, 39, '1100'),
(43, 3, 40, '1100'),
(44, 3, 41, '1100'),
(45, 3, 42, '1111'),
(46, 3, 43, '1111');

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu`
--

CREATE TABLE IF NOT EXISTS `sys_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(45) NOT NULL,
  `tampil` int(1) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `deskripsi` varchar(75) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `mdb` int(11) DEFAULT '1',
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`id_menu`, `nama_menu`, `tampil`, `urutan`, `parent_id`, `deskripsi`, `link`, `icon`, `mdb`, `mdd`) VALUES
(1, 'Dashboard', 1, 1, 0, 'Dashboard', 'dashboard', '<i class= "fa fa-dashboard"></i>', 1, NULL),
(2, 'Data Operator', 1, 2, 0, 'Data Operator', 'data_operator', '<i class= "fa fa-users"></i>', 1, NULL),
(3, 'Manajemen Data', 1, 3, 0, 'Manajemen Data', NULL, '<i class= "fa fa-book"></i>', 1, NULL),
(4, 'Peminjaman Aula', 1, 1, 3, 'Data Peminjaman Aula', 'peminjaman_aula', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(5, 'Beasiswa', 1, 2, 3, 'Data Beasiswa', 'beasiswa', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(6, 'Rujukan Asuransi', 1, 3, 3, 'Data Rujukan Asuransi', 'rujukan_asuransi', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(7, 'Jurusan', 1, 4, 3, 'Data Jurusan', 'jurusan', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(8, 'Periode', 1, 5, 3, 'Data Periode', 'periode', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(9, 'Jenis Beasiswa', 1, 6, 3, 'Data Jenis Beasiswa', 'jenis_beasiswa', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(10, 'Data Pengguna', 1, 7, 3, 'Data Pengguna', 'pengguna', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(11, 'Keterangan Orang Tua', 1, 8, 3, 'Data Keterangan Orang Tua', 'keterangan_orang_tua', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(12, 'Manajemen Konten', 1, 4, 0, 'Manajemen Konten', 'manajemen_konten', '<i class= "fa fa-file-text"></i>', 1, NULL),
(13, 'Informasi', 1, 1, 12, 'Data Informasi', 'data_informasi', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(14, 'Kalender', 1, 2, 12, 'Kalender', 'kalender', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(15, 'Statistik', 1, 3, 12, 'Statistik', 'statistik', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(16, 'Request Pengguna', 1, 5, 0, 'Request Pengguna', 'request_pengguna', '<i class= "fa fa-github-square"></i>', 1, NULL),
(17, 'Laporan-Laporan', 1, 6, 0, 'Laporan - Laporan', 'laporan_laporan', '<i class= "fa fa-phone-square"></i>', 1, NULL),
(18, 'List Data Peminjaman Aula', 1, 1, 17, 'List Peminjaman Aula', 'list_peminjaman_aula', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(19, 'List Pendaftaran Beasiswa', 1, 2, 17, 'List Pendaftaran Beasiswa', 'list_pendaftaran_beasiswa', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(20, 'List Rujukan Asuransi', 1, 3, 17, 'List Rujukan Asuransi', 'list_rujukan_asuransi', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(21, 'Config Sistem', 1, 7, 0, 'Konfigurasi Sistem', 'config_sistem', '<i class= "fa fa-wrench"></i>', 1, NULL),
(22, 'Config Request', 1, 8, 0, 'Konfigurasi Request Pengguna', 'config_request', '<i class= "fa fa-phone"></i>', 1, NULL),
(23, 'Config Pengumuman', 1, 9, 0, 'Konfigurasi Pengumuman', 'config_pengumuman', '<i class= "fa fa-bullhorn"></i>', 1, NULL),
(24, 'Manajemen Basisdata', 1, 10, 0, 'Manajemen Basisdata', 'manajemen_basisdata', '<i class= "fa fa-shield"></i>', 1, NULL),
(25, 'More Pages', 1, 11, 0, 'More Pages', 'more_pages', '<i class= "fa fa-clipboard"></i>', 1, NULL),
(26, 'User Profile', 1, 1, 25, 'User Profil', 'user_profil', '<i class= "fa fa-user"></i>', 1, NULL),
(27, 'Registrasi User', 1, 2, 25, 'login and Register', 'login_registers', '<i class= "fa fa-caret-square-o-right"></i>', 1, NULL),
(28, 'Dashboard', 1, 1, 0, 'Dashboard Operator', 'dashboard', '<i class= "fa fa-dashboard"></i>', 1, NULL),
(29, 'Berita dan Informasi', 1, 2, 0, 'Berita dan Informasi', 'informasi', '<i class= "fa fa-building-o"></i>', 1, NULL),
(30, 'Data Peminjaman Aula', 1, 3, 0, 'Data Peminjaman Aula', 'data_peminjaman_aula', '<i class= "fa fa-credit-card"></i>', 1, NULL),
(31, 'Data Pendaftaran Beasiswa', 1, 4, 0, 'Data Pendaftaran Beasiswa', 'data_pendaftaran_beasiswa', '<i class= "fa fa-gift"></i>', 1, NULL),
(32, 'Data Rujukan Asuransi', 1, 5, 0, 'Data Rujukan Asuransi', 'data_rujukan_asuransi', '<i class= "fa fa-medkit"></i>', 1, NULL),
(33, 'Request Pengguna', 1, 6, 0, 'Request Pengguna', 'request_pengguna', '<i class= "fa fa-github-square"></i>', 1, NULL),
(34, 'More Pages', 1, 7, 0, 'More Pages', 'more_pages', '<i class= "fa fa-clipboard"></i>', 1, NULL),
(35, 'User Profil', 1, 8, 34, 'Profil Operator', 'user_profil', '<i class= "fa fa-user"></i>', 1, NULL),
(36, 'Dashboard', 1, 1, 0, 'Dashboard', 'dashboard', '<i class= "fa fa-dashboard"></i>', 1, NULL),
(37, 'Berita dan Informasi', 1, 2, 0, 'Berita dan Informasi', 'informasi', '<i class= "fa fa-building-o"></i>', 1, NULL),
(38, 'Submit Pendaftaran', 1, 3, 0, 'Submit Pendaftaran', NULL, NULL, 1, NULL),
(39, 'Peminjaman Aula BSC', 1, 4, 38, 'Peminjaman Aula BSC', 'pendaftaran_peminjaman_aula', '<i class= "fa fa-credit-card"></i>', 1, NULL),
(40, 'Pendaftaran Beasiswa', 1, 5, 38, 'Pendaftaran Beasiswa', 'pendaftaran_beasiswa', '<i class= "fa fa-gift"></i>', 1, NULL),
(41, 'Pendaftaran Rujukan', 1, 6, 38, 'Pendaftaran Rujukan Asuransi', 'pendaftaran_rujukan_asuransi', '<i class= "fa fa-medkit"></i>', 1, NULL),
(42, 'More Pages', 1, 7, 0, 'More Pages', 'more_pages', '<i class= "fa fa-clipboard"></i>', 1, NULL),
(43, 'User Profil', 1, 8, 42, NULL, 'user_profil', '<i class= "fa fa-user"></i>', 1, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asuransi`
--
ALTER TABLE `asuransi`
  ADD CONSTRAINT `asuransi_ibfk_1` FOREIGN KEY (`Id_Pengguna`) REFERENCES `pengguna` (`Id_Pengguna`);

--
-- Constraints for table `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`Id_Pengguna`) REFERENCES `pengguna` (`Id_Pengguna`);

--
-- Constraints for table `pendaftaran_asuransi`
--
ALTER TABLE `pendaftaran_asuransi`
  ADD CONSTRAINT `pendaftaran_asuransi_ibfk_1` FOREIGN KEY (`Id_Pengguna`) REFERENCES `pengguna` (`Id_Pengguna`);

--
-- Constraints for table `pendaftaran_beasiswa`
--
ALTER TABLE `pendaftaran_beasiswa`
  ADD CONSTRAINT `pendaftaran_beasiswa_ibfk_1` FOREIGN KEY (`Id_Pengguna`) REFERENCES `pengguna` (`Id_Pengguna`);

--
-- Constraints for table `sys_level_menu`
--
ALTER TABLE `sys_level_menu`
  ADD CONSTRAINT `sys_level_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `sys_menu` (`id_menu`),
  ADD CONSTRAINT `sys_level_menu_ibfk_2` FOREIGN KEY (`id_level`) REFERENCES `sys_level` (`Id_Level`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
