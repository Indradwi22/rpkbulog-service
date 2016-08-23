/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : rpkbulog

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2016-08-19 18:17:01
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
-- Records of entitas
-- ----------------------------
INSERT INTO `entitas` VALUES ('00001', 'PERUM BULOG PUSAT');
INSERT INTO `entitas` VALUES ('01001', 'DIVRE ACEH');
INSERT INTO `entitas` VALUES ('01010', 'SUBDIVRE LHOKSEUMAWE');
INSERT INTO `entitas` VALUES ('01011', 'KANLOG TAKENGON');
INSERT INTO `entitas` VALUES ('01020', 'SUBDIVRE LANGSA');
INSERT INTO `entitas` VALUES ('01030', 'SUBDIVRE MEULABOH');
INSERT INTO `entitas` VALUES ('01040', 'SUBDIVRE SIGLI');
INSERT INTO `entitas` VALUES ('01050', 'SUBDIVRE KUTACANE');
INSERT INTO `entitas` VALUES ('01060', 'SUBDIVRE BLANG PIDIE');
INSERT INTO `entitas` VALUES ('02001', 'DIVRE SUMUT');
INSERT INTO `entitas` VALUES ('02010', 'SUB DIVRE I MEDAN');
INSERT INTO `entitas` VALUES ('02011', 'KANLOG KABAN JAHE');
INSERT INTO `entitas` VALUES ('02020', 'SUB DIVRE PEMATANG SIANTAR');
INSERT INTO `entitas` VALUES ('02030', 'SUB DIVRE KISARAN ');
INSERT INTO `entitas` VALUES ('02031', 'KANLOG RANTAU PRAPAT');
INSERT INTO `entitas` VALUES ('02040', 'SUB DIVRE P. SIDEMPUAN');
INSERT INTO `entitas` VALUES ('02041', 'KANLOG GUNUNG SITOLI');
INSERT INTO `entitas` VALUES ('02042', 'KANLOG SIBOLGA');
INSERT INTO `entitas` VALUES ('03001', 'DIVRE RIAU DAN KEPRI');
INSERT INTO `entitas` VALUES ('03002', 'KANLOG KAMPAR');
INSERT INTO `entitas` VALUES ('03010', 'SUB DIVRE TANJUNG PINANG');
INSERT INTO `entitas` VALUES ('03011', 'KANLOG RANAI - NATUNA');
INSERT INTO `entitas` VALUES ('03020', 'SUB DIVRE DUMAI');
INSERT INTO `entitas` VALUES ('03030', 'SUB DIVRE BATAM');
INSERT INTO `entitas` VALUES ('03040', 'SUB DIVRE BENGKALIS');
INSERT INTO `entitas` VALUES ('03050', 'SUB DIVRE TEMBILAHAN');
INSERT INTO `entitas` VALUES ('03060', 'SUB DIVRE RENGAT');
INSERT INTO `entitas` VALUES ('04001', 'DIVRE SUMBAR');
INSERT INTO `entitas` VALUES ('04010', 'SUBDIVRE BUKIT TINGGI');
INSERT INTO `entitas` VALUES ('04020', 'SUBDIVRE SOLOK');
INSERT INTO `entitas` VALUES ('05001', 'DIVRE JAMBI');
INSERT INTO `entitas` VALUES ('05010', 'SUBDIVRE KUALA TUNGKAL');
INSERT INTO `entitas` VALUES ('05020', 'SUBDIVRE BUNGO TEBO');
INSERT INTO `entitas` VALUES ('05030', 'SUBDIVRE KERINCI');
INSERT INTO `entitas` VALUES ('05040', 'SUBDIVRE SARKO');
INSERT INTO `entitas` VALUES ('06001', 'DIVRE SUMSEL');
INSERT INTO `entitas` VALUES ('06003', 'KANLOG MURA');
INSERT INTO `entitas` VALUES ('06010', 'SUB DIVRE LAHAT');
INSERT INTO `entitas` VALUES ('06020', 'SUB DIVRE BANGKA');
INSERT INTO `entitas` VALUES ('06021', 'KANLOG BELITUNG');
INSERT INTO `entitas` VALUES ('06030', 'SUB DIVRE OKU');
INSERT INTO `entitas` VALUES ('07001', 'DIVRE BENGKULU');
INSERT INTO `entitas` VALUES ('07010', 'SUBDIVRE REJANG LEBONG');
INSERT INTO `entitas` VALUES ('08001', 'DIVRE LAMPUNG');
INSERT INTO `entitas` VALUES ('08002', 'KANSILOG KALIANDA');
INSERT INTO `entitas` VALUES ('08003', 'KANSILOG MENGGALA');
INSERT INTO `entitas` VALUES ('08010', 'SUB DIVRE LAMPUNG TENGAH');
INSERT INTO `entitas` VALUES ('08020', 'SUB DIVRE LAMPUNG UTARA');
INSERT INTO `entitas` VALUES ('09001', 'DIVRE DKI JAKARTA');
INSERT INTO `entitas` VALUES ('09010', 'SUB DIVRE SERANG');
INSERT INTO `entitas` VALUES ('09020', 'SUBDIVRE TANGERANG');
INSERT INTO `entitas` VALUES ('09030', 'SUBDIVRE LEBAK');
INSERT INTO `entitas` VALUES ('10001', 'DIVRE JABAR');
INSERT INTO `entitas` VALUES ('10010', 'SUB DIVRE BANDUNG');
INSERT INTO `entitas` VALUES ('10020', 'SUB DIVRE CIANJUR');
INSERT INTO `entitas` VALUES ('10030', 'SUB DIVRE CIREBON');
INSERT INTO `entitas` VALUES ('10040', 'SUB DIVRE INDRAMAYU');
INSERT INTO `entitas` VALUES ('10050', 'SUB DIVRE KARAWANG');
INSERT INTO `entitas` VALUES ('10060', 'SUB DIVRE SUBANG');
INSERT INTO `entitas` VALUES ('10070', 'SUB DIVRE CIAMIS');
INSERT INTO `entitas` VALUES ('11001', 'DIVRE JATENG');
INSERT INTO `entitas` VALUES ('11010', 'SUB DIVRE WIL. I SEMARANG');
INSERT INTO `entitas` VALUES ('11020', 'SUB DIVRE WIL. II PATI');
INSERT INTO `entitas` VALUES ('11030', 'SUB DIVRE WIL. III SURAKARTA');
INSERT INTO `entitas` VALUES ('11040', 'SUB DIVRE WIL. IV BANYUMAS');
INSERT INTO `entitas` VALUES ('11050', 'SUB DIVRE WIL. V KEDU');
INSERT INTO `entitas` VALUES ('11060', 'SUB DIVRE WIL. VI PEKALONGAN');
INSERT INTO `entitas` VALUES ('12001', 'DIVRE YOGYA');
INSERT INTO `entitas` VALUES ('13001', 'DIVRE JATIM');
INSERT INTO `entitas` VALUES ('13010', 'SUB DIVRE I SURABAYA UTARA');
INSERT INTO `entitas` VALUES ('13020', 'SUB DIVRE II SURABAYA SELATAN');
INSERT INTO `entitas` VALUES ('13030', 'SUB DIVRE III BOJONEGORO');
INSERT INTO `entitas` VALUES ('13040', 'SUB DIVRE IV MADIUN');
INSERT INTO `entitas` VALUES ('13050', 'SUB DIVRE V KEDIRI');
INSERT INTO `entitas` VALUES ('13060', 'SUB DIVRE VI BONDOWOSO');
INSERT INTO `entitas` VALUES ('13070', 'SUB DIVRE VII MALANG');
INSERT INTO `entitas` VALUES ('13080', 'SUB DIVRE VIII PROBOLINGGO');
INSERT INTO `entitas` VALUES ('13090', 'SUB DIVRE IX BANYUWANGI');
INSERT INTO `entitas` VALUES ('13100', 'SUB DIVRE X TULUNG AGUNG');
INSERT INTO `entitas` VALUES ('13110', 'SUB DIVRE XI JEMBER');
INSERT INTO `entitas` VALUES ('13120', 'SUB DIVRE XII MADURA');
INSERT INTO `entitas` VALUES ('13130', 'SUB DIVRE XIII PONOROGO');
INSERT INTO `entitas` VALUES ('14001', 'DIVRE KALBAR');
INSERT INTO `entitas` VALUES ('14002', 'KANLOG PUTUSIBAU');
INSERT INTO `entitas` VALUES ('14003', 'KANLOG SANGGAU');
INSERT INTO `entitas` VALUES ('14010', 'SUBDIVRE SINGKAWANG');
INSERT INTO `entitas` VALUES ('14020', 'SUBDIVRE KETAPANG');
INSERT INTO `entitas` VALUES ('14030', 'SUBDIVRE SINTANG');
INSERT INTO `entitas` VALUES ('15001', 'DIVRE KALTIM');
INSERT INTO `entitas` VALUES ('15002', 'KANLOG TANAH GROGOT');
INSERT INTO `entitas` VALUES ('15010', 'SUBDIVRE SAMARINDA');
INSERT INTO `entitas` VALUES ('15020', 'SUBDIVRE TARAKAN');
INSERT INTO `entitas` VALUES ('15021', 'KANLOG TANJUNG REDEB');
INSERT INTO `entitas` VALUES ('16001', 'DIVRE KALSEL ');
INSERT INTO `entitas` VALUES ('16002', 'KANLOG KOTA BARU');
INSERT INTO `entitas` VALUES ('16010', 'SUBDIVRE BARABAI');
INSERT INTO `entitas` VALUES ('17001', 'DIVRE KALTENG');
INSERT INTO `entitas` VALUES ('17010', 'SUBDIVRE KAPUAS');
INSERT INTO `entitas` VALUES ('17020', 'SUBDIVRE SAMPIT');
INSERT INTO `entitas` VALUES ('17030', 'SUBDIVRE PANGKALAN BUN');
INSERT INTO `entitas` VALUES ('17040', 'SUBDIVRE MUARA TEWEH');
INSERT INTO `entitas` VALUES ('17041', 'KANLOG BUNTOK');
INSERT INTO `entitas` VALUES ('18001', 'DIVRE SULUT');
INSERT INTO `entitas` VALUES ('18010', 'SUBDIVRE GORONTALO');
INSERT INTO `entitas` VALUES ('18020', 'SUBDIVRE TAHUNA');
INSERT INTO `entitas` VALUES ('18030', 'SUBDIVRE BOLAANG MONGONDOW');
INSERT INTO `entitas` VALUES ('19001', 'DIVRE SULTENG');
INSERT INTO `entitas` VALUES ('19010', 'SUBDIVRE POSO');
INSERT INTO `entitas` VALUES ('19020', 'SUBDIVRE LUWUK');
INSERT INTO `entitas` VALUES ('19030', 'SUBDIVRE TOLI-TOLI');
INSERT INTO `entitas` VALUES ('20001', 'DIVRE SULTRA');
INSERT INTO `entitas` VALUES ('20003', 'KANLOG BOMBANA');
INSERT INTO `entitas` VALUES ('20010', 'SUBDIVRE BAUBAU');
INSERT INTO `entitas` VALUES ('20011', 'KANLOG RAHA');
INSERT INTO `entitas` VALUES ('20020', 'SUBDIVRE UNAAHA');
INSERT INTO `entitas` VALUES ('20021', 'KANLOG KOLAKA');
INSERT INTO `entitas` VALUES ('21000', 'DIVRE SULSEL ');
INSERT INTO `entitas` VALUES ('21001', 'DIVRE SULSEL');
INSERT INTO `entitas` VALUES ('21010', 'SUBDIVRE POLMAS');
INSERT INTO `entitas` VALUES ('21020', 'SUBDIVRE PARE-PARE');
INSERT INTO `entitas` VALUES ('21021', 'KANLOG PINRANG');
INSERT INTO `entitas` VALUES ('21030', 'SUBDIVRE SIDRAP');
INSERT INTO `entitas` VALUES ('21031', 'KANLOG SOPPENG');
INSERT INTO `entitas` VALUES ('21040', 'SUBDIVRE WAJO');
INSERT INTO `entitas` VALUES ('21041', 'KANLOG BONE');
INSERT INTO `entitas` VALUES ('21050', 'SUBDIVRE BULUKUMBA');
INSERT INTO `entitas` VALUES ('21060', 'SUBDIVRE PALOPO');
INSERT INTO `entitas` VALUES ('21070', 'SUBDIVRE MAKASAR');
INSERT INTO `entitas` VALUES ('21080', 'SUBDIVRE MAMUJU');
INSERT INTO `entitas` VALUES ('22001', 'DIVRE BALI');
INSERT INTO `entitas` VALUES ('23001', 'DIVRE N.T.B');
INSERT INTO `entitas` VALUES ('23010', 'SUBDIVRE SUMBAWA-NTB');
INSERT INTO `entitas` VALUES ('23020', 'SUBDIVRE BIMA - NTB');
INSERT INTO `entitas` VALUES ('23030', 'SUBDIVRE LOMBOK TIMUR - NTB');
INSERT INTO `entitas` VALUES ('24001', 'DIVRE N.T.T');
INSERT INTO `entitas` VALUES ('24002', 'KANLOG KALABAHI');
INSERT INTO `entitas` VALUES ('24010', 'SUBDIVRE WAINGAPU');
INSERT INTO `entitas` VALUES ('24020', 'SUBDIVRE ENDE');
INSERT INTO `entitas` VALUES ('24021', 'KANLOG');
INSERT INTO `entitas` VALUES ('24030', 'SUBDIVRE LARANTUKA');
INSERT INTO `entitas` VALUES ('24040', 'SUBDIVRE MAUMERE');
INSERT INTO `entitas` VALUES ('24050', 'SUBDIVRE  ATAMBUA');
INSERT INTO `entitas` VALUES ('24060', 'SUBDIVRE  WAIKABUBAK');
INSERT INTO `entitas` VALUES ('24070', 'SUBDIVRE  RUTENG');
INSERT INTO `entitas` VALUES ('24071', 'KANLOG LABUAN BAJO');
INSERT INTO `entitas` VALUES ('24080', 'SUBDIVRE BAJAWA');
INSERT INTO `entitas` VALUES ('25001', 'DIVRE MALUKU');
INSERT INTO `entitas` VALUES ('25010', 'SUBDIVRE TERNATE');
INSERT INTO `entitas` VALUES ('25020', 'SUBDIVRE TUAL');
INSERT INTO `entitas` VALUES ('26001', 'DIVRE PAPUA');
INSERT INTO `entitas` VALUES ('26002', 'KANLOG WAMENA');
INSERT INTO `entitas` VALUES ('26003', 'KANLOG TIMIKA');
INSERT INTO `entitas` VALUES ('26010', 'SUBDIVRE BIAK');
INSERT INTO `entitas` VALUES ('26011', 'KANLOG SERUI');
INSERT INTO `entitas` VALUES ('26012', 'KANLOG NABIRE');
INSERT INTO `entitas` VALUES ('26020', 'SUBDIVRE MANOKWARI');
INSERT INTO `entitas` VALUES ('26030', 'SUBDIVRE FAK-FAK');
INSERT INTO `entitas` VALUES ('26040', 'SUBDIVRE SORONG');
INSERT INTO `entitas` VALUES ('26041', 'KANLOG TEMINABUAN');
INSERT INTO `entitas` VALUES ('26050', 'SUBDIVRE MERAUKE');

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
-- Records of keys
-- ----------------------------
INSERT INTO `keys` VALUES ('1', 'rpkbulogapi', '10', '1', '0', '127.0.0.1', '0');

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
-- Records of tb_jeniskomoditi
-- ----------------------------
INSERT INTO `tb_jeniskomoditi` VALUES ('1', 'A', 'BERAS');
INSERT INTO `tb_jeniskomoditi` VALUES ('2', 'B', 'IKAN');
INSERT INTO `tb_jeniskomoditi` VALUES ('3', 'C', 'DAGING');
INSERT INTO `tb_jeniskomoditi` VALUES ('4', 'D', 'GULA PASIR');
INSERT INTO `tb_jeniskomoditi` VALUES ('5', 'E', 'MINYAK GORENG');
INSERT INTO `tb_jeniskomoditi` VALUES ('6', 'F', 'TEPUNG TERIGU');
INSERT INTO `tb_jeniskomoditi` VALUES ('7', 'Z', 'BARANG KENA PAJAK LAINNYA');

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
-- Records of tb_komoditi
-- ----------------------------
INSERT INTO `tb_komoditi` VALUES ('1', 'A', 'Beras Kristal 10 Kg', '10', '70000', '1');
INSERT INTO `tb_komoditi` VALUES ('2', 'A', 'Beras Super 5 Kg', '5', '57000', '1');
INSERT INTO `tb_komoditi` VALUES ('3', 'A', 'Beras Merah Hotel 10 Kg', '2', '40000', '1');
INSERT INTO `tb_komoditi` VALUES ('4', 'A', 'Beras Hitam 5 Kg', '1', '40000', '1');
INSERT INTO `tb_komoditi` VALUES ('5', 'A', 'Beras Merah 1 Kg', '1', '13000', '1');
INSERT INTO `tb_komoditi` VALUES ('6', 'A', 'Beras Mentik 10 Kg', '10', '70000', '1');
INSERT INTO `tb_komoditi` VALUES ('7', 'A', 'Beras Poci 10 Kg', '10', '98000', '1');
INSERT INTO `tb_komoditi` VALUES ('8', 'E', 'Minyak Goreng Resto 1 lt', '1', '13000', '4');
INSERT INTO `tb_komoditi` VALUES ('9', 'E', 'Minyak Goreng BM Botol 1 lt', '1', '12500', '4');
INSERT INTO `tb_komoditi` VALUES ('10', 'E', 'Minyak Goreng BM Dus 1 lt', '1', '12000', '4');
INSERT INTO `tb_komoditi` VALUES ('11', 'F', 'Tepung Martabak 1 Kg', '1', '10000', '1');
INSERT INTO `tb_komoditi` VALUES ('12', 'Z', 'Gula Merah 1 Kg', '1', '20000', '1');
INSERT INTO `tb_komoditi` VALUES ('13', 'D', 'GULA PASIR PUTIH 1 KG', '1', '10500', '0');
INSERT INTO `tb_komoditi` VALUES ('14', 'D', 'GULA PASIR PUTIH KARUNGAN (1 Kg x 50)', '50', '500000', '0');
INSERT INTO `tb_komoditi` VALUES ('15', 'Z', 'BAWANG GORENG 200 GR', '200', '20000', '2');
INSERT INTO `tb_komoditi` VALUES ('16', 'C', 'DAGING SAPI 1 KG', '1', '75000', '1');
INSERT INTO `tb_komoditi` VALUES ('17', 'A', 'BERAS SUPER SOLO 5 KG', '5', '50000', '1');
INSERT INTO `tb_komoditi` VALUES ('18', 'A', 'Beras Super Hijau 10 Kg', '10', '95000', '1');
INSERT INTO `tb_komoditi` VALUES ('21', 'E', 'MIGOR BM JERIGEN 18 lt', '18', '216000', '4');
INSERT INTO `tb_komoditi` VALUES ('22', 'A', 'BERAS PREMIUM 10 KG', '5', '100000', '1');
INSERT INTO `tb_komoditi` VALUES ('23', 'A', 'BERAS LELE KING HSBM 25 KG', '25', '250000', '1');
INSERT INTO `tb_komoditi` VALUES ('24', 'A', 'BERAS RUMAH BETANG 10 KG', '10', '85000', '1');
INSERT INTO `tb_komoditi` VALUES ('25', 'A', 'BERAS NASI WANGI HSBM 10 KG', '10', '103000', '1');
INSERT INTO `tb_komoditi` VALUES ('26', 'A', 'BERAS ROJO LELE 5 KG', '5', '55000', '1');
INSERT INTO `tb_komoditi` VALUES ('27', 'A', 'BERAS ROJO LELE HSBM 10 KG', '10', '103000', '1');
INSERT INTO `tb_komoditi` VALUES ('28', 'A', 'BERAS ROJO LELE HSBM 25 KG', '25', '250000', '1');
INSERT INTO `tb_komoditi` VALUES ('29', 'A', 'BERAS PUTRI KAHAYAN 20 KG', '20', '195000', '1');
INSERT INTO `tb_komoditi` VALUES ('30', 'A', 'BERAS REOG 10 KG', '10', '100000', '1');
INSERT INTO `tb_komoditi` VALUES ('31', 'A', 'Beras Super Bulogmart 5 Kg', '5', '50000', '1');
INSERT INTO `tb_komoditi` VALUES ('32', 'A', 'Beras Padi Unggul 10 Kg', '10', '95000', '1');
INSERT INTO `tb_komoditi` VALUES ('33', 'A', 'Beras Cab Nenas 10 Kg', '10', '90000', '1');
INSERT INTO `tb_komoditi` VALUES ('34', 'A', 'Beras Ulos 10 Kg', '10', '95000', '1');
INSERT INTO `tb_komoditi` VALUES ('35', 'A', 'Beras Super Bulogmart Putih 10 Kg', '10', '90000', '1');
INSERT INTO `tb_komoditi` VALUES ('36', 'D', 'Gula LN 1 Kg', '1', '11500', '1');
INSERT INTO `tb_komoditi` VALUES ('37', 'D', 'Gula RNI 1 Kg', '1', '10600', '1');
INSERT INTO `tb_komoditi` VALUES ('38', 'D', 'Gula RNI Karung (1 Kg x 50)', '50', '467500', '1');
INSERT INTO `tb_komoditi` VALUES ('39', 'E', 'Minyak Bimoli Special 5 lt', '5', '78000', '4');
INSERT INTO `tb_komoditi` VALUES ('40', 'E', 'Minyak Bimoli Special 2 lt', '2', '28750', '4');
INSERT INTO `tb_komoditi` VALUES ('41', 'E', 'Minyak Bimoli Klasik 2 lt', '2', '26850', '4');
INSERT INTO `tb_komoditi` VALUES ('42', 'Z', 'Susu Bendera Coklat 385 ml', '385', '9000', '16');
INSERT INTO `tb_komoditi` VALUES ('43', 'Z', 'Susu Bendera Putih 385 ml', '385', '9500', '16');
INSERT INTO `tb_komoditi` VALUES ('44', 'Z', 'Susu Cap Nona 385 ml', '385', '11000', '16');
INSERT INTO `tb_komoditi` VALUES ('45', 'Z', 'Susu Cap Tiga Sapi 386 ml', '386', '8650', '16');
INSERT INTO `tb_komoditi` VALUES ('46', 'Z', 'Teh Celup Sari Murni 25 pcs', '25', '7400', '17');
INSERT INTO `tb_komoditi` VALUES ('47', 'Z', 'Teh Celup Sariwangi 25 pcs', '25', '4500', '17');
INSERT INTO `tb_komoditi` VALUES ('48', 'Z', 'Kecap Bango 220 ml', '220', '7650', '16');

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_penjualan_rpk
-- ----------------------------
INSERT INTO `tb_penjualan_rpk` VALUES ('12', 'STR13001.00000', '2', '57000', '10', '2016-08-16', '2', '2000000', '290000');
INSERT INTO `tb_penjualan_rpk` VALUES ('14', 'STR01001.00000', '1', '70000', '2', '2016-08-16', '1', '150000', '10000');
INSERT INTO `tb_penjualan_rpk` VALUES ('15', 'STR01001.00001', '5', '13000', '1', '2016-08-18', '1', '15000', '2000');
INSERT INTO `tb_penjualan_rpk` VALUES ('16', 'STR01001.00002', '1', '70000', '1', '2016-08-18', '1', '100000', '30000');
INSERT INTO `tb_penjualan_rpk` VALUES ('17', 'STR01001.00003', '5', '13000', '1', '2016-08-18', '1', '13000', '0');
INSERT INTO `tb_penjualan_rpk` VALUES ('18', 'STR01001.00004', '1', '70000', '4', '2016-08-18', '1', '1000000', '642000');
INSERT INTO `tb_penjualan_rpk` VALUES ('19', 'STR01001.00004', '5', '13000', '1', '2016-08-18', '1', '1000000', '642000');
INSERT INTO `tb_penjualan_rpk` VALUES ('20', 'STR01001.00005', '1', '70000', '10', '2016-08-18', '1', '1000000', '170000');
INSERT INTO `tb_penjualan_rpk` VALUES ('21', 'STR01001.00005', '5', '13000', '10', '2016-08-18', '1', '1000000', '170000');
INSERT INTO `tb_penjualan_rpk` VALUES ('26', 'STR01001.00006', '1', '70000', '10', '2016-08-18', '1', '1000000', '170000');
INSERT INTO `tb_penjualan_rpk` VALUES ('27', 'STR01001.00006', '5', '13000', '10', '2016-08-18', '1', '1000000', '170000');
INSERT INTO `tb_penjualan_rpk` VALUES ('42', 'STR01001.00007', '1', '70000', '1', '2016-08-18', '1', '70000', '0');
INSERT INTO `tb_penjualan_rpk` VALUES ('43', 'STR01001.00008', '5', '13000', '1', '2016-08-19', '1', '13000', '0');
INSERT INTO `tb_penjualan_rpk` VALUES ('44', 'STR01001.00009', '1', '70000', '3', '2016-08-19', '1', '300000', '38000');
INSERT INTO `tb_penjualan_rpk` VALUES ('45', 'STR01001.00009', '5', '13000', '4', '2016-08-19', '1', '300000', '38000');

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
-- Records of tb_retur
-- ----------------------------
INSERT INTO `tb_retur` VALUES ('1', '1', '1', '1', '2016-08-18', 'Kemasan rusak parah');
INSERT INTO `tb_retur` VALUES ('4', '5', '2', '2', '2016-08-18', 'Rusak');

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
-- Records of tb_satuan
-- ----------------------------
INSERT INTO `tb_satuan` VALUES ('1', 'Kg', 'Kilogram');
INSERT INTO `tb_satuan` VALUES ('2', 'gr', 'Gram');
INSERT INTO `tb_satuan` VALUES ('4', 'lt', 'Liter');
INSERT INTO `tb_satuan` VALUES ('16', 'ml', 'Mililiter');
INSERT INTO `tb_satuan` VALUES ('17', 'pcs', 'PCS');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_stok_rpk
-- ----------------------------
INSERT INTO `tb_stok_rpk` VALUES ('1', '1', '1', '50', '2016-08-12');
INSERT INTO `tb_stok_rpk` VALUES ('2', '2', '2', '20', '2016-08-13');
INSERT INTO `tb_stok_rpk` VALUES ('3', '5', '1', '8', '2016-08-18');
INSERT INTO `tb_stok_rpk` VALUES ('5', '5', '1', '100', '2016-08-18');
INSERT INTO `tb_stok_rpk` VALUES ('6', '5', '1', '4', '2016-08-18');
INSERT INTO `tb_stok_rpk` VALUES ('7', '17', '2', '4', '2016-08-19');

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
-- Records of tb_toko
-- ----------------------------
INSERT INTO `tb_toko` VALUES ('1', 'Bulogmart Divre Aceh', '01001', '01.003.148.2.05', 'Jl. Tgk. H. M. Daud Beureueh - Banda Aceh', '', '', '', '', null);
INSERT INTO `tb_toko` VALUES ('2', 'Bulogmart Sidoarjo', '13001', null, 'Komplek Pergudangan Bulog Banjar Kemantren.\r\nJl. Raya Buduran - Sidoarjo', '031-8078679', null, '-7.4192917', '112.7215693', null);

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

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'admin', 'yNHm294=', '0', '1');
INSERT INTO `tb_user` VALUES ('2', 'bulogmart_aceh', 'yNHm294=', '1', '2');
INSERT INTO `tb_user` VALUES ('3', 'bulogmart_sidoarjo', 'yNHm294=', '2', '2');
