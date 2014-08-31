-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 31. Agustus 2014 jam 19:53
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

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
-- Struktur dari tabel `asuransi`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data untuk tabel `asuransi`
--

INSERT INTO `asuransi` (`Id_Asuransi`, `Jenis_Asuransi`, `Id_Pengguna`, `Id_Periode`, `Nama_RS`, `Alamat_RS`, `Kronologi`, `Tanggal_Daftar`, `Tanggal_Masuk`, `Tanggal_Keluar`, `Total_Biaya`, `Santunan`, `Status_Asuransi`) VALUES
(6, 'SAKIT', 3, 2, 'RSU Dr Sardjito', 'Jalan Akasia UGM', 'Sakit Tipes, Telat Makan', '2014-08-01', '2014-07-30', '2014-07-31', 200000, 200000, 'TERVERIFIKASI'),
(7, 'KECELAKAAN', 4, 2, 'RSU Dr Sardjito', 'Jalan Akasia UGM', 'Ketika Posisi Belok Diserempet Motor Sampe Meninggal', '2014-08-03', '2014-07-01', '2014-08-06', 5000000, 0, 'WAITING'),
(8, 'KECELAKAAN', 5, 2, 'Rs Bethesda', 'Jalan Sagan Lor', 'Melarikan diri dari Tilangan polisi eh malah ketabrak mobil', '2014-08-02', '2014-07-02', '2014-07-08', 35000000, 0, 'WAITING'),
(9, 'KECELAKAAN', 7, 2, 'RS Condong Catur', 'Jalan Condong Kanan', 'Tabrakan Guys', '2014-08-03', '2014-08-01', '2014-08-02', 4000000, 0, 'WAITING'),
(10, 'SAKIT', 8, 2, 'RSU Dr Sardjito', 'Jalan Akasia UGM', 'Sakit Tipus', '2014-08-12', '2014-08-03', '2014-08-06', 230000, 0, 'WAITING'),
(11, 'SAKIT', 9, 2, 'RS Condong Catur', 'Jalan Condong Ke Kanan', 'Sakit Tipus', '2014-08-10', '2014-08-04', '2014-08-06', 200500, 0, 'WAITING'),
(12, 'KECELAKAAN', 10, 2, 'Rs Bethesda', 'Jalan Sagan Lor', 'Nabrak Pohon', '2014-08-03', '2014-08-01', '2014-08-02', 300000, 0, 'WAITING'),
(13, 'KECELAKAAN', 11, 2, 'RSU Dr Sardjito', 'Jalan Akasia UGM', 'Keserempet Mobil', '2014-08-06', '2014-08-03', '2014-08-04', 1000000, 0, 'WAITING'),
(14, 'SAKIT', 12, 2, 'Rs Bethesda', 'Jalan Sagan Lor', 'Sakit Hati', '2014-08-10', '2014-08-07', '2014-08-09', 200000, 0, 'WAITING'),
(15, 'SAKIT', 13, 2, 'RS Condong Catur', 'Jalan Condong Ke Kanan', 'Sakit Jiwa', '2014-08-03', '2014-07-06', '2014-07-10', 1500000, 0, 'WAITING'),
(16, 'KECELAKAAN', 14, 2, 'RS Condong Catur', 'Jalan Condong Ke kanan', 'Terjatuh dari motor', '2014-08-05', '2014-08-03', '2014-08-03', 40000, 0, 'WAITING'),
(17, 'SAKIT', 15, 2, 'Rs Bethesda', 'Jalan Sagan Lor', 'Sakit Karena Mantan', '2014-08-04', '2014-08-01', '2014-08-03', 38900000, 0, 'WAITING'),
(18, 'KECELAKAAN', 16, 2, 'RS Condong Catur', 'Jalan Condong Ke Kanan', 'Waktu Belok Eh Malah Mbelok', '2014-06-02', '2014-06-01', '2014-06-01', 250000, 0, 'WAITING'),
(19, 'SAKIT', 17, 2, 'Rs Bethesda', 'Jalan Sagan Lor', 'Sakit Hati', '2014-08-04', '2014-08-01', '2014-08-03', 4500000, 0, 'WAITING'),
(20, 'SAKIT', 18, 2, 'RS Condong Catur', 'Jalan Condong Ke kanan', 'Sakit Flu', '2014-07-09', '2014-07-03', '2014-07-07', 60000000, 0, 'WAITING'),
(21, 'KECELAKAAN', 19, 2, 'RSU Dr Sardjito', 'Jalan Akasia UGM', 'Selalu Saja Nabrak', '2014-07-23', '2014-07-20', '2014-07-23', 53000000, 0, 'WAITING'),
(22, 'SAKIT', 20, 2, 'RS Condong Catur', 'Jalan Condong Ke Kanan', 'Sakit Jantung', '2014-08-11', '2014-08-07', '2014-08-09', 4340000, 0, 'WAITING'),
(23, 'KECELAKAAN', 25, 3, 'fafasfa', 'fasfasfa', 'fasfasf', '2014-08-19', '2014-08-19', '2014-08-19', 5000000, 0, 'WAITING');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aula`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data untuk tabel `aula`
--

INSERT INTO `aula` (`Id_Pinjam_Aula`, `Id_Pengguna`, `Nama_Kegiatan`, `Ketua_Organisasi`, `Peserta`, `Jml_Peserta`, `Tanggal_Daftar`, `Tanggal_Pinjam`, `Waktu_Pinjam`, `Tanggal_Selesai`, `Waktu_Selesai`, `Status_Penggunaan`) VALUES
(36, 16, 'Breafing Acara Basket', 'Rivaldo', 'Anggota UKM', 20, '2014-08-13 00:00:00', '2014-08-15', '20:00:00', '2014-08-15', '22:00:00', 'TERVERIFIKASI'),
(35, 15, 'Rapat HMJTI', 'Eko Supeno', 'HMJTI', 54, '2014-08-06 00:00:00', '2014-08-08', '19:00:00', '2014-08-08', '23:00:00', 'WAITING'),
(34, 14, 'Rapat Himmsi Tahunan', 'Surya  Ananta', 'Seluruh HIMMSI', 40, '2014-08-11 00:00:00', '2014-08-12', '20:15:00', '2014-08-12', '21:15:00', 'WAITING'),
(33, 13, 'Breafing Panitia Junkis', 'Selviana', 'Panitia', 20, '2014-08-17 00:00:00', '2014-08-18', '20:00:00', '2014-08-18', '20:30:00', 'TERVERIFIKASI'),
(32, 12, 'Stand Up Comedy', 'Jumadi', 'Umum', 58, '2014-08-17 00:00:00', '2014-08-21', '20:06:00', '2014-08-21', '21:06:00', 'WAITING'),
(31, 11, 'Pesta Budaya', 'Sutrisno', 'Umum', 120, '2014-08-10 00:00:00', '2014-08-15', '20:00:00', '2014-08-15', '23:00:00', 'WAITING'),
(30, 10, 'Belajar Bersama UAS', 'Niken Larasati', 'Anggota Himmsi', 60, '2014-08-10 00:00:00', '2014-08-13', '19:00:00', '2014-08-13', '21:00:00', 'WAITING'),
(29, 9, 'Gathering Pengurus Senat', 'Febri Jatmiko', 'Senator Kelas', 50, '2014-08-04 00:00:00', '2014-08-05', '20:00:00', '2014-08-05', '21:00:00', 'WAITING'),
(28, 8, 'Stand Up Comedy', 'Pace Sukece', 'Mahasiswa AMIKOM', 50, '2014-08-04 00:00:00', '2014-08-05', '12:00:00', '2014-08-05', '14:00:00', 'WAITING'),
(27, 7, 'Pelantikan Pengurus Jashtis', 'Budi Setiawan', 'Calon Pengurus', 20, '2014-08-04 00:00:00', '2014-08-05', '07:00:00', '2014-08-05', '10:00:00', 'WAITING'),
(26, 5, 'Koma Under Word', 'Titin Nurjanah', 'Mahasiswa AMIKOM', 23, '2014-08-17 00:00:00', '2014-08-04', '15:00:00', '2014-08-05', '15:00:00', 'WAITING'),
(25, 4, 'Gathering  AMCC', 'Slamet Budi Projo', 'Member dan Pengurus AMCC', 45, '2014-08-02 00:00:00', '2014-08-02', '15:00:00', '2014-08-02', '17:00:00', 'WAITING'),
(24, 3, 'Upgrading AEC', 'Alvin Dwi Putra', 'Panitia AEC', 45, '2014-08-01 00:00:00', '2014-08-02', '09:00:00', '2014-08-02', '12:00:00', 'WAITING'),
(37, 17, 'Syukuran Tahunan', 'Budi Ristanto', 'Anggota UKM JAstish', 45, '2014-07-14 00:00:00', '2014-07-15', '20:00:00', '2014-07-15', '22:00:00', 'WAITING'),
(38, 18, 'Upgrading Koma', 'Selviana', 'Anggota Koma', 35, '2014-07-28 00:00:00', '2014-07-29', '15:00:00', '2014-07-29', '17:00:00', 'WAITING'),
(39, 19, 'Grand Opening UKM', 'Juanda Alsoino', 'Seluruh Mahasiswa Amikom', 65, '2014-07-10 00:00:00', '2014-07-11', '09:00:00', '2014-07-11', '17:00:00', 'WAITING'),
(40, 20, 'Move On Dari PAcar Gue', 'Anna Maritana', 'Jomblowan Jomblowati', 50, '2014-08-18 00:00:00', '2014-08-19', '20:00:00', '2014-08-19', '21:00:00', 'WAITING'),
(44, 3, 'adada', 'Adida', 'Anggota BEM', 2, '2014-08-18 00:00:00', '2014-08-18', '11:22:00', '2014-08-18', '12:22:00', 'WAITING'),
(45, 3, 'adada', 'Adida', 'Anggota BEM', 2, '2014-08-18 00:00:00', '2014-08-18', '11:23:00', '2014-08-18', '12:23:00', 'WAITING');

-- --------------------------------------------------------

--
-- Struktur dari tabel `beasiswa`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data untuk tabel `beasiswa`
--

INSERT INTO `beasiswa` (`Id_Beasiswa`, `Id_JB`, `Id_Pengguna`, `Id_Jurusan`, `Id_Periode`, `Jenjang`, `Alamat_Sekarang`, `Nama_PT`, `Semester`, `IPK`, `Prestasi`, `Alasan`, `BANK`, `No_Rekening`, `Tanggal_Daftar`, `Status_Beasiswa`) VALUES
(37, 2, 8, 1, 2, 'STRATA 1', 'Ngemplak', 'STMIK AMIKOM YOGYAKARTA', 4, '4', 'Juara Lomba Menyanyi', 'Meringankan Beban Orang Tua', 'MUAMALAT', 2110999199, '2014-08-02', 'WAITING'),
(36, 2, 7, 6, 2, 'DIPLOMA 3', 'Condong Catur', 'STMIK AMIKOM YOGYAKARTA', 4, '3', 'Juara Lari Nasional', 'Meringankan Beban Orang Tua', 'MUAMALAT', 2089991891, '2014-08-01', 'WAITING'),
(35, 3, 5, 4, 2, 'STRATA 1', 'Bantul', 'STMIK AMIKOM YOGYAKARTA', 6, '3', 'Lomba Karauke', 'Meringankan Beban Orang Tua', 'MUAMALAT', 1243554322, '2014-08-01', 'WAITING'),
(34, 1, 4, 6, 2, 'DIPLOMA 3', 'Amerika', 'STMIK AMIKOM YOGYAKARTA', 4, '3', 'Jurara Olimpiade Matematika', 'Meringankan Beban Orang Tua', 'MUAMALAT', 1342345342, '2014-08-17', 'WAITING'),
(33, 1, 3, 5, 2, 'DIPLOMA 3', 'Yogyakarta', 'STMIK AMIKOM YOGYAKARTA', 6, '4', 'Juara 1 Lomba Paduan Suara', 'Meringankan Beban Orang Tua', 'MUAMALAT', 1234567890, '2014-08-01', 'WAITING'),
(38, 1, 9, 1, 2, 'STRATA 1', 'Kalasan', 'STMIK AMIKOM YOGYAKARTA', 4, '2', 'Juara Nyanyi', 'Meringannkan Beban Orang Tua', 'MUAMALAT', 1098900991, '2014-08-01', 'WAITING'),
(39, 3, 10, 5, 2, 'DIPLOMA 3', 'Kalasan', 'STMIK AMIKOM YOGYAKARTA', 2, '4', 'Lomba Juara Nyanyi', 'Meringankan Beban Ortu', 'MUAMALAT', 1123123112, '2014-08-03', 'WAITING'),
(40, 2, 11, 5, 2, 'DIPLOMA 3', 'Candi Gebang', 'STMIK AMIKOM YOGYAKARTA', 4, '3', 'Juara Lari Nasional', 'Membahagiakan Orang Tua', 'MUAMALAT', 2109090111, '2014-08-02', 'WAITING'),
(41, 3, 12, 5, 2, 'DIPLOMA 3', 'Ngemplak', 'STMIK AMIKOM YOGYAKARTA', 4, '4', 'Juara Menyanyi', 'Meringankan beban Orang Tua', 'MUAMALAT', 1232122123, '2014-08-01', 'WAITING'),
(42, 2, 13, 6, 2, 'DIPLOMA 3', 'Candi Indah', 'STMIK AMIKOM YOGYAKARTA', 6, '3', 'Juara menyanyi', 'Meringankan Beban Orang Tua', 'MUAMALAT', 2111090911, '2014-08-02', 'WAITING'),
(43, 3, 14, 5, 2, 'DIPLOMA 3', 'Kaliurang', 'STMIK AMIKOM YOGYAKARTA', 4, '4', 'Juara Menynenyi', 'Meringankan Beban Ortu', 'MUAMALAT', 1212220901, '2014-08-01', 'WAITING'),
(44, 2, 15, 5, 2, 'DIPLOMA 3', 'Ngemplak', 'STMIK AMIKOM YOGYAKARTA', 4, '4', 'Juara Menyanyi', 'Meringankan beban Orang Tua', 'MUAMALAT', 2110901111, '2014-08-02', 'WAITING'),
(45, 2, 16, 4, 2, 'STRATA 1', 'Yogyakarta', 'STMIK AMIKOM YOGYAKARTA', 6, '3', 'Lomba Lari NAsional', 'Meringaknan Bebean Orang Tua', 'MUAMALAT', 2112122111, '2014-08-02', 'WAITING'),
(46, 2, 17, 5, 2, 'DIPLOMA 3', 'Ngemplak', 'STMIK AMIKOM YOGYAKARTA', 4, '4', 'Juara menyanyi', 'Meringankan Beabn Orang Tua', 'MUAMALAT', 2111090911, '2014-08-02', 'WAITING'),
(47, 1, 18, 1, 2, 'STRATA 1', 'Kalasan', 'STMIK AMIKOM YOGYAKARTA', 2, '2', 'Tidak Punya Prestasi', 'Meringankan Beban Orang tua', 'MUAMALAT', 1212322111, '2014-08-02', 'WAITING'),
(48, 3, 19, 4, 2, 'STRATA 1', 'Mlati', 'STMIK AMIKOM YOGYAKARTA', 2, '4', 'Tidak ada', 'Meringankan beban Orang Tua', 'MUAMALAT', 1223221122, '2014-08-02', 'WAITING'),
(49, 3, 20, 1, 2, 'STRATA 1', 'Minomartani', 'STMIK AMIKOM YOGYAKARTA', 4, '4', 'Ga ada', 'Meringankan Beban Orang Tua', 'MUAMALAT', 2112121112, '2014-08-02', 'WAITING'),
(56, 3, 25, 1, 2, 'STRATA 1', 'xxx', 'STMIK AMIKOM YOGYAKARTA', 4, '3', 'xx', 'xx', 'MUAMALAT', 22, '2014-08-19', 'WAITING');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_pendaftaran`
--

