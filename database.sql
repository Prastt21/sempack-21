/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.32 : Database - sempak_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sempak_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sempak_db`;

/*Table structure for table `asuransi` */

DROP TABLE IF EXISTS `asuransi`;

CREATE TABLE `asuransi` (
  `Id_Asuransi` char(5) NOT NULL,
  `Jenis_Asuransi` enum('KECELAKAAN','SAKIT') NOT NULL,
  `Id_Pengguna` char(5) NOT NULL,
  `Nama_RS` varchar(100) NOT NULL,
  `Alamat_RS` varchar(150) NOT NULL,
  `Tanggal_Masuk` date NOT NULL,
  `Tanggal_Keluar` date NOT NULL,
  `Total_Biaya` int(15) NOT NULL,
  `Santunan` int(15) DEFAULT NULL,
  PRIMARY KEY (`Id_Asuransi`),
  KEY `Id_Pengguna` (`Id_Pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `asuransi` */

/*Table structure for table `aula` */

DROP TABLE IF EXISTS `aula`;

CREATE TABLE `aula` (
  `Id_Pinjam_Aula` char(5) NOT NULL,
  `Id_Pengguna` char(5) NOT NULL,
  `Nama_Kegiatan` varchar(100) NOT NULL,
  `Ketua_Organisasi` varchar(100) NOT NULL,
  `Peserta` varchar(100) NOT NULL,
  `Jml_Peserta` int(3) NOT NULL,
  `Tanggal_Pinjam` date NOT NULL,
  `Waktu_Pinjam` time NOT NULL,
  `Tanggal_Selesai` date NOT NULL,
  `Waktu_Selesai` time NOT NULL,
  `Status_Penggunaan` int(1) NOT NULL,
  PRIMARY KEY (`Id_Pinjam_Aula`),
  KEY `Id_Pengguna` (`Id_Pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `aula` */

/*Table structure for table `beasiswa` */

DROP TABLE IF EXISTS `beasiswa`;

CREATE TABLE `beasiswa` (
  `Id_Beasiswa` char(5) NOT NULL,
  `Id_JB` char(5) NOT NULL,
  `Id_Pengguna` char(5) NOT NULL,
  `Id_Ortu` char(5) NOT NULL,
  `Id_Jurusan` char(5) NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `beasiswa` */

/*Table structure for table `informasi` */

DROP TABLE IF EXISTS `informasi`;

CREATE TABLE `informasi` (
  `Id_Informasi` char(5) NOT NULL,
  `Id_Login` char(5) NOT NULL,
  `Judul_Info` varchar(200) NOT NULL,
  `Isi_Info` varchar(1000) NOT NULL,
  `Jenis_Info` enum('Aula','Beasiswa','Asuransi') NOT NULL,
  `Tanggal_info` datetime NOT NULL,
  PRIMARY KEY (`Id_Informasi`),
  KEY `Id_Login` (`Id_Login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `informasi` */

/*Table structure for table `jenis_beasiswa` */

DROP TABLE IF EXISTS `jenis_beasiswa`;

CREATE TABLE `jenis_beasiswa` (
  `Id_JB` char(5) NOT NULL,
  `Jenis_Beasiswa` varchar(10) DEFAULT NULL,
  `Warna_Beasiswa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id_JB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jenis_beasiswa` */

insert  into `jenis_beasiswa`(`Id_JB`,`Jenis_Beasiswa`,`Warna_Beasiswa`) values ('JB001','PPA',NULL),('JB002','BBP/PPA',NULL);

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `Id_Jurusan` char(5) NOT NULL,
  `Nama_Jurusan` varchar(30) NOT NULL,
  `Singkatan_Jurusan` char(4) DEFAULT NULL,
  `Warna_Jurusan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jurusan` */

insert  into `jurusan`(`Id_Jurusan`,`Nama_Jurusan`,`Singkatan_Jurusan`,`Warna_Jurusan`) values ('JR001','S1 Teknik Informatika','S1TI','#7ef4f9'),('JR002','D3 Teknik Informatika','D3TI','#BADBF3'),('JR003','S1 Sistem Informasi','S1SI','#FF5B5B'),('JR004','D3 Manajemen Informatika','D3MI','#EFA0A0');

/*Table structure for table `keterangan_ortu` */

DROP TABLE IF EXISTS `keterangan_ortu`;

CREATE TABLE `keterangan_ortu` (
  `Id_Ortu` char(5) NOT NULL,
  `Id_Pengguna` char(5) NOT NULL,
  `Nama_Ortu` varchar(100) NOT NULL,
  `Alamat_Ortu` varchar(150) NOT NULL,
  `No_Telp_Ortu` int(15) NOT NULL,
  `Pekerjaan_Ortu` enum('PNS','PEGAWAI SWASTA','WIRASWASTA','TNI/POLRI','NELAYAN/PETANI','LAINNYA') DEFAULT NULL,
  `Penghasilan_Ortu` int(15) DEFAULT NULL,
  `Jml_Tanggungan` int(2) DEFAULT NULL,
  PRIMARY KEY (`Id_Ortu`),
  KEY `Id_Pengguna` (`Id_Pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `keterangan_ortu` */

/*Table structure for table `leveluser` */

DROP TABLE IF EXISTS `leveluser`;

CREATE TABLE `leveluser` (
  `Id_Level` char(5) NOT NULL,
  `Nama_Level` varchar(15) NOT NULL,
  `Deskripsi_Level` varchar(70) NOT NULL,
  `Portal_Level` varchar(40) NOT NULL,
  PRIMARY KEY (`Id_Level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `leveluser` */

insert  into `leveluser`(`Id_Level`,`Nama_Level`,`Deskripsi_Level`,`Portal_Level`) values ('LEV01','ADMINISTRATOR','Super User','dashboard'),('LEV02','OPERATOR','Operator','dashboard'),('LEV03','PENGGUNA','Mahasiswa dan Karyawan','dashboard_pengguna');

/*Table structure for table `loginuser` */

DROP TABLE IF EXISTS `loginuser`;

CREATE TABLE `loginuser` (
  `Id_Login` char(5) NOT NULL,
  `Username` varchar(150) NOT NULL,
  `Id_Level` char(5) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Online_Op` int(1) NOT NULL,
  `Sesi_Op` datetime NOT NULL,
  `Note_Op` varchar(500) NOT NULL,
  PRIMARY KEY (`Id_Login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `loginuser` */

insert  into `loginuser`(`Id_Login`,`Username`,`Id_Level`,`Password`,`Online_Op`,`Sesi_Op`,`Note_Op`) values ('1','admin','LEV01','21232f297a57a5a743894a0e4a801fc3',1,'2014-07-13 00:00:00','-');

/*Table structure for table `pendaftaran_asuransi` */

DROP TABLE IF EXISTS `pendaftaran_asuransi`;

CREATE TABLE `pendaftaran_asuransi` (
  `Id_Pengguna` char(5) NOT NULL,
  `Id_Periode` int(1) NOT NULL,
  `Tanggal_Daftar_Asuransi` datetime NOT NULL,
  `Id_Asuransi` char(5) NOT NULL,
  `Status_Asuransi` int(1) NOT NULL,
  KEY `Id_Pengguna` (`Id_Pengguna`),
  KEY `Id_Asuransi` (`Id_Asuransi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pendaftaran_asuransi` */

/*Table structure for table `pendaftaran_beasiswa` */

DROP TABLE IF EXISTS `pendaftaran_beasiswa`;

CREATE TABLE `pendaftaran_beasiswa` (
  `Id_Pengguna` char(5) NOT NULL,
  `Id_Periode` int(1) NOT NULL,
  `Tanggal_Daftar_Beasiswa` datetime NOT NULL,
  `Id_Beasiswa` char(5) NOT NULL,
  `Status_Beasiswa` int(1) NOT NULL,
  KEY `Id_Pengguna` (`Id_Pengguna`),
  KEY `Id_Beasiswa` (`Id_Beasiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pendaftaran_beasiswa` */

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `Id_Pengguna` char(5) NOT NULL,
  `Nama_Pengguna` varchar(150) NOT NULL,
  `Status_Pengguna` enum('MAHASISWA','KARYAWAN') NOT NULL,
  `NIK_NIM` varchar(10) NOT NULL,
  `Gender` enum('PRIA','WANITA') NOT NULL,
  `No_Telp` int(15) NOT NULL,
  `Alamat` varchar(400) NOT NULL,
  `Tempat_Lahir` varchar(20) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  PRIMARY KEY (`Id_Pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengguna` */

/*Table structure for table `periode` */

DROP TABLE IF EXISTS `periode`;

CREATE TABLE `periode` (
  `Id_Periode` int(1) NOT NULL,
  `Tahun` int(4) NOT NULL,
  PRIMARY KEY (`Id_Periode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `periode` */

insert  into `periode`(`Id_Periode`,`Tahun`) values (1,2013),(2,2014);

/*Table structure for table `request` */

DROP TABLE IF EXISTS `request`;

CREATE TABLE `request` (
  `Id_Request` char(5) NOT NULL,
  `Id_Login` char(5) NOT NULL,
  `Req_Tanya` varchar(200) NOT NULL,
  `Tgl_Tanya` date NOT NULL,
  `Req_Jawab` varchar(200) NOT NULL,
  `Tgl_Jawab` date NOT NULL,
  PRIMARY KEY (`Id_Request`),
  KEY `Id_Operator` (`Id_Login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `request` */

/*Table structure for table `sistem` */

DROP TABLE IF EXISTS `sistem`;

CREATE TABLE `sistem` (
  `Status_Sistem` enum('AKTIF','TIDAK AKTIF') NOT NULL,
  `Id_Periode` int(1) NOT NULL,
  `Pengumuman_Sistem` varchar(500) NOT NULL,
  `KonfKhusus_Sistem` varchar(100) DEFAULT NULL,
  `StatusRequest_Sistem` enum('AKTIF','TIDAK AKTIF') NOT NULL,
  `KarReq_Sistem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sistem` */

insert  into `sistem`(`Status_Sistem`,`Id_Periode`,`Pengumuman_Sistem`,`KonfKhusus_Sistem`,`StatusRequest_Sistem`,`KarReq_Sistem`) values ('AKTIF',2,'Perode Sistem Saat Ini Adalah Tahun 2014','theme=\"blue\"','AKTIF',20000);

/*Table structure for table `sys_level_menu` */

DROP TABLE IF EXISTS `sys_level_menu`;

CREATE TABLE `sys_level_menu` (
  `id_level_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `hak` varchar(4) NOT NULL,
  PRIMARY KEY (`id_level_menu`),
  KEY `fk_level_menu_menu1_idx` (`id_menu`),
  KEY `fk_level_menu_level1_idx` (`id_level`),
  CONSTRAINT `sys_level_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `sys_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `sys_level_menu` */

insert  into `sys_level_menu`(`id_level_menu`,`id_level`,`id_menu`,`hak`) values (1,0,1,'1111');

/*Table structure for table `sys_menu` */

DROP TABLE IF EXISTS `sys_menu`;

CREATE TABLE `sys_menu` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`id_menu`,`nama_menu`,`tampil`,`urutan`,`parent_id`,`deskripsi`,`link`,`icon`,`mdb`,`mdd`) values (1,'Dashboard',1,1,0,'Dashboard','dashboard',NULL,1,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
