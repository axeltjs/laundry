-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2016 at 03:42 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `rincian_pembelian`
--

CREATE TABLE IF NOT EXISTS `rincian_pembelian` (
  `no_rincian` int(11) NOT NULL AUTO_INCREMENT,
  `no_pembelian` char(5) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`no_rincian`),
  KEY `no_pembelian` (`no_pembelian`),
  KEY `kd_barang` (`kd_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `rincian_pembelian`
--

INSERT INTO `rincian_pembelian` (`no_rincian`, `no_pembelian`, `kd_barang`, `jumlah`) VALUES
(33, 'P0004', 'BR004', 5),
(34, 'P0004', 'BR002', 1),
(35, 'P0005', 'BR003', 2),
(36, 'P0006', 'BR003', 3),
(37, 'P0006', 'BR002', 3);

--
-- Triggers `rincian_pembelian`
--
DROP TRIGGER IF EXISTS `kurangi_stok_brg`;
DELIMITER //
CREATE TRIGGER `kurangi_stok_brg` AFTER DELETE ON `rincian_pembelian`
 FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok - old.jumlah WHERE tb_barang.kd_barang = old.kd_barang
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rincian_transaksi`
--

CREATE TABLE IF NOT EXISTS `rincian_transaksi` (
  `id_rincian` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` char(5) NOT NULL,
  `id_jenis_pakaian` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(3) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id_rincian`),
  KEY `no_transaksi` (`no_transaksi`),
  KEY `id_jenis_pakaian` (`id_jenis_pakaian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `rincian_transaksi`
--

INSERT INTO `rincian_transaksi` (`id_rincian`, `no_transaksi`, `id_jenis_pakaian`, `jumlah`, `satuan`, `total`) VALUES
(29, 'T0004', 'JP002', 2, 'Pcs', 30000),
(30, 'T0005', 'JP001', 4, 'Kg', 40000),
(32, 'T0006', 'JP001', 3, 'Kg', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE IF NOT EXISTS `tb_barang` (
  `kd_barang` char(5) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `tgl_stok` date NOT NULL,
  `satuan` varchar(3) NOT NULL,
  `harga` float NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kd_barang`, `nm_barang`, `stok`, `tgl_stok`, `satuan`, `harga`) VALUES
('BR001', 'Rinso', 39, '2016-02-23', 'Pcs', 10000),
('BR002', 'Molto', 30, '2016-02-24', 'Btl', 8000),
('BR003', 'Daia', 7, '2016-02-25', 'Pcs', 8000),
('BR004', 'Byeclean', 6, '2016-02-25', 'Btl', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE IF NOT EXISTS `tb_jenis` (
  `id_jenis` char(5) NOT NULL,
  `nm_jenis` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `nm_jenis`) VALUES
('JL001', 'Express'),
('JL002', 'Normal'),
('JL003', 'Cuci Kering'),
('JL004', 'Cuci + Strika');

--
-- Triggers `tb_jenis`
--
DROP TRIGGER IF EXISTS `hapus_data_tarif`;
DELIMITER //
CREATE TRIGGER `hapus_data_tarif` AFTER DELETE ON `tb_jenis`
 FOR EACH ROW DELETE FROM tb_tarif WHERE tb_tarif.id_jenis = old.id_jenis
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE IF NOT EXISTS `tb_karyawan` (
  `nik` char(20) NOT NULL,
  `nm_karyawan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(14) NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`nik`, `nm_karyawan`, `alamat`, `telp`, `jenkel`) VALUES
('12313231331313131313', 'mimin', 'jl.danau aji', '0812312313111', 'L'),
('1231341341414143123', 'Santi', 'Jl.jamaludin', '082143122112', 'P'),
('19283746591823456123', 'Ardiansah', 'Jl. Jamaludin Rt.2', '082144332215', 'L'),
('56345345242424242404', 'Jean Pierre Polnareff', 'De Bluoise, France', '0541663672', 'L'),
('87183713193173937817', 'Susanto', 'Jl.Udin', '0812312313111', 'L');

--
-- Triggers `tb_karyawan`
--
DROP TRIGGER IF EXISTS `delete_login`;
DELIMITER //
CREATE TRIGGER `delete_login` AFTER DELETE ON `tb_karyawan`
 FOR EACH ROW DELETE FROM tb_login WHERE tb_login.nik = old.nik
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsumen`
--

CREATE TABLE IF NOT EXISTS `tb_konsumen` (
  `kd_konsumen` char(5) NOT NULL,
  `nm_konsumen` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  PRIMARY KEY (`kd_konsumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_konsumen`
--

INSERT INTO `tb_konsumen` (`kd_konsumen`, `nm_konsumen`, `alamat`, `telp`) VALUES
('K0001', 'Axel TJs', 'jl.adam malik', '082154981441'),
('K0002', 'Rudi', 'Jl. Poros Anggana', '081345672890'),
('K0003', 'Andre', 'Jl. Tarmidi', '085234781909'),
('K0004', 'Sari', 'Jl. Bung Tomo', '089238975778');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE IF NOT EXISTS `tb_login` (
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `typeuser` varchar(10) NOT NULL,
  `nik` char(20) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`username`, `password`, `typeuser`, `nik`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '19283746591823456123'),
('mimin', '03f7f7198958ffbda01db956d15f134a', 'admin', '12313231331313131313'),
('polnareff', 'b9ede123ee2e3a02451eba2ec2730581', 'operator', '56345345242424242404'),
('santi', 'ae1d4b431ead52e5ee1788010e8ec110', 'operator', '1231341341414143123'),
('susanto', '5c06181e1485af4fc4051d2c5aa0caba', 'kasir', '87183713193173937817');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemakaian`
--

CREATE TABLE IF NOT EXISTS `tb_pemakaian` (
  `kd_pengeluaran` char(5) NOT NULL,
  `nik` char(20) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`kd_pengeluaran`),
  KEY `nik` (`nik`),
  KEY `kd_barang` (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemakaian`
--

INSERT INTO `tb_pemakaian` (`kd_pengeluaran`, `nik`, `kd_barang`, `jumlah`) VALUES
('U0001', '19283746591823456123', 'BR001', 2),
('U0002', '12313231331313131313', 'BR001', 10),
('U0003', '12313231331313131313', 'BR001', 5),
('U0004', '12313231331313131313', 'BR002', 5);

--
-- Triggers `tb_pemakaian`
--
DROP TRIGGER IF EXISTS `restok_stokbarang`;
DELIMITER //
CREATE TRIGGER `restok_stokbarang` AFTER DELETE ON `tb_pemakaian`
 FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok + old.jumlah WHERE tb_barang.kd_barang = old.kd_barang
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE IF NOT EXISTS `tb_pembelian` (
  `no_pembelian` char(5) NOT NULL,
  `nik` char(20) NOT NULL,
  `id_supplier` char(5) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total` float NOT NULL,
  `sts` int(11) NOT NULL,
  PRIMARY KEY (`no_pembelian`),
  KEY `nik` (`nik`),
  KEY `id_supplier` (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`no_pembelian`, `nik`, `id_supplier`, `tgl_pembelian`, `total`, `sts`) VALUES
('P0004', '12313231331313131313', 'SP003', '2016-02-25', 43000, 0),
('P0005', '19283746591823456123', 'SP004', '2016-02-25', 16000, 0),
('P0006', '1231341341414143123', 'SP002', '2016-02-25', 48000, 0),
('P0007', '12313231331313131313', 'SP004', '2016-02-25', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE IF NOT EXISTS `tb_supplier` (
  `id_supplier` char(5) NOT NULL,
  `nm_supplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nm_supplier`, `alamat`, `telp`) VALUES
('SP002', 'Indogrosir', 'Jl. Sempaja', '081345768945'),
('SP003', 'Alfamart', 'Jl. Hariadi', '085265347838'),
('SP004', 'Indomart', 'Jl. Merdeka', '089287654389');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE IF NOT EXISTS `tb_tarif` (
  `id_jenis_pakaian` char(5) NOT NULL,
  `id_jenis` char(5) NOT NULL,
  `nm_pakaian` varchar(50) NOT NULL,
  `tarif` float NOT NULL,
  PRIMARY KEY (`id_jenis_pakaian`),
  KEY `id_jenis` (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_jenis_pakaian`, `id_jenis`, `nm_pakaian`, `tarif`) VALUES
('JP001', 'JL001', 'Kemeja', 10000),
('JP002', 'JL001', 'Jas', 30000),
('JP003', 'JL002', 'Celana', 4000),
('JP004', 'JL003', 'Blazzer', 10000),
('JP005', 'JL004', 'Semua Jenis', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `no_transaksi` char(5) NOT NULL,
  `kd_konsumen` char(5) NOT NULL,
  `nik` char(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tgl_ambil` date NOT NULL,
  `diskon` int(11) NOT NULL,
  `sts` int(11) NOT NULL,
  PRIMARY KEY (`no_transaksi`),
  KEY `kd_konsumen` (`kd_konsumen`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_transaksi`, `kd_konsumen`, `nik`, `tgl_transaksi`, `tgl_ambil`, `diskon`, `sts`) VALUES
('T0004', 'K0003', '87183713193173937817', '2016-02-25', '2016-02-29', 0, 0),
('T0005', 'K0002', '87183713193173937817', '2016-02-25', '2016-02-26', 0, 0),
('T0006', 'K0004', '12313231331313131313', '2016-02-25', '2016-02-26', 0, 0),
('T0007', 'K0004', '12313231331313131313', '2016-02-25', '2016-02-25', 0, 1);

--
-- Triggers `tb_transaksi`
--
DROP TRIGGER IF EXISTS `delete_no_trans`;
DELIMITER //
CREATE TRIGGER `delete_no_trans` AFTER DELETE ON `tb_transaksi`
 FOR EACH ROW DELETE FROM rincian_transaksi WHERE rincian_transaksi.no_transaksi = old.no_transaksi
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rincian_pembelian`
--
ALTER TABLE `rincian_pembelian`
  ADD CONSTRAINT `rincian_pembelian_ibfk_1` FOREIGN KEY (`no_pembelian`) REFERENCES `tb_pembelian` (`no_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rincian_pembelian_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rincian_transaksi`
--
ALTER TABLE `rincian_transaksi`
  ADD CONSTRAINT `rincian_transaksi_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `tb_transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rincian_transaksi_ibfk_2` FOREIGN KEY (`id_jenis_pakaian`) REFERENCES `tb_tarif` (`id_jenis_pakaian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD CONSTRAINT `tb_login_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pemakaian`
--
ALTER TABLE `tb_pemakaian`
  ADD CONSTRAINT `tb_pemakaian_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pemakaian_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `tb_pembelian_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD CONSTRAINT `tb_tarif_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`kd_konsumen`) REFERENCES `tb_konsumen` (`kd_konsumen`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
