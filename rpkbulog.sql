/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : rpkbulog

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2016-08-19 14:57:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for entitas
-- ----------------------------
DROP TABLE IF EXISTS `entitas`;
CREATE TABLE `entitas` (
  `ID_ENTITAS` varchar(5) DEFAULT NULL,
  `NAMA_ENTITAS` varchar(29) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for keys
-- ----------------------------
DROP TABLE IF EXISTS `keys`;
CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tb_jeniskomoditi
-- ----------------------------
DROP TABLE IF EXISTS `tb_jeniskomoditi`;
CREATE TABLE `tb_jeniskomoditi` (
  `ID_JENISKOMODITI` tinyint(4) NOT NULL AUTO_INCREMENT,
  `KODE_JENISKOMODITI` char(2) NOT NULL,
  `NAMA_JENISKOMODITI` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_JENISKOMODITI`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_komoditi
-- ----------------------------
DROP TABLE IF EXISTS `tb_komoditi`;
CREATE TABLE `tb_komoditi` (
  `ID_KOMODITI` int(11) NOT NULL AUTO_INCREMENT,
  `KODE_JENISKOMODITI` char(2) DEFAULT NULL,
  `NAMA_KOMODITI` varchar(100) DEFAULT NULL,
  `UKURAN_KOMODITI` int(5) DEFAULT NULL,
  `HARGA_KOMODITI` int(11) DEFAULT NULL,
  `IDSATUAN_KOMODITI` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ID_KOMODITI`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_penjualan_rpk
-- ----------------------------
DROP TABLE IF EXISTS `tb_penjualan_rpk`;
CREATE TABLE `tb_penjualan_rpk` (
  `id_penjualan_rpk` int(11) NOT NULL AUTO_INCREMENT,
  `no_nota_penjualan_rpk` varchar(100) NOT NULL,
  `id_komoditi_penjualan_rpk` int(11) NOT NULL,
  `harga_komoditi_penjualan_rpk` int(11) DEFAULT NULL,
  `jumlah_komoditi_penjualan_rpk` int(11) NOT NULL,
  `tanggal_penjualan_rpk` date NOT NULL,
  `id_toko_penjualan_rpk` int(11) NOT NULL,
  `dibayar_penjualan_rpk` int(11) NOT NULL,
  `kembali_penjualan_rpk` int(11) DEFAULT '0',
  PRIMARY KEY (`id_penjualan_rpk`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_retur
-- ----------------------------
DROP TABLE IF EXISTS `tb_retur`;
CREATE TABLE `tb_retur` (
  `id_retur` int(11) NOT NULL AUTO_INCREMENT,
  `id_komoditi_retur` int(11) NOT NULL,
  `id_toko_retur` int(11) NOT NULL,
  `jumlah_komoditi_retur` int(11) NOT NULL,
  `tanggal_retur` date NOT NULL,
  `keterangan_retur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_retur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_satuan
-- ----------------------------
DROP TABLE IF EXISTS `tb_satuan`;
CREATE TABLE `tb_satuan` (
  `ID_SATUAN` tinyint(4) NOT NULL AUTO_INCREMENT,
  `NAMA_SATUAN` char(10) NOT NULL,
  `KET_SATUAN` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_SATUAN`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_stok_rpk
-- ----------------------------
DROP TABLE IF EXISTS `tb_stok_rpk`;
CREATE TABLE `tb_stok_rpk` (
  `id_stok_rpk` int(11) NOT NULL AUTO_INCREMENT,
  `id_komoditi_stok_rpk` int(11) NOT NULL,
  `id_toko_stok_rpk` int(11) NOT NULL,
  `jumlah_komoditi_stok_rpk` int(11) NOT NULL,
  `tanggal_stok_rpk` date NOT NULL,
  PRIMARY KEY (`id_stok_rpk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_toko
-- ----------------------------
DROP TABLE IF EXISTS `tb_toko`;
CREATE TABLE `tb_toko` (
  `ID_TOKO` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_TOKO` varchar(100) DEFAULT NULL,
  `IDENTITAS_TOKO` varchar(5) DEFAULT NULL,
  `NPWP_TOKO` varchar(50) DEFAULT NULL,
  `ALAMAT_TOKO` text,
  `TELP_TOKO` char(13) DEFAULT NULL,
  `KETERANGAN_TOKO` text,
  `LONG_TOKO` varchar(100) DEFAULT NULL,
  `LAT_TOKO` varchar(100) DEFAULT NULL,
  `TANGGAL_TOKO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_TOKO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME_USER` varchar(50) NOT NULL,
  `PASSWORD_USER` varchar(32) NOT NULL,
  `IDTOKO_USER` int(11) NOT NULL,
  `ROLE_USER` int(1) NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