CREATE TABLE IF NOT EXISTS `histori_pendaftaran` (
  `Id_Pengguna` int(10) NOT NULL,
  `Id_Periode` int(10) NOT NULL,
  `Id_Beasiswa` int(10) NOT NULL,
  `Id_Asuransi` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histori_pendaftaran`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
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
-- Dumping data untuk tabel `informasi`
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
-- Struktur dari tabel `jenis_beasiswa`
--

CREATE TABLE IF NOT EXISTS `jenis_beasiswa` (
  `Id_JB` int(10) NOT NULL AUTO_INCREMENT,
  `Jenis_Beasiswa` varchar(10) NOT NULL,
  `Warna_Beasiswa` varchar(10) DEFAULT NULL,
  `Keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id_JB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `jenis_beasiswa`
--

INSERT INTO `jenis_beasiswa` (`Id_JB`, `Jenis_Beasiswa`, `Warna_Beasiswa`, `Keterangan`) VALUES
(1, 'PPA', '#FF0000', 'Beasiswa untuk Mahasiswa yang Berprestasi dibidang akademik dan organisasi'),
(2, 'BBP/PPA', '#FFFF00', 'Beasiswa Bantuan Biaya Pendidikan'),
(3, 'Muamalat', '#800080', 'Beasiswa dari Bank Muamalat Khusus Semester 1 dan 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `Id_Jurusan` int(10) NOT NULL AUTO_INCREMENT,
  `Nama_Jurusan` varchar(50) NOT NULL,
  `Singkatan_Jurusan` char(4) NOT NULL,
  `Warna_Jurusan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Jurusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`Id_Jurusan`, `Nama_Jurusan`, `Singkatan_Jurusan`, `Warna_Jurusan`) VALUES
(1, 'S1 Sistem Informasi', 'S1SI', '#0000FF'),
(4, 'S1 Teknik Informatika', 'S1TI', '#FF0000'),
(5, 'D3 Manajemen Informatika', 'D3MI', '#FF0000'),
(6, 'D3 Teknik Informatika', 'D3TI', '#A52A2A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`Id_Pengguna`, `Id_Level`, `Nama_Pengguna`, `Status_Pengguna`, `NIK_NIM`, `Password`, `Gender`, `No_Telp`, `Alamat`, `Tempat_Lahir`, `Tanggal_Lahir`, `Nama_Ortu`, `Alamat_Ortu`, `No_Telp_Ortu`, `Pekerjaan_Ortu`, `Penghasilan_Ortu`, `Jml_Tanggungan`, `Email`, `Online`, `Sesi`) VALUES
(1, 1, 'Urip Tri Prastowo', 'MAHASISWA', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'PRIA', 2147483647, 'Yogyakarta', 'Yogyakarta', '1993-04-21', 'John Mayer', 'Yogyakarta', 2147483647, 'WIRASWASTA', 30000000, 2, 'prastt21@gmail.com', 1, '2014-08-25 11:16:39'),
(2, 2, 'Praditya Kurniawan', 'KARYAWAN', 'operator', '4b583376b2767b923c3e1da60d10de59', 'WANITA', 2147483647, 'Yogyakarta', 'Yogyakarta', '1992-01-06', 'Waljinah', 'Jakarta', 2147483647, 'NELAYAN/PETANI', 89990000, 0, 'aku@masiyak.com', 0, '2014-08-17 21:56:30'),
(3, 3, 'Ratnasari Handaningrum', 'MAHASISWA', '11.02.8042', '9c25e12ed01a7720613081442e598f0a', 'WANITA', 2147483647, 'Yogyakarta', 'Yogyakarta', '1989-07-04', 'Tumini', 'Brebes', 27488990, 'TNI/POLRI', 10000000, 1, 'ratna@amikom.ac.id', 0, '2014-08-18 12:21:32'),
(4, 3, 'Arga Saputra\r\n', 'MAHASISWA', '11.01.2816', '1c874ae2c295e7d824a09d2df9535100', 'PRIA', 988899900, 'Tegal', 'Tegal', '1991-02-12', 'Warimin', 'Tegal', 2147483647, 'NELAYAN/PETANI', 67000000, 2, 'arga@amikom.ac.id', 0, '2014-08-17 16:33:02'),
(5, 3, 'Ita Wulandari\r\n', 'MAHASISWA', '11.01.2817', '3544fdc22d5a3e224659d896ca719e52', 'PRIA', 908889000, 'Jogja', 'Jogja', '1990-08-08', 'Jumadi', 'Jakarta', 2147483647, 'TNI/POLRI', 2000000, 0, 'agus@amikom.ac.id', 0, '2014-08-17 22:00:44'),
(7, 3, 'Hartanto', 'MAHASISWA', '11.01.2818', '9dc0e020b4c9e0299a97849451098f51', 'PRIA', 2147483647, 'Jember', 'Jember', '1990-08-01', 'Sarimin', 'Jember', 2147483647, 'PEGAWAI SWASTA', 45000000, 2, 'hartanto@amikom.ac.i', 1, '2014-08-17 20:16:29'),
(8, 3, 'Gerry Hermawan', 'MAHASISWA', '11.01.2819', '9077f98d0d08b907866409f267067ba2', 'PRIA', 2147483647, 'Singkawang', 'Singkawang', '1989-03-16', 'Singa', 'Singkawang', 2147483647, 'WIRASWASTA', 5000000, 4, 'gerry@amikom.ac.id', 1, '2014-08-17 20:23:39'),
(9, 3, 'ANTONIUS HERU WINDARTO', 'MAHASISWA', '11.01.2820', '05747d4cfe54165ac9717271f8799d14', 'PRIA', 2147483647, 'Sayegan', 'Sayegan', '1990-02-06', 'Jumadi', 'Sayegan', 2147483647, 'NELAYAN/PETANI', 450000, 2, 'anto@amikom.ac.id', 1, '2014-08-17 20:31:25'),
(10, 3, 'Ridho Ilyasa', 'MAHASISWA', '11.01.2821', '00d8bd320975cd752f1dd3247e73c236', 'PRIA', 2147483647, 'Jogja', 'Belanda', '2014-08-01', 'Jumanji', 'Jogja', 2147483647, 'WIRASWASTA', 400000, 1, 'ridho@amikom.ac.id', 1, '2014-08-17 20:46:56'),
(11, 3, 'Heri Nugraha', 'MAHASISWA', '11.02.7901', '5556cbe639707d8c747fe11710d26fa5', 'PRIA', 2147483647, 'Banjar', 'Banjar', '1990-08-12', 'Rani', 'Banjar', 2147483647, 'LAINNYA', 300000, 3, 'heri@amikom.ac.id', 1, '2014-08-17 20:54:27'),
(12, 3, 'M.Thoriq Fauzi', 'MAHASISWA', '11.02.7902', '3bc0e458b4efd1ad901865901b9cacb4', 'PRIA', 2147483647, 'Kebumen', 'Kebumen', '1990-08-20', 'Jumadi', 'Kebumen', 2147483647, 'WIRASWASTA', 23445000, 5, 'Thoriq@amikom.ac.id', 1, '2014-08-17 21:06:24'),
(13, 3, 'Juldy Armin', 'MAHASISWA', '11.02.7905', '23f0b6a56872edb0cac1314c5ad06638', 'WANITA', 2147483647, 'Johor Baru', 'Johor Baru', '1992-08-11', 'Huda', 'Johor Baru', 2147483647, 'PEGAWAI SWASTA', 8000000, 2, 'juldy@amikom.ac.id', 1, '2014-08-17 21:10:52'),
(14, 3, 'Agus Setiawan', 'MAHASISWA', '11.02.7909', 'ef9a2eaed093211af9b23b7aa825b292', 'PRIA', 2147483647, 'Gamping', 'Gamping', '1993-08-01', 'Gajah Seno', 'Gamping', 2147483647, 'TNI/POLRI', 6000000, 3, 'agus@amikom.ac.id', 1, '2014-08-17 21:15:06'),
(15, 3, 'Catur Ragil', 'MAHASISWA', '11.02.7910', 'a3378f028bb9248765db15faa462e53a', 'WANITA', 2147483647, 'Sayegan', 'Sayegan', '1996-08-23', 'Sayenan', 'Jogjakarta', 2147483647, 'PEGAWAI SWASTA', 4000000, 2, 'catur@amikom.ac.id', 1, '2014-08-17 21:21:27'),
(16, 3, 'Hartini', 'MAHASISWA', '11.02.7916', '8b8f0660d25c935298d52bf7962c4785', 'WANITA', 2147483647, 'Jogja', 'Jogja', '1989-08-03', 'Jarudin', 'Jogja', 2147483647, 'TNI/POLRI', 5000000, 4, 'hartiini@amikom.ac.i', 1, '2014-08-17 21:26:38'),
(17, 3, 'Reza Purnama', 'MAHASISWA', '11.02.7922', '5014e0701b9ff7e8669d0ee73042f504', 'PRIA', 2147483647, 'Ngemplak', 'Ngemplak', '1992-08-02', 'Huriah', 'Ngemplak', 2147483647, 'LAINNYA', 3000000, 5, 'reza@amikom.ac.id', 1, '2014-08-17 21:34:18'),
(18, 3, 'Ella Oktaria', 'MAHASISWA', '11.02.7930', '12232e6a87efaa9f9a153802f27646ab', 'PRIA', 5667, 'Purwokerto', 'Purwokerto', '1995-08-02', 'Imam', 'Purwokerto', 2147483647, 'PEGAWAI SWASTA', 37000000, 3, 'ella@amikom.ac.id', 1, '2014-08-17 21:41:21'),
(19, 3, 'Panji Priambodo', 'MAHASISWA', '11.02.7933', 'c4f7db0dd1f437e0ce25621965dd76e2', 'WANITA', 2147483647, 'Maos', 'Maos', '1997-08-20', 'Musa', 'Yogyakarta', 2147483647, 'TNI/POLRI', 40000000, 4, 'panji@amikom.ac.id', 1, '2014-08-17 21:48:11'),
(20, 3, 'Anna Rubiyanti', 'MAHASISWA', '11.02.7936', '7d1538de8aee555294391ab8eb3b2972', 'WANITA', 67555, 'Cilacap', 'Cilacap', '1997-08-14', 'Rubiyantos', 'Cilacap', 455676554, 'TNI/POLRI', 50000000, 1, 'anna@amikom.ac.id', 0, '2014-08-17 21:52:15'),
(21, 3, 'Suyatmi Sulaeman', 'KARYAWAN', '190302019', '6e9a660b0fe52f497be2c4a3b37bae59', 'WANITA', 2147483647, 'Maguwoharjo', 'Cilacap', '1989-08-18', 'Suyar', 'Cilacap', 2147483647, 'LAINNYA', 2300000, 0, 'suyatmi@amikomac.id', 1, '2014-08-12 14:59:24'),
(22, 3, 'Kusnawi', 'KARYAWAN', '190302112', '485f73aa8550b3b122c37ef1dc91daf1', 'PRIA', 2147483647, 'Sagan', 'Sagan', '1989-08-02', 'Kusnawi', 'Sagan', 1221313, 'LAINNYA', 2900000, 0, 'kusnawi@amikom.ac.id', 1, '2014-08-11 15:02:50'),
(23, 3, 'Heri Sismoro', 'KARYAWAN', '190302057', '7b805f09639b2aba9206666f1aef9327', 'PRIA', 2147483647, 'Jogja', 'Jogja', '1989-08-01', 'Heri', 'Jogja', 2147483647, 'LAINNYA', 23000000, 1, 'heris@amikom.ac.id', 1, '2014-08-18 16:06:51'),
(24, 3, 'Rendy Yoga', 'MAHASISWA', '11.12.6315', 'b6bf4ead10e598e2ed937debab4f61b4', 'PRIA', 31314124, 'Ponorogo', 'Ponorogo', '1993-08-04', 'Reog', 'Ponorogo', 2147483647, 'PNS', 3000000, 2, 'rendyyoga@amikom.ac,', 1, '2014-08-08 15:16:10'),
(25, 3, 'Akbar Habibulloh', 'MAHASISWA', '11.12.6313', 'b715d6170823703a145b41360c8b57da', 'PRIA', 2147483647, 'Wonogiri', 'Wonogiri', '1993-08-02', 'Khalis', 'Wonogiri', 2147483647, 'PEGAWAI SWASTA', 4000000, 2, 'akbar@amikom.ac.id', 1, '2014-08-19 10:11:17'),
(26, 3, 'Devi Rakhmawati', 'MAHASISWA', '11.12.6306', 'e95aba5b8a19ba572a5cab6c0457a474', 'WANITA', 2147483647, 'Magelang', 'Magelang', '1990-08-07', 'Juminah', 'Magelang', 2147483647, 'PEGAWAI SWASTA', 1000000, 1, 'devi@amikom.ac.id', 1, '2014-08-06 15:19:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `Id_Periode` int(10) NOT NULL AUTO_INCREMENT,
  `Tahun` int(4) NOT NULL,
  `Keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id_Periode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`Id_Periode`, `Tahun`, `Keterangan`) VALUES
(2, 2014, 'Tahun Pemilu'),
(3, 2015, 'zdfhajhfba');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sistem`
--

CREATE TABLE IF NOT EXISTS `sistem` (
  `Status_Sistem` enum('AKTIF','TIDAK AKTIF') DEFAULT NULL,
  `Id_Periode` int(10) DEFAULT NULL,
  `Pengumuman_Sistem` text,
  `StatusRequest_Sistem` enum('AKTIF','TIDAK AKTIF') DEFAULT NULL,
  `KarReq_Sistem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sistem`
--

INSERT INTO `sistem` (`Status_Sistem`, `Id_Periode`, `Pengumuman_Sistem`, `StatusRequest_Sistem`, `KarReq_Sistem`) VALUES
('AKTIF', 3, 'Jika Ada Kesulitan dalam menggunakan sistem ini silahkan hubungi Urip Tri Prastowo, 085647993380', 'AKTIF', 45000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_level`
--

CREATE TABLE IF NOT EXISTS `sys_level` (
  `Id_Level` int(1) NOT NULL AUTO_INCREMENT,
  `Nama_Level` varchar(15) NOT NULL,
  `Deskripsi_Level` varchar(70) NOT NULL,
  `Portal_Level` varchar(40) NOT NULL,
  PRIMARY KEY (`Id_Level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `sys_level`
--

INSERT INTO `sys_level` (`Id_Level`, `Nama_Level`, `Deskripsi_Level`, `Portal_Level`) VALUES
(1, 'ADMINISTRATOR', 'Super User', 'dashboard'),
(2, 'OPERATOR', 'Operator', 'dashboard'),
(3, 'PENGGUNA', 'Mahasiswa dan Karyawan', 'dashboard');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_level_menu`
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
-- Dumping data untuk tabel `sys_level_menu`
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
-- Struktur dari tabel `sys_menu`
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
-- Dumping data untuk tabel `sys_menu`
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
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `asuransi`
--
ALTER TABLE `asuransi`
  ADD CONSTRAINT `asuransi_ibfk_1` FOREIGN KEY (`Id_Pengguna`) REFERENCES `pengguna` (`Id_Pengguna`);

--
-- Ketidakleluasaan untuk tabel `sys_level_menu`
--
ALTER TABLE `sys_level_menu`
  ADD CONSTRAINT `sys_level_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `sys_menu` (`id_menu`),
  ADD CONSTRAINT `sys_level_menu_ibfk_2` FOREIGN KEY (`id_level`) REFERENCES `sys_level` (`Id_Level`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
