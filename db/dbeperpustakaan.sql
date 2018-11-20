-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2013 at 04:11 
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbeperpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `p_anggota`
--

CREATE TABLE IF NOT EXISTS `p_anggota` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_nama` varchar(100) NOT NULL,
  `a_ttl` varchar(100) DEFAULT NULL,
  `a_jk` varchar(25) DEFAULT NULL,
  `a_alamat` varchar(100) DEFAULT NULL,
  `a_hp` varchar(20) DEFAULT NULL,
  `a_ket` text,
  `a_tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a_nonaktif` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p_anggota`
--

INSERT INTO `p_anggota` (`a_id`, `a_nama`, `a_ttl`, `a_jk`, `a_alamat`, `a_hp`, `a_ket`, `a_tgl`, `a_nonaktif`) VALUES
(1, 'Faiz El Muhammadi', 'Kisaran, 10 Januari 1990', 'Laki-laki', 'Kisaran', '085263616901', 'Mahasiwa ', '2013-06-12 02:32:43', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `p_buku`
--

CREATE TABLE IF NOT EXISTS `p_buku` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_kode` varchar(20) NOT NULL,
  `b_judul` varchar(100) NOT NULL,
  `b_penulis` varchar(100) DEFAULT NULL,
  `b_penerbit` varchar(100) DEFAULT NULL,
  `b_tahun` int(11) DEFAULT NULL,
  `b_jumlah` int(11) NOT NULL DEFAULT '0',
  `b_stock` int(11) NOT NULL DEFAULT '0',
  `b_rak` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `p_buku`
--

INSERT INTO `p_buku` (`b_id`, `b_kode`, `b_judul`, `b_penulis`, `b_penerbit`, `b_tahun`, `b_jumlah`, `b_stock`, `b_rak`) VALUES
(1, 'BK100', 'Pemrograman Web 1', 'Suendri', 'PHPBeGo Foundation', 2013, 20, 19, '4'),
(2, 'BK101', 'Pemrograman Web 2', 'Suendri', 'PHPBeGo Foundation', 2013, 25, 25, '4');

-- --------------------------------------------------------

--
-- Table structure for table `p_denda`
--

CREATE TABLE IF NOT EXISTS `p_denda` (
  `d_ID` int(11) NOT NULL AUTO_INCREMENT,
  `d_kategori` varchar(50) NOT NULL,
  `d_juml` int(11) NOT NULL,
  `d_aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`d_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p_denda`
--

INSERT INTO `p_denda` (`d_ID`, `d_kategori`, `d_juml`, `d_aktif`) VALUES
(1, 'Umum', 550, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `p_transaksi`
--

CREATE TABLE IF NOT EXISTS `p_transaksi` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_idanggota` int(11) NOT NULL,
  `t_kdbuku` varchar(20) NOT NULL,
  `t_jumlah` int(11) NOT NULL,
  `t_jnsDenda` varchar(20) NOT NULL,
  `t_tgl1` date NOT NULL,
  `t_tgl2` date NOT NULL,
  `t_tgl3` date NOT NULL,
  `t_kembali` enum('Y','N') NOT NULL DEFAULT 'N',
  `t_jmlDenda` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `p_transaksi`
--

INSERT INTO `p_transaksi` (`t_id`, `t_idanggota`, `t_kdbuku`, `t_jumlah`, `t_jnsDenda`, `t_tgl1`, `t_tgl2`, `t_tgl3`, `t_kembali`, `t_jmlDenda`) VALUES
(1, 1, 'BK100', 2, '1', '2013-06-16', '2013-06-16', '2013-06-17', 'Y', 550),
(2, 1, 'BK101', 5, '1', '2013-06-17', '2013-06-17', '2013-06-17', 'Y', 0),
(3, 1, 'BK100', 1, '1', '2013-06-17', '2013-06-17', '0000-00-00', 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `p_user`
--

CREATE TABLE IF NOT EXISTS `p_user` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_uname` varchar(20) NOT NULL,
  `p_password` varchar(100) NOT NULL,
  `p_level` int(11) NOT NULL,
  `p_nonaktif` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `p_user`
--

INSERT INTO `p_user` (`p_id`, `p_uname`, `p_password`, `p_level`, `p_nonaktif`) VALUES
(1, 'admin', 'admin', 1, 'N'),
(2, 'operator', 'operator', 2, 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
