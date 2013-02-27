-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2013 at 11:40 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_rotom`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar_cicilan`
--

CREATE TABLE IF NOT EXISTS `tb_bayar_cicilan` (
  `nomor_bayar` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kredit` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`nomor_bayar`),
  KEY `kode_kredit` (`kode_kredit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tb_bayar_cicilan`
--

INSERT INTO `tb_bayar_cicilan` (`nomor_bayar`, `kode_kredit`, `tanggal_bayar`, `jumlah`, `keterangan`) VALUES
(18, 6, '2012-02-19', 1073333, ''),
(19, 6, '2012-02-19', 1073333, ''),
(20, 6, '2012-02-19', 1073333, ''),
(21, 6, '2012-02-19', 1073333, ''),
(22, 6, '2012-02-19', 1073333, ''),
(23, 6, '2012-02-19', 1073333, ''),
(24, 6, '2012-02-19', 1073333, ''),
(25, 6, '2012-02-19', 1073333, ''),
(26, 6, '2012-02-19', 1073333, ''),
(27, 6, '2012-02-19', 1073333, ''),
(28, 6, '2012-02-19', 1073333, ''),
(29, 6, '2012-02-19', 1073333, ''),
(30, 6, '2012-02-19', 1073333, ''),
(31, 6, '2012-02-19', -1073329, ''),
(32, 8, '2013-02-19', 767000, ''),
(33, 8, '2013-02-19', 767000, ''),
(34, 8, '2013-02-19', 767000, ''),
(35, 8, '2013-02-19', 767000, ''),
(36, 9, '2013-02-20', 2100000, ''),
(37, 9, '2013-02-20', 2100000, ''),
(38, 9, '2013-02-20', 10500000, ''),
(39, 10, '2013-02-20', 1210000, ''),
(40, 8, '2013-02-20', 767000, ''),
(41, 11, '2013-02-21', 1210000, ''),
(42, 12, '2013-02-21', 2420000, ''),
(43, 12, '2013-02-21', 2420000, ''),
(44, 12, '2013-02-21', 2420000, ''),
(45, 12, '2013-02-21', 2420000, ''),
(46, 12, '2013-02-21', 2420000, ''),
(47, 11, '2013-02-21', 1210000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_beli_cash`
--

CREATE TABLE IF NOT EXISTS `tb_beli_cash` (
  `kode_cash` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_cash` date NOT NULL,
  `kode_customer` int(11) NOT NULL,
  `kode_motor` int(11) NOT NULL,
  `warna` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `harga_deal` int(11) NOT NULL,
  PRIMARY KEY (`kode_cash`),
  KEY `kode_customer` (`kode_customer`),
  KEY `kode_motor` (`kode_motor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tb_beli_cash`
--

INSERT INTO `tb_beli_cash` (`kode_cash`, `tanggal_cash`, `kode_customer`, `kode_motor`, `warna`, `keterangan`, `harga_deal`) VALUES
(5, '2012-02-18', 1, 1, 'merah', 'lunas', 12000000),
(6, '2012-02-18', 1, 1, 'hitam', 'lunas', 12000000),
(7, '2012-02-19', 3, 1, 'merah', 'lunas', 12000000),
(8, '2013-02-20', 5, 2, 'putih', 'grgtrg', 13500000),
(9, '2013-02-20', 4, 4, 'pink', 'berhasil', 15000000),
(10, '2013-02-21', 4, 1, 'hitam', 'ggkgk', 12000000),
(11, '2013-02-23', 4, 1, 'hitam', 'frerf', 12000000);

--
-- Triggers `tb_beli_cash`
--
DROP TRIGGER IF EXISTS `updateStok`;
DELIMITER //
CREATE TRIGGER `updateStok` AFTER INSERT ON `tb_beli_cash`
 FOR EACH ROW begin
update tb_motor 
set stok = stok-1
where kode_motor = new.kode_motor;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_beli_kredit`
--

CREATE TABLE IF NOT EXISTS `tb_beli_kredit` (
  `kode_kredit` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_kredit` date NOT NULL,
  `kode_customer` int(11) NOT NULL,
  `kode_motor` int(11) NOT NULL,
  `warna` varchar(15) NOT NULL,
  `uang_muka` int(11) NOT NULL,
  `lama_cicilan` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `harga_deal` int(11) NOT NULL,
  PRIMARY KEY (`kode_kredit`),
  KEY `kode_customer` (`kode_customer`),
  KEY `kode_motor` (`kode_motor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tb_beli_kredit`
--

INSERT INTO `tb_beli_kredit` (`kode_kredit`, `tanggal_kredit`, `kode_customer`, `kode_motor`, `warna`, `uang_muka`, `lama_cicilan`, `sisa`, `keterangan`, `harga_deal`) VALUES
(6, '2012-02-19', 1, 1, 'merah', 500000, 12, 0, 'nyicil', 12880000),
(7, '2013-02-19', 3, 1, 'hitam', 500000, 10, 12650000, 'ferf', 12650000),
(8, '2013-02-19', 4, 2, 'putih', 500000, 20, 11505000, 'fer', 15340000),
(9, '2013-02-20', 5, 4, 'pink', 1000000, 7, 0, 'feubfu', 14700000),
(10, '2013-02-20', 3, 1, 'hitam', 1000000, 10, 10890000, 'gerg', 12100000),
(11, '2013-02-21', 4, 1, 'hitam', 1000000, 10, 9680000, '', 12100000),
(12, '2013-02-21', 1, 1, 'merah', 1000000, 5, 0, 'vheibgerig', 12100000),
(13, '2013-02-21', 4, 1, 'hitam', 1000000, 10, 12100000, '12', 12100000),
(14, '2013-02-23', 3, 5, 'Biru', 1000000, 10, 4400000, 'rrf', 4400000),
(15, '2013-02-23', 1, 5, 'Biru', 1000000, 10, 4400000, 'btb', 4400000);

--
-- Triggers `tb_beli_kredit`
--
DROP TRIGGER IF EXISTS `updateStokCredit`;
DELIMITER //
CREATE TRIGGER `updateStokCredit` AFTER INSERT ON `tb_beli_kredit`
 FOR EACH ROW begin
update tb_motor 
set stok = stok-1
where kode_motor = new.kode_motor;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bunga`
--

CREATE TABLE IF NOT EXISTS `tb_bunga` (
  `kode_bunga` int(11) NOT NULL AUTO_INCREMENT,
  `lama_cicilan` int(11) DEFAULT NULL,
  `bunga` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_bunga`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_bunga`
--

INSERT INTO `tb_bunga` (`kode_bunga`, `lama_cicilan`, `bunga`) VALUES
(1, 10, 10),
(2, 20, 18),
(3, 7, 5),
(4, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE IF NOT EXISTS `tb_customer` (
  `kode_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `hp` varchar(13) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `kk` varchar(16) NOT NULL,
  `slip_gaji` varchar(32) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`kode_customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`kode_customer`, `nama`, `alamat`, `telepon`, `hp`, `no_ktp`, `kk`, `slip_gaji`, `keterangan`) VALUES
(1, 'Dhio Faizar Wahyudi', 'jl mergan lori ', '081945304069', '081945304069', '123123', '213123', '1200000', 'lunas'),
(3, 'ade', 'sadl', '2131', '12312', '12380989', '9183098', '1830198', 'arema'),
(4, 'nurul huda mustaqim', 'trenggalek', '0823331012276', '082331012276', '1028741824612', '471287461', '5000000', ''),
(5, 'kevin mustaqim', 'trenggalek', '082331012276', '1083718246127', '7812647124871268', '1774187256487', '13000000', 'fnebfeurgf'),
(6, 'moklet', 'ferni', '83250987257', '37489137', '72857935', '37295627956', '1000000', 'fejfneri');

-- --------------------------------------------------------

--
-- Table structure for table `tb_motor`
--

CREATE TABLE IF NOT EXISTS `tb_motor` (
  `kode_motor` int(11) NOT NULL AUTO_INCREMENT,
  `merek` varchar(30) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(100) DEFAULT NULL,
  `stok` int(100) DEFAULT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`kode_motor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tb_motor`
--

INSERT INTO `tb_motor` (`kode_motor`, `merek`, `warna`, `harga`, `jumlah`, `stok`, `image`) VALUES
(1, 'yamaha', 'hitam,merah,putih', 12000000, 15, 11, ''),
(2, 'honda', 'putih', 13500000, 16, 13, ''),
(4, 'suzuki', 'pink', 15000000, 15, 14, ''),
(5, 'SMK TELKOM', 'Biru', 5000000, 4, 14, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email_user` varchar(30) NOT NULL,
  `password_user` varchar(32) NOT NULL,
  `permission` int(11) NOT NULL,
  `lastVisitDate` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `email_user`, `password_user`, `permission`, `lastVisitDate`) VALUES
(1, 'nurulhuda@gmail.com', '0075a4e7a2e71083262da135ecdbdd14', 1, '2013-02-23 09:20:23'),
(2, 'kevinmustaqim@gmail.com', '9d5e3ecdeb4cdb7acfd63075ae046672', 1, '2013-02-19 10:09:50'),
(3, 'huda@gmail.com', '0075a4e7a2e71083262da135ecdbdd14', 0, '2013-02-19 10:11:17'),
(4, 'febrian@gmail.com', '0075a4e7a2e71083262da135ecdbdd14', 1, '2013-02-20 02:25:10'),
(5, 'krandegan@gmail.com', '0075a4e7a2e71083262da135ecdbdd14', 1, '0000-00-00 00:00:00'),
(6, 'susi@gmail.com', '536931d80decb18c33db9612bdd004d4', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `v_cash`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_rotom`.`v_cash` AS (select `db_rotom`.`tb_beli_cash`.`kode_cash` AS `kode_cash`,`db_rotom`.`tb_beli_cash`.`tanggal_cash` AS `tanggal_cash`,`db_rotom`.`tb_customer`.`nama` AS `nama`,`db_rotom`.`tb_motor`.`merek` AS `merek`,`db_rotom`.`tb_beli_cash`.`harga_deal` AS `harga_deal`,`db_rotom`.`tb_beli_cash`.`warna` AS `warna` from ((`db_rotom`.`tb_beli_cash` join `db_rotom`.`tb_motor` on((`db_rotom`.`tb_motor`.`kode_motor` = `db_rotom`.`tb_beli_cash`.`kode_motor`))) join `db_rotom`.`tb_customer` on((`db_rotom`.`tb_customer`.`kode_customer` = `db_rotom`.`tb_beli_cash`.`kode_customer`))));

--
-- Dumping data for table `v_cash`
--

INSERT INTO `v_cash` (`kode_cash`, `tanggal_cash`, `nama`, `merek`, `harga_deal`, `warna`) VALUES
(5, '2012-02-18', 'Dhio Faizar Wahyudi', 'yamaha', 12000000, 'merah'),
(6, '2012-02-18', 'Dhio Faizar Wahyudi', 'yamaha', 12000000, 'hitam'),
(7, '2012-02-19', 'ade', 'yamaha', 12000000, 'merah'),
(10, '2013-02-21', 'nurul huda mustaqim', 'yamaha', 12000000, 'hitam'),
(11, '2013-02-23', 'nurul huda mustaqim', 'yamaha', 12000000, 'hitam'),
(9, '2013-02-20', 'nurul huda mustaqim', 'suzuki', 15000000, 'pink'),
(8, '2013-02-20', 'kevin mustaqim', 'honda', 13500000, 'putih');

-- --------------------------------------------------------

--
-- Table structure for table `v_cicilan`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_rotom`.`v_cicilan` AS (select `db_rotom`.`tb_bayar_cicilan`.`nomor_bayar` AS `nomor_bayar`,`db_rotom`.`tb_bayar_cicilan`.`kode_kredit` AS `kode_kredit`,`db_rotom`.`tb_bayar_cicilan`.`tanggal_bayar` AS `tanggal_bayar`,`db_rotom`.`tb_bayar_cicilan`.`jumlah` AS `jumlah`,`db_rotom`.`tb_beli_kredit`.`sisa` AS `sisa_bayar` from (`db_rotom`.`tb_bayar_cicilan` join `db_rotom`.`tb_beli_kredit` on((`db_rotom`.`tb_bayar_cicilan`.`kode_kredit` = `db_rotom`.`tb_beli_kredit`.`kode_kredit`))));

--
-- Dumping data for table `v_cicilan`
--

INSERT INTO `v_cicilan` (`nomor_bayar`, `kode_kredit`, `tanggal_bayar`, `jumlah`, `sisa_bayar`) VALUES
(18, 6, '2012-02-19', 1073333, 0),
(19, 6, '2012-02-19', 1073333, 0),
(20, 6, '2012-02-19', 1073333, 0),
(21, 6, '2012-02-19', 1073333, 0),
(22, 6, '2012-02-19', 1073333, 0),
(23, 6, '2012-02-19', 1073333, 0),
(24, 6, '2012-02-19', 1073333, 0),
(25, 6, '2012-02-19', 1073333, 0),
(26, 6, '2012-02-19', 1073333, 0),
(27, 6, '2012-02-19', 1073333, 0),
(28, 6, '2012-02-19', 1073333, 0),
(29, 6, '2012-02-19', 1073333, 0),
(30, 6, '2012-02-19', 1073333, 0),
(31, 6, '2012-02-19', -1073329, 0),
(32, 8, '2013-02-19', 767000, 11505000),
(33, 8, '2013-02-19', 767000, 11505000),
(34, 8, '2013-02-19', 767000, 11505000),
(35, 8, '2013-02-19', 767000, 11505000),
(40, 8, '2013-02-20', 767000, 11505000),
(36, 9, '2013-02-20', 2100000, 0),
(37, 9, '2013-02-20', 2100000, 0),
(38, 9, '2013-02-20', 10500000, 0),
(39, 10, '2013-02-20', 1210000, 10890000),
(41, 11, '2013-02-21', 1210000, 9680000),
(47, 11, '2013-02-21', 1210000, 9680000),
(42, 12, '2013-02-21', 2420000, 0),
(43, 12, '2013-02-21', 2420000, 0),
(44, 12, '2013-02-21', 2420000, 0),
(45, 12, '2013-02-21', 2420000, 0),
(46, 12, '2013-02-21', 2420000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `v_kredit`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_rotom`.`v_kredit` AS (select `db_rotom`.`tb_motor`.`kode_motor` AS `motor_kode_motor`,`db_rotom`.`tb_motor`.`merek` AS `merek`,`db_rotom`.`tb_motor`.`harga` AS `harga`,`db_rotom`.`tb_beli_kredit`.`kode_kredit` AS `kode_kredit`,`db_rotom`.`tb_beli_kredit`.`tanggal_kredit` AS `tanggal_kredit`,`db_rotom`.`tb_beli_kredit`.`kode_customer` AS `kode_customer`,`db_rotom`.`tb_beli_kredit`.`kode_motor` AS `kode_motor`,`db_rotom`.`tb_beli_kredit`.`warna` AS `warna`,`db_rotom`.`tb_beli_kredit`.`uang_muka` AS `uang_muka`,`db_rotom`.`tb_beli_kredit`.`lama_cicilan` AS `lama_cicilan`,`db_rotom`.`tb_beli_kredit`.`sisa` AS `sisa`,`db_rotom`.`tb_beli_kredit`.`keterangan` AS `keterangan`,`db_rotom`.`tb_beli_kredit`.`harga_deal` AS `harga_deal`,`db_rotom`.`tb_customer`.`kode_customer` AS `customer_kode_customer`,`db_rotom`.`tb_customer`.`nama` AS `nama` from ((`db_rotom`.`tb_beli_kredit` join `db_rotom`.`tb_motor` on((`db_rotom`.`tb_motor`.`kode_motor` = `db_rotom`.`tb_beli_kredit`.`kode_motor`))) join `db_rotom`.`tb_customer` on((`db_rotom`.`tb_customer`.`kode_customer` = `db_rotom`.`tb_beli_kredit`.`kode_customer`))));

--
-- Dumping data for table `v_kredit`
--

INSERT INTO `v_kredit` (`motor_kode_motor`, `merek`, `harga`, `kode_kredit`, `tanggal_kredit`, `kode_customer`, `kode_motor`, `warna`, `uang_muka`, `lama_cicilan`, `sisa`, `keterangan`, `harga_deal`, `customer_kode_customer`, `nama`) VALUES
(1, 'yamaha', 12000000, 6, '2012-02-19', 1, 1, 'merah', 500000, 12, 0, 'nyicil', 12880000, 1, 'Dhio Faizar Wahyudi'),
(1, 'yamaha', 12000000, 12, '2013-02-21', 1, 1, 'merah', 1000000, 5, 0, 'vheibgerig', 12100000, 1, 'Dhio Faizar Wahyudi'),
(5, 'SMK TELKOM', 5000000, 15, '2013-02-23', 1, 5, 'Biru', 1000000, 10, 4400000, 'btb', 4400000, 1, 'Dhio Faizar Wahyudi'),
(1, 'yamaha', 12000000, 7, '2013-02-19', 3, 1, 'hitam', 500000, 10, 12650000, 'ferf', 12650000, 3, 'ade'),
(1, 'yamaha', 12000000, 10, '2013-02-20', 3, 1, 'hitam', 1000000, 10, 10890000, 'gerg', 12100000, 3, 'ade'),
(5, 'SMK TELKOM', 5000000, 14, '2013-02-23', 3, 5, 'Biru', 1000000, 10, 4400000, 'rrf', 4400000, 3, 'ade'),
(1, 'yamaha', 12000000, 11, '2013-02-21', 4, 1, 'hitam', 1000000, 10, 9680000, '', 12100000, 4, 'nurul huda mustaqim'),
(1, 'yamaha', 12000000, 13, '2013-02-21', 4, 1, 'hitam', 1000000, 10, 12100000, '12', 12100000, 4, 'nurul huda mustaqim'),
(2, 'honda', 13500000, 8, '2013-02-19', 4, 2, 'putih', 500000, 20, 11505000, 'fer', 15340000, 4, 'nurul huda mustaqim'),
(4, 'suzuki', 15000000, 9, '2013-02-20', 5, 4, 'pink', 1000000, 7, 0, 'feubfu', 14700000, 5, 'kevin mustaqim');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bayar_cicilan`
--
ALTER TABLE `tb_bayar_cicilan`
  ADD CONSTRAINT `tb_bayar_cicilan_ibfk_1` FOREIGN KEY (`kode_kredit`) REFERENCES `tb_beli_kredit` (`kode_kredit`);

--
-- Constraints for table `tb_beli_cash`
--
ALTER TABLE `tb_beli_cash`
  ADD CONSTRAINT `tb_beli_cash_ibfk_1` FOREIGN KEY (`kode_customer`) REFERENCES `tb_customer` (`kode_customer`),
  ADD CONSTRAINT `tb_beli_cash_ibfk_2` FOREIGN KEY (`kode_motor`) REFERENCES `tb_motor` (`kode_motor`);

--
-- Constraints for table `tb_beli_kredit`
--
ALTER TABLE `tb_beli_kredit`
  ADD CONSTRAINT `tb_beli_kredit_ibfk_1` FOREIGN KEY (`kode_customer`) REFERENCES `tb_customer` (`kode_customer`),
  ADD CONSTRAINT `tb_beli_kredit_ibfk_2` FOREIGN KEY (`kode_motor`) REFERENCES `tb_motor` (`kode_motor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
