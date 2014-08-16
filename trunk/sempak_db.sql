-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2014 at 11:09 AM
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
  `Id_Periode` int(10) NOT NULL,
  `Nama_RS` varchar(100) NOT NULL,
  `Alamat_RS` varchar(150) NOT NULL,
  `Kronologi` text NOT NULL,
  `Tanggal_Daftar` date NOT NULL,
  `Tanggal_Masuk` date NOT NULL,
  `Tanggal_Keluar` date NOT NULL,
  `Total_Biaya` int(15) NOT NULL,
  `Santunan` int(15) DEFAULT NULL,
  `Status_Asuransi` enum('WAITING','TERVERIFIKASI') NOT NULL DEFAULT 'WAITING',
  PRIMARY KEY (`Id_Asuransi`),
  KEY `Id_Pengguna` (`Id_Pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `asuransi`
--

INSERT INTO `asuransi` (`Id_Asuransi`, `Jenis_Asuransi`, `Id_Pengguna`, `Id_Periode`, `Nama_RS`, `Alamat_RS`, `Kronologi`, `Tanggal_Daftar`, `Tanggal_Masuk`, `Tanggal_Keluar`, `Total_Biaya`, `Santunan`, `Status_Asuransi`) VALUES
(1, 'KECELAKAAN', 3, 2, 'Cipto Mangun kusumo', 'Jakarta', 'Panjang Critanya', '2014-08-09', '2014-08-09', '2014-08-09', 445000, 44500, 'TERVERIFIKASI'),
(2, 'KECELAKAAN', 2, 2, 'fsfs', 'fsfsf', 'fsfs', '2014-08-09', '2014-08-09', '2014-08-09', 500000, 0, 'TERVERIFIKASI'),
(3, 'SAKIT', 4, 2, 'Dr. Sarjito', 'Jalan UGM Berjaya', 'Segalanya sudah Ada yang mengatur', '2014-08-11', '2014-08-08', '2014-08-09', 450000, NULL, 'WAITING'),
(4, 'SAKIT', 5, 2, 'RS Condong Catur', 'Condong Catur', 'Keserempet Mobil', '2014-08-08', '2014-08-04', '2014-08-06', 230000, 230000, 'WAITING'),
(5, 'KECELAKAAN', 5, 2, 'Bethesda', 'Sagan Lor', 'Ketilang dan jatuh sakit', '2014-08-12', '2014-08-10', '2014-08-11', 1000000, 1000000, 'TERVERIFIKASI');

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
  `Tanggal_Daftar` datetime NOT NULL,
  `Tanggal_Pinjam` date NOT NULL,
  `Waktu_Pinjam` time NOT NULL,
  `Tanggal_Selesai` date NOT NULL,
  `Waktu_Selesai` time NOT NULL,
  `Status_Penggunaan` enum('WAITING','TERVERIFIKASI','EXPIRED') DEFAULT NULL,
  PRIMARY KEY (`Id_Pinjam_Aula`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `aula`
--

INSERT INTO `aula` (`Id_Pinjam_Aula`, `Id_Pengguna`, `Nama_Kegiatan`, `Ketua_Organisasi`, `Peserta`, `Jml_Peserta`, `Tanggal_Daftar`, `Tanggal_Pinjam`, `Waktu_Pinjam`, `Tanggal_Selesai`, `Waktu_Selesai`, `Status_Penggunaan`) VALUES
(1, 3, 'Pelantikan BEM', 'Welly Tri W', 'Anggota BEM', 30, '2014-08-15 00:00:00', '2014-08-16', '10:00:00', '2014-08-16', '12:00:00', ''),
(2, 3, 'Pelantikan AMCC', 'Slamet Susanto', 'Member AMCC', 45, '2014-08-15 00:00:00', '2014-08-16', '10:00:00', '2014-08-16', '12:00:00', ''),
(3, 3, 'Pelantikan AMCC', 'Slamet Susanto', 'Member AMCC', 45, '2014-08-15 00:00:00', '2014-08-15', '22:06:00', '2014-08-15', '22:06:00', ''),
(4, 3, 'Pelantikan AMCC', 'Slamet Susanto', 'Member AMCC', 45, '2014-08-15 00:00:00', '2014-08-15', '22:16:00', '2014-08-15', '22:16:00', ''),
(5, 3, 'Pelantikan AMCC', 'Slamet Susanto', 'Member AMCC', 45, '2014-08-15 00:00:00', '2014-08-15', '22:16:00', '2014-08-15', '22:16:00', ''),
(6, 3, 'Pelantikan AMCC', 'Slamet Susanto', 'Member AMCC', 45, '2014-08-15 00:00:00', '2014-08-15', '22:18:00', '2014-08-15', '22:18:00', ''),
(7, 3, 'Pelantikan AMCC', 'Slamet Susanto', 'Member AMCC', 45, '2014-08-15 00:00:00', '2014-08-15', '22:18:00', '2014-08-15', '22:18:00', ''),
(8, 3, 'dsds', 'dsds', 'dsds', 0, '2014-08-15 00:00:00', '2014-08-15', '22:18:00', '2014-08-15', '22:18:00', ''),
(9, 3, 'adada', 'dada', 'dadad', 0, '2014-08-15 00:00:00', '2014-08-15', '22:32:00', '2014-08-15', '22:32:00', ''),
(10, 3, 'adada', 'dada', 'dadad', 0, '2014-08-15 00:00:00', '2014-08-15', '22:32:00', '2014-08-15', '22:32:00', ''),
(11, 3, 'adada', 'dada', 'dadad', 0, '2014-08-15 00:00:00', '2014-08-15', '22:32:00', '2014-08-15', '22:32:00', ''),
(12, 3, 'ddadad', 'Adida', 'dadad', 3, '2014-08-15 00:00:00', '2014-08-15', '22:00:00', '2014-08-15', '22:00:00', ''),
(13, 3, 'adada', 'dada', 'dadad', 4, '2014-08-15 00:00:00', '2014-08-15', '22:00:00', '2014-08-15', '22:00:00', ''),
(17, 3, 'fsfs', 'fsfs', 'fsfs', 4, '2014-08-16 00:00:00', '2014-08-16', '08:51:00', '2014-08-16', '08:51:00', ''),
(18, 3, 'rere', 'fefe', 'fefef', 4, '2014-08-16 00:00:00', '2014-08-16', '08:51:00', '2014-08-16', '08:51:00', ''),
(19, 3, 'd', 'dd', 'd', 5, '2014-08-16 00:00:00', '2014-08-16', '09:51:00', '2014-08-16', '09:51:00', ''),
(20, 3, 'fdkkabfkajbk', 'f', 'fefef', 5, '2014-08-16 00:00:00', '2014-08-16', '09:51:00', '2014-08-16', '09:51:00', ''),
(21, 3, 'fdhfjh', 'jbjhb', 'kjkjnk', 45, '2014-08-16 00:00:00', '2014-08-16', '10:05:00', '2014-08-16', '10:05:00', ''),
(22, 3, 'cjdsbskjbckj', 'jnkjnkj', 'nknkjnkj', 56, '2014-08-16 00:00:00', '2014-08-16', '10:05:00', '2014-08-16', '10:05:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE IF NOT EXISTS `beasiswa` (
  `Id_Beasiswa` int(10) NOT NULL AUTO_INCREMENT,
  `Id_JB` int(10) NOT NULL,
  `Id_Pengguna` int(10) NOT NULL,
  `Id_Jurusan` int(10) NOT NULL,
  `Id_Periode` int(10) NOT NULL,
  `Jenjang` enum('DIPLOMA 3','STRATA 1') NOT NULL,
  `Alamat_Sekarang` varchar(150) NOT NULL,
  `Nama_PT` set('STMIK AMIKOM YOGYAKARTA') NOT NULL,
  `Semester` int(1) NOT NULL,
  `IPK` decimal(4,0) NOT NULL,
  `Prestasi` varchar(500) DEFAULT NULL,
  `Alasan` varchar(500) NOT NULL,
  `BANK` set('MUAMALAT') NOT NULL,
  `No_Rekening` int(10) NOT NULL,
  `Tanggal_Daftar` date DEFAULT NULL,
  `Status_Beasiswa` enum('TERVERIFIKASI','WAITING') DEFAULT 'WAITING',
  PRIMARY KEY (`Id_Beasiswa`),
  KEY `Id_JB` (`Id_JB`),
  KEY `Id_Pengguna` (`Id_Pengguna`),
  KEY `Id_Jurusan` (`Id_Jurusan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `beasiswa`
--

INSERT INTO `beasiswa` (`Id_Beasiswa`, `Id_JB`, `Id_Pengguna`, `Id_Jurusan`, `Id_Periode`, `Jenjang`, `Alamat_Sekarang`, `Nama_PT`, `Semester`, `IPK`, `Prestasi`, `Alasan`, `BANK`, `No_Rekening`, `Tanggal_Daftar`, `Status_Beasiswa`) VALUES
(23, 3, 5, 5, 2, 'STRATA 1', 'Solo', '', 6, '3', 'Juara Lomba Nyanyi', 'Meringankan Beban Ortu', '', 2147483647, '2014-08-11', 'WAITING'),
(24, 3, 4, 4, 2, 'STRATA 1', 'Bantul', '', 4, '4', 'Juara Melukis', 'Meringankan beban Ortu', '', 2147483647, '2014-08-10', 'WAITING'),
(25, 1, 1, 5, 2, 'DIPLOMA 3', 'Sleman', '', 2, '2', 'Lomba Speaking', 'Meringankan Beban Ortu', '', 2147483647, '2014-08-12', 'WAITING'),
(26, 2, 2, 6, 2, 'STRATA 1', 'Mlati', '', 3, '4', 'Juara Melukis', 'Meringankan beban Ortu', '', 676655567, '2014-08-13', 'WAITING'),
(32, 1, 3, 1, 2, 'DIPLOMA 3', 'dfd', 'STMIK AMIKOM YOGYAKARTA', 2, '5', 'dsds', 'dsds', 'MUAMALAT', 4555555, '2014-08-15', ''),
(31, 1, 3, 1, 2, 'DIPLOMA 3', 'dddd', 'STMIK AMIKOM YOGYAKARTA', 2, '4', 'ddd', 'ddd', 'MUAMALAT', 4555555, '2014-08-15', '');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE IF NOT EXISTS `informasi` (
  `Id_Informasi` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Pengguna` int(10) NOT NULL,
  `Judul_Info` varchar(200) NOT NULL,
  `Isi_Info` text NOT NULL,
  `Jenis_Info` enum('Aula','Beasiswa','Asuransi') NOT NULL,
  `Tanggal_info` date DEFAULT NULL,
  PRIMARY KEY (`Id_Informasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`Id_Informasi`, `Id_Pengguna`, `Judul_Info`, `Isi_Info`, `Jenis_Info`, `Tanggal_info`) VALUES
(1, 1, 'Informasi Pendaftaran Beasiswa PPA dan BBP/PPA', 'Informasi Pendaftaran Beasiswa PPA dan BBP/PPA', 'Beasiswa', '2014-08-01'),
(2, 1, 'Prosedur Peminjaman Aula BSC', 'Prosedur Peminjaman Aula BSC', 'Aula', '2014-08-03'),
(3, 1, 'Informasi Peminjaman Tanggal 21 Agustus 2014', 'Informasi Peminjaman Tanggal 21 Agustus 2014', 'Aula', '2014-07-23'),
(4, 1, 'Prosedur Pendaftaran Rujukan Asuransi', 'Prosedur Pendaftaran Rujukan Asuransi', 'Asuransi', '2014-07-01'),
(5, 2, 'Informasi Pendaftaran Beasiswa MUAMALAT 2014', 'Informasi Pendaftaran Beasiswa MUAMALAT 2014', 'Beasiswa', '2014-08-03'),
(6, 1, 'Biaya Maksimal Rujukan Asuransi', 'Biaya Maksimal Rujukan Asuransi', 'Asuransi', '2014-07-30'),
(7, 1, 'Prosedur Alih Jenis Rujukan Asuransi', 'Prosedur Alih Jenis Rujukan Asuransi', 'Asuransi', '2014-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_beasiswa`
--

CREATE TABLE IF NOT EXISTS `jenis_beasiswa` (
  `Id_JB` int(10) NOT NULL AUTO_INCREMENT,
  `Jenis_Beasiswa` varchar(10) NOT NULL,
  `Warna_Beasiswa` varchar(10) DEFAULT NULL,
  `Keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id_JB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jenis_beasiswa`
--

INSERT INTO `jenis_beasiswa` (`Id_JB`, `Jenis_Beasiswa`, `Warna_Beasiswa`, `Keterangan`) VALUES
(1, 'PPA', '#FF0000', 'Beasiswa untuk Mahasiswa yang Berprestasi dibidang akademik dan organisasi'),
(2, 'BBP/PPA', '#FFFF00', 'Beasiswa Bantuan Biaya Pendidikan'),
(3, 'Muamalat', '#800080', 'Beasiswa dari Bank Muamalat Khusus Semester 1 dan 2');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `Id_Jurusan` int(10) NOT NULL AUTO_INCREMENT,
  `Nama_Jurusan` varchar(50) NOT NULL,
  `Singkatan_Jurusan` char(4) NOT NULL,
  `Warna_Jurusan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Jurusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`Id_Jurusan`, `Nama_Jurusan`, `Singkatan_Jurusan`, `Warna_Jurusan`) VALUES
(1, 'S1 Sistem Informasi', 'S1SI', '#0000FF'),
(4, 'S1 Teknik Informatika', 'S1TI', '#FF0000'),
(5, 'D3 Manajemen Informatika', 'D3MI', '#FF0000'),
(6, 'D3 Teknik Informatika', 'D3TI', '#A52A2A');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_asuransi`
--

CREATE TABLE IF NOT EXISTS `pendaftaran_asuransi` (
  `Id_Pengguna` int(10) NOT NULL,
  `Id_Periode` int(10) NOT NULL,
  `Id_Asuransi` int(10) NOT NULL,
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
  `Id_Beasiswa` int(10) NOT NULL,
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
  `Nama_Ortu` varchar(100) NOT NULL,
  `Alamat_Ortu` varchar(200) NOT NULL,
  `No_Telp_Ortu` int(15) DEFAULT NULL,
  `Pekerjaan_Ortu` enum('PNS','PEGAWAI SWASTA','WIRASWASTA','TNI/POLRI','NELAYAN/PETANI','LAINNYA') NOT NULL,
  `Penghasilan_Ortu` int(20) NOT NULL,
  `Jml_Tanggungan` int(3) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Online` int(1) NOT NULL,
  `Sesi` datetime NOT NULL,
  PRIMARY KEY (`Id_Pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`Id_Pengguna`, `Id_Level`, `Nama_Pengguna`, `Status_Pengguna`, `NIK_NIM`, `Password`, `Gender`, `No_Telp`, `Alamat`, `Tempat_Lahir`, `Tanggal_Lahir`, `Nama_Ortu`, `Alamat_Ortu`, `No_Telp_Ortu`, `Pekerjaan_Ortu`, `Penghasilan_Ortu`, `Jml_Tanggungan`, `Email`, `Online`, `Sesi`) VALUES
(1, 1, 'Urip Tri Prastowo', 'KARYAWAN', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'PRIA', 2147483647, 'Purbalingga', 'Purbalingga', '1993-04-21', 'John Mayer', 'Yogyakarta', 2147483647, 'WIRASWASTA', 30000000, 2, 'prastt21@gmail.com', 1, '2014-08-16 08:47:54'),
(2, 2, 'Praditya Kurniawan', 'KARYAWAN', 'operator', '4b583376b2767b923c3e1da60d10de59', 'WANITA', 2147483647, 'Yogyakarta', 'Yogyakarta', '1992-01-06', 'Waljinah', 'Jakarta', 2147483647, 'NELAYAN/PETANI', 89990000, 0, 'aku@masiyak.com', 0, '2014-08-12 00:02:39'),
(3, 3, 'Ratnasari Handaningrum', 'MAHASISWA', '11.02.8042', '9c25e12ed01a7720613081442e598f0a', 'WANITA', 2147483647, 'Yogyakarta', 'Yogyakarta', '1989-07-04', 'Tumini', 'Brebes', 27488990, 'TNI/POLRI', 10000000, 1, 'ratna@amikom.ac.id', 0, '2014-08-16 08:54:06'),
(4, 3, 'Arga Saputra\r\n', 'MAHASISWA', '11.01.2816', '6662e946315fb964f16d5e5692348c1a', 'PRIA', 988899900, 'Tegal', 'Tegal', '1991-02-12', 'Warimin', 'Tegal', 2147483647, 'NELAYAN/PETANI', 67000000, 2, 'arga@amikom.ac.id', 0, '0000-00-00 00:00:00'),
(5, 3, 'Ita Wulandari\r\n', 'MAHASISWA', '11.01.2817', '8a2f53811f706df10327ccd2c863c8e5', 'PRIA', 908889000, 'Jogja', 'Jogja', '1990-08-08', 'Jumadi', 'Jakarta', 2147483647, 'TNI/POLRI', 2000000, 0, 'agus@amikom.ac.id', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `Id_Periode` int(10) NOT NULL AUTO_INCREMENT,
  `Tahun` int(4) NOT NULL,
  `Keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id_Periode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`Id_Periode`, `Tahun`, `Keterangan`) VALUES
(2, 2014, 'Tahun Pemilu');

-- --------------------------------------------------------

--
-- Table structure for table `sistem`
--

CREATE TABLE IF NOT EXISTS `sistem` (
  `Status_Sistem` enum('AKTIF','TIDAK AKTIF') DEFAULT NULL,
  `Id_Periode` int(10) DEFAULT NULL,
  `Pengumuman_Sistem` text,
  `StatusRequest_Sistem` enum('AKTIF','TIDAK AKTIF') DEFAULT NULL,
  `KarReq_Sistem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sistem`
--

INSERT INTO `sistem` (`Status_Sistem`, `Id_Periode`, `Pengumuman_Sistem`, `StatusRequest_Sistem`, `KarReq_Sistem`) VALUES
('TIDAK AKTIF', 2, 'Jika Ada Kesulitan dalam menggunakan sistem ini silahkan hubungi Urip Tri Prastowo, 085647993380', 'AKTIF', 45000);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

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
(31, 2, 1, '1111'),
(32, 2, 29, '1111'),
(33, 2, 30, '0111'),
(34, 2, 31, '0110'),
(35, 2, 32, '0110'),
(37, 2, 34, '1111'),
(38, 2, 26, '1111'),
(39, 3, 1, '0100'),
(40, 3, 29, '0100'),
(41, 3, 38, '1100'),
(42, 3, 39, '1100'),
(43, 3, 40, '1100'),
(44, 3, 41, '1100'),
(50, 3, 44, '0100');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

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
(18, 'List Data Peminjaman Aula', 1, 1, 17, 'List Peminjaman Aula', 'laporan_aula', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(19, 'List Pendaftaran Beasiswa', 1, 2, 17, 'List Pendaftaran Beasiswa', 'laporan_beasiswa', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(20, 'List Rujukan Asuransi', 1, 3, 17, 'List Rujukan Asuransi', 'laporan_asuransi', '<i class= "fa fa-angle-double-right"></i>', 1, NULL),
(21, 'Config Sistem', 1, 7, 0, 'Konfigurasi Sistem', 'config_sistem', '<i class= "fa fa-wrench"></i>', 1, NULL),
(22, 'Config Request', 1, 8, 0, 'Konfigurasi Request Pengguna', 'config_request', '<i class= "fa fa-phone"></i>', 1, NULL),
(23, 'Config Pengumuman', 1, 9, 0, 'Konfigurasi Pengumuman', 'config_pengumumancoba', '<i class= "fa fa-bullhorn"></i>', 1, NULL),
(24, 'Manajemen Basisdata', 1, 10, 0, 'Manajemen Basisdata', 'manajemen_basisdata', '<i class= "fa fa-shield"></i>', 1, NULL),
(25, 'More Pages', 1, 11, 0, 'More Pages', 'more_pages', '<i class= "fa fa-clipboard"></i>', 1, NULL),
(26, 'User Profile', 1, 1, 25, 'User Profil', 'profil', '<i class= "fa fa-user"></i>', 1, NULL),
(27, 'Registrasi User', 1, 2, 25, 'login and Register', 'login_registers', '<i class= "fa fa-caret-square-o-right"></i>', 1, NULL),
(28, 'Dashboard', 1, 1, 0, 'Dashboard Operator', 'dashboard', '<i class= "fa fa-dashboard"></i>', 1, NULL),
(29, 'Berita dan Informasi', 1, 2, 0, 'Berita dan Informasi', 'berita_dan_informasi', '<i class= "fa fa-building-o"></i>', 1, NULL),
(30, 'Data Peminjaman Aula', 1, 3, 0, 'Data Peminjaman Aula', 'data_peminjaman_aula', '<i class= "fa fa-credit-card"></i>', 1, NULL),
(31, 'Data Pendaftaran Beasiswa', 1, 4, 0, 'Data Pendaftaran Beasiswa', 'data_beasiswa', '<i class= "fa fa-gift"></i>', 1, NULL),
(32, 'Data Rujukan Asuransi', 1, 5, 0, 'Data Rujukan Asuransi', 'data_rujukan_asuransi', '<i class= "fa fa-medkit"></i>', 1, NULL),
(33, 'Request Pengguna', 1, 6, 0, 'Request Pengguna', 'request_pengguna', '<i class= "fa fa-github-square"></i>', 1, NULL),
(34, 'More Pages', 1, 7, 0, 'More Pages', 'more_pages', '<i class= "fa fa-clipboard"></i>', 1, NULL),
(35, 'User Profil', 1, 8, 34, 'Profil Operator', 'user_profil', '<i class= "fa fa-user"></i>', 1, NULL),
(36, 'Dashboard', 1, 1, 0, 'Dashboard', 'dashboard', '<i class= "fa fa-dashboard"></i>', 1, NULL),
(37, 'Berita dan Informasi', 1, 2, 0, 'Berita dan Informasi', 'informasi', '<i class= "fa fa-building-o"></i>', 1, NULL),
(38, 'Submit Pendaftaran', 1, 3, 0, 'Submit Pendaftaran', NULL, '<i class= "fa fa-toggle-right"></i>', 1, NULL),
(39, 'Peminjaman Aula BSC', 1, 4, 38, 'Peminjaman Aula BSC', 'pendaftaran_peminjaman_aula', '<i class= "fa fa-credit-card"></i>', 1, NULL),
(40, 'Pendaftaran Beasiswa', 1, 5, 38, 'Pendaftaran Beasiswa', 'pendaftaran_beasiswa', '<i class= "fa fa-gift"></i>', 1, NULL),
(41, 'Pendaftaran Rujukan', 1, 6, 38, 'Pendaftaran Rujukan Asuransi', 'pendaftaran_rujukan_asuransi', '<i class= "fa fa-medkit"></i>', 1, NULL),
(44, 'Jadwal Aula', 1, 2, 0, 'Jadwal Peminjaman Aula', 'jadwal_peminjaman_aula', NULL, 1, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asuransi`
--
ALTER TABLE `asuransi`
  ADD CONSTRAINT `asuransi_ibfk_1` FOREIGN KEY (`Id_Pengguna`) REFERENCES `pengguna` (`Id_Pengguna`);

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
