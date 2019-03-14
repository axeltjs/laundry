# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.3.10-MariaDB)
# Database: laundry
# Generation Time: 2019-03-14 05:16:40 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table rincian_pembelian
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rincian_pembelian`;

CREATE TABLE `rincian_pembelian` (
  `no_rincian` int(11) NOT NULL AUTO_INCREMENT,
  `no_pembelian` char(5) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`no_rincian`),
  KEY `no_pembelian` (`no_pembelian`),
  KEY `kd_barang` (`kd_barang`),
  CONSTRAINT `rincian_pembelian_ibfk_1` FOREIGN KEY (`no_pembelian`) REFERENCES `tb_pembelian` (`no_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rincian_pembelian_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `kurangi_stok_brg` AFTER DELETE ON `rincian_pembelian` FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok - old.jumlah WHERE tb_barang.kd_barang = old.kd_barang */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table rincian_transaksi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rincian_transaksi`;

CREATE TABLE `rincian_transaksi` (
  `id_rincian` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` char(5) NOT NULL,
  `id_jenis_pakaian` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(3) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id_rincian`),
  KEY `no_transaksi` (`no_transaksi`),
  KEY `id_jenis_pakaian` (`id_jenis_pakaian`),
  CONSTRAINT `rincian_transaksi_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `tb_transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rincian_transaksi_ibfk_2` FOREIGN KEY (`id_jenis_pakaian`) REFERENCES `tb_tarif` (`id_jenis_pakaian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tb_barang
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_barang`;

CREATE TABLE `tb_barang` (
  `kd_barang` char(5) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `tgl_stok` date NOT NULL,
  `satuan` varchar(3) NOT NULL,
  `harga` float NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tb_barang` WRITE;
/*!40000 ALTER TABLE `tb_barang` DISABLE KEYS */;

INSERT INTO `tb_barang` (`kd_barang`, `nm_barang`, `stok`, `tgl_stok`, `satuan`, `harga`)
VALUES
	('BR001','Rinso',39,'2016-02-23','Pcs',10000),
	('BR002','Molto',30,'2016-02-24','Btl',8000),
	('BR003','Daia',7,'2016-02-25','Pcs',8000),
	('BR004','Byeclean',6,'2016-02-25','Btl',7000);

/*!40000 ALTER TABLE `tb_barang` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tb_jenis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_jenis`;

CREATE TABLE `tb_jenis` (
  `id_jenis` char(5) NOT NULL,
  `nm_jenis` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tb_jenis` WRITE;
/*!40000 ALTER TABLE `tb_jenis` DISABLE KEYS */;

INSERT INTO `tb_jenis` (`id_jenis`, `nm_jenis`)
VALUES
	('JL001','Express'),
	('JL002','Normal'),
	('JL003','Cuci Kering'),
	('JL004','Cuci + Strika');

/*!40000 ALTER TABLE `tb_jenis` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `hapus_data_tarif` AFTER DELETE ON `tb_jenis` FOR EACH ROW DELETE FROM tb_tarif WHERE tb_tarif.id_jenis = old.id_jenis */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table tb_konsumen
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_konsumen`;

CREATE TABLE `tb_konsumen` (
  `kd_konsumen` char(5) NOT NULL,
  `nm_konsumen` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  PRIMARY KEY (`kd_konsumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tb_konsumen` WRITE;
/*!40000 ALTER TABLE `tb_konsumen` DISABLE KEYS */;

INSERT INTO `tb_konsumen` (`kd_konsumen`, `nm_konsumen`, `alamat`, `telp`)
VALUES
	('K0001','Axel TJs','jl.adam malik','082154981441'),
	('K0002','Rudi','Jl. Poros Anggana','081345672890'),
	('K0003','Andre','Jl. Tarmidi','085234781909'),
	('K0004','Sari','Jl. Bung Tomo','089238975778');

/*!40000 ALTER TABLE `tb_konsumen` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tb_login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_login`;

CREATE TABLE `tb_login` (
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `typeuser` varchar(10) NOT NULL,
  `nm_karyawan` varchar(30) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenkel` enum('L','P') DEFAULT NULL,
  `telp` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tb_login` WRITE;
/*!40000 ALTER TABLE `tb_login` DISABLE KEYS */;

INSERT INTO `tb_login` (`username`, `password`, `typeuser`, `nm_karyawan`, `nik`, `alamat`, `jenkel`, `telp`)
VALUES
	('admin','21232f297a57a5a743894a0e4a801fc3','admin','Axel Saputra','460202210980003','Samarinda','L','082154981441'),
	('santi','21232f297a57a5a743894a0e4a801fc3','operator','Susanti','460201010960001','Tenggarong','P','08115544192'),
	('susanto','21232f297a57a5a743894a0e4a801fc3','kasir','Susanto','460200310940002','Balikpapan','L','085312930101');

/*!40000 ALTER TABLE `tb_login` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tb_pemakaian
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_pemakaian`;

CREATE TABLE `tb_pemakaian` (
  `kd_pengeluaran` char(5) NOT NULL,
  `nik` char(20) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`kd_pengeluaran`),
  KEY `nik` (`nik`),
  KEY `kd_barang` (`kd_barang`),
  CONSTRAINT `tb_pemakaian_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pemakaian_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `restok_stokbarang` AFTER DELETE ON `tb_pemakaian` FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok + old.jumlah WHERE tb_barang.kd_barang = old.kd_barang */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table tb_pembelian
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_pembelian`;

CREATE TABLE `tb_pembelian` (
  `no_pembelian` char(5) NOT NULL,
  `nik` char(20) NOT NULL,
  `id_supplier` char(5) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total` float NOT NULL,
  `sts` int(11) NOT NULL,
  PRIMARY KEY (`no_pembelian`),
  KEY `nik` (`nik`),
  KEY `id_supplier` (`id_supplier`),
  CONSTRAINT `tb_pembelian_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tb_supplier
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_supplier`;

CREATE TABLE `tb_supplier` (
  `id_supplier` char(5) NOT NULL,
  `nm_supplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tb_supplier` WRITE;
/*!40000 ALTER TABLE `tb_supplier` DISABLE KEYS */;

INSERT INTO `tb_supplier` (`id_supplier`, `nm_supplier`, `alamat`, `telp`)
VALUES
	('SP002','Indogrosir','Jl. Sempaja','081345768945'),
	('SP003','Alfamart','Jl. Hariadi','085265347838'),
	('SP004','Indomart','Jl. Merdeka','089287654389');

/*!40000 ALTER TABLE `tb_supplier` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tb_tarif
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_tarif`;

CREATE TABLE `tb_tarif` (
  `id_jenis_pakaian` char(5) NOT NULL,
  `id_jenis` char(5) NOT NULL,
  `nm_pakaian` varchar(50) NOT NULL,
  `tarif` float NOT NULL,
  PRIMARY KEY (`id_jenis_pakaian`),
  KEY `id_jenis` (`id_jenis`),
  CONSTRAINT `tb_tarif_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tb_tarif` WRITE;
/*!40000 ALTER TABLE `tb_tarif` DISABLE KEYS */;

INSERT INTO `tb_tarif` (`id_jenis_pakaian`, `id_jenis`, `nm_pakaian`, `tarif`)
VALUES
	('JP001','JL001','Kemeja',10000),
	('JP002','JL001','Jas',30000),
	('JP003','JL002','Celana',4000),
	('JP004','JL003','Blazzer',10000),
	('JP005','JL004','Semua Jenis',7000);

/*!40000 ALTER TABLE `tb_tarif` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tb_transaksi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `no_transaksi` char(5) NOT NULL,
  `kd_konsumen` char(5) NOT NULL,
  `nik` char(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tgl_ambil` date NOT NULL,
  `diskon` int(11) NOT NULL,
  `sts` int(11) NOT NULL,
  PRIMARY KEY (`no_transaksi`),
  KEY `kd_konsumen` (`kd_konsumen`),
  KEY `nik` (`nik`),
  CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`kd_konsumen`) REFERENCES `tb_konsumen` (`kd_konsumen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_no_trans` AFTER DELETE ON `tb_transaksi` FOR EACH ROW DELETE FROM rincian_transaksi WHERE rincian_transaksi.no_transaksi = old.no_transaksi */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
