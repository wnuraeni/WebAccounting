-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2013 at 04:35 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE IF NOT EXISTS `jurnal` (
  `id` int(10) NOT NULL auto_increment,
  `tanggal` date NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `kode_akun` char(7) NOT NULL,
  `nama_akun` varchar(250) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `debit` int(15) NOT NULL,
  `kredit` int(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=476 ;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id`, `tanggal`, `bukti`, `kode_akun`, `nama_akun`, `keterangan`, `debit`, `kredit`) VALUES
(472, '2010-12-31', '', '651', 'Deviden', 'Deviden', 500000, 0),
(473, '2010-12-31', '', '111', 'Kas', 'Deviden', 0, 500000),
(474, '2010-12-31', '', '111', 'Kas', 'Laba', 500000, 0),
(475, '2010-12-31', '', '316', 'Laba ditahan', 'Laba ditahan', 0, 500000),
(468, '2011-01-05', '', '611', 'Biaya operasional', 'Biaya depresiasi aset tetap', 43000000, 0),
(469, '2011-01-05', '', '132', 'Akumulasi depresiasi peralatan', 'Biaya depresiasi aset tetap', 0, 43000000),
(455, '2010-10-05', '', '111', 'Kas', 'Pembelian mini DV panasonic', 0, 200000),
(456, '2010-11-17', '', '611', 'Biaya operasional', 'Pembelian DVD-R kachi', 8000, 0),
(457, '2010-11-17', '', '111', 'Kas', 'Pembelian DVD-R kachi', 0, 8000),
(461, '2010-09-21', '', '111', 'Kas', 'Pembelian mini DV', 0, 200000),
(432, '2010-05-20', '', '631', 'Biaya lain-lain', 'Transfer via Mandiri', 350000, 0),
(433, '2010-05-20', '', '111', 'Kas', 'Transfer via Mandiri', 0, 350000),
(459, '2010-06-17', '', '111', 'Kas', 'pembelian mini DV dan DVD', 0, 150000),
(458, '2010-06-17', '', '611', 'Biaya operasional', 'pembelian mini DV dan DVD', 150000, 0),
(436, '2010-07-10', '', '611', 'Biaya operasional', 'Pembelian V.100, jackstereo,mini DV', 725000, 0),
(437, '2010-07-10', '', '111', 'Kas', 'Pembelian V.100, jackstereo,mini DV', 0, 725000),
(463, '2010-07-22', '', '111', 'Kas', 'Pembelian modulator UHF dan headset sonic gear', 0, 586000),
(462, '2010-07-22', '', '131', 'Peralatan', 'Pembelian modulator UHF dan headset sonic gear', 586000, 0),
(440, '2010-08-05', '', '611', 'Biaya operasional', 'Pembelian lakban hitam, lakban busa', 44000, 0),
(441, '2010-08-05', '', '111', 'Kas', 'Pembelian lakban hitam, lakban busa', 0, 44000),
(442, '2010-08-06', '', '611', 'Biaya operasional', 'Pembelian F connector,lakban', 58750, 0),
(443, '2010-08-06', '', '111', 'Kas', 'Pembelian F connector,lakban', 0, 58750),
(444, '2010-09-14', '', '611', 'Biaya operasional', 'Pembelian js rea gold, iyrca,soket', 33000, 0),
(445, '2010-09-14', '', '111', 'Kas', 'Pembelian js rea gold, iyrca,soket', 0, 33000),
(446, '2010-09-23', '', '631', 'Biaya lain-lain', 'Service', 10000, 0),
(447, '2010-09-23', '', '111', 'Kas', 'Service', 0, 10000),
(454, '2010-10-05', '', '611', 'Biaya operasional', 'Pembelian mini DV panasonic', 200000, 0),
(450, '2010-09-22', '', '611', 'Biaya operasional', 'Pembelian DVD-R Kachi, chassing DVD', 97500, 0),
(451, '2010-09-22', '', '111', 'Kas', 'Pembelian DVD-R Kachi, chassing DVD', 0, 97500),
(460, '2010-09-21', '', '611', 'Biaya operasional', 'Pembelian mini DV', 200000, 0),
(465, '2010-01-04', '', '315', 'Modal', 'Modal awal rektorat', 0, 50000000),
(464, '2010-01-04', '', '111', 'Kas', 'Modal awal rektorat', 50000000, 0),
(431, '2010-05-14', '', '111', 'Kas', 'Pembelian TV tunner', 0, 280000),
(350, '2010-01-05', '', '131', 'Peralatan', 'Pembelian aset tetap', 50000000, 0),
(351, '2010-01-05', '', '111', 'Kas', 'Pembelian aset tetap', 0, 50000000),
(352, '2010-01-20', '', '111', 'Kas', 'Pendapatan peliputan BEM', 500000, 0),
(353, '2010-01-20', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan BEM', 0, 500000),
(354, '2010-02-06', '', '111', 'Kas', 'Pendapatan peliputan FAST', 290000, 0),
(355, '2010-02-06', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan FAST', 0, 290000),
(356, '2010-02-08', '', '111', 'Kas', 'Pendapatan peliputan MQ IT TELKOM', 250000, 0),
(357, '2010-02-08', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan MQ IT TELKOM', 0, 250000),
(358, '2010-02-27', '', '111', 'Kas', 'Pendapatan peliputan wedding', 500000, 0),
(359, '2010-02-27', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan wedding', 0, 500000),
(360, '2010-03-05', '', '111', 'Kas', 'Pendapatan peliputan HIY', 285000, 0),
(361, '2010-03-05', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan HIY', 0, 285000),
(362, '2010-03-06', '', '111', 'Kas', 'Pendapatan peliputan TO Permib', 250000, 0),
(363, '2010-03-06', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan TO Permib', 0, 250000),
(364, '2010-03-13', '', '111', 'Kas', 'Pendapatan peliputan Pesona Budaya', 225000, 0),
(365, '2010-03-13', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan Pesona Budaya', 0, 225000),
(366, '2010-03-20', '', '111', 'Kas', 'Pendapatan peliputan serempak', 210000, 0),
(367, '2010-03-20', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan serempak', 0, 210000),
(368, '2010-05-22', '', '111', 'Kas', 'Pendapatan peliputan TechJam', 265000, 0),
(369, '2010-05-22', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan TechJam', 0, 265000),
(370, '2010-05-23', '', '111', 'Kas', 'Pendapatan peliputan WL', 900000, 0),
(371, '2010-05-23', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan WL', 0, 900000),
(372, '2010-06-05', '', '111', 'Kas', 'Pendapatan peliputan GHK', 350000, 0),
(373, '2010-06-05', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan GHK', 0, 350000),
(374, '2010-06-19', '', '111', 'Kas', 'Pendapatan peliputan Institusi', 300000, 0),
(375, '2010-06-19', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan Institusi', 0, 300000),
(376, '2010-07-24', '', '111', 'Kas', 'Pendapatan peliputan Aku Bukan NII', 180000, 0),
(377, '2010-07-24', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan Aku Bukan NII', 0, 180000),
(378, '2010-08-07', '', '111', 'Kas', 'Pendapatan peliputan olimpiade', 760000, 0),
(379, '2010-08-07', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan olimpiade', 0, 760000),
(380, '2010-05-22', '', '111', 'Kas', 'Pendapatan peliputan UKM Djawa', 580000, 0),
(381, '2010-05-22', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan UKM Djawa', 0, 580000),
(382, '2010-09-25', '', '111', 'Kas', 'Pendapatan peliputan CDC', 7000000, 0),
(383, '2010-09-25', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan CDC', 0, 7000000),
(384, '2010-07-30', '', '111', 'Kas', 'Pendapatan peliputan PDKT', 300000, 0),
(385, '2010-07-30', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan PDKT', 0, 300000),
(386, '2010-10-09', '', '111', 'Kas', 'Pendapatan peliputan olimpiade', 400000, 0),
(387, '2010-10-09', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan olimpiade', 0, 400000),
(388, '2010-11-13', '', '111', 'Kas', 'Pendapatan peliputan pembuatan DVD seminar S2', 250000, 0),
(389, '2010-11-13', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan pembuatan DVD seminar S2', 0, 250000),
(390, '2010-11-20', '', '111', 'Kas', 'Pendapatan peliputan S2', 1250000, 0),
(391, '2010-11-20', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan S2', 0, 1250000),
(392, '2010-11-22', '', '111', 'Kas', 'Pendapatan peliputan KRI', 1200000, 0),
(393, '2010-11-22', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan KRI', 0, 1200000),
(394, '2010-11-23', '', '111', 'Kas', 'Pendapatan wisuda Maret', 1500000, 0),
(395, '2010-11-23', '', '511', 'Pendapatan peliputan', 'Pendapatan wisuda Maret', 0, 1500000),
(396, '2010-12-06', '', '111', 'Kas', 'Pendapatan wisuda Juli', 1500000, 0),
(397, '2010-12-06', '', '511', 'Pendapatan peliputan', 'Pendapatan wisuda Juli', 0, 1500000),
(398, '2010-12-09', '', '111', 'Kas', 'Pendapatan peliputan  profil kampus', 1100000, 0),
(399, '2010-12-09', '', '511', 'Pendapatan peliputan', 'Pendapatan peliputan  profil kampus', 0, 1100000),
(400, '2010-12-23', '', '111', 'Kas', 'Pendapatan iklan berbayar', 145000, 0),
(401, '2010-12-23', '', '511', 'Pendapatan peliputan', 'Pendapatan iklan berbayar', 0, 145000),
(402, '2010-12-31', '', '621', 'Biaya administrasi', 'Pemberian gaji', 10000000, 0),
(403, '2010-12-31', '', '111', 'Kas', 'Pemberian gaji', 0, 10000000),
(404, '2010-01-11', '', '611', 'Biaya operasional', 'Pembelian Kabel MD7P M to RGA + MDAP', 55000, 0),
(405, '2010-01-11', '', '111', 'Kas', 'Pembelian Kabel MD7P M to RGA + MDAP', 0, 55000),
(406, '2010-01-28', '', '611', 'Biaya operasional', 'Pembelian DVD GT Pro', 12000, 0),
(407, '2010-01-28', '', '111', 'Kas', 'Pembelian DVD GT Pro', 0, 12000),
(408, '2010-01-14', '', '611', 'Biaya operasional', 'Pembelian chassing double', 6000, 0),
(409, '2010-01-14', '', '111', 'Kas', 'Pembelian chassing double', 0, 6000),
(410, '2010-01-29', '', '631', 'Biaya lain-lain', 'Ganti uang TechFest', 315000, 0),
(411, '2010-01-29', '', '111', 'Kas', 'Ganti uang TechFest', 0, 315000),
(412, '2010-02-05', '', '611', 'Biaya operasional', 'Pembelian DVD-R Kachi, label CD, label nama', 177000, 0),
(413, '2010-02-05', '', '111', 'Kas', 'Pembelian DVD-R Kachi, label CD, label nama', 0, 177000),
(414, '2010-02-06', '', '611', 'Biaya operasional', 'Pembelian chassing dvd, speaker Genius, stempel', 205000, 0),
(415, '2010-02-06', '', '111', 'Kas', 'Pembelian chassing dvd, speaker Genius, stempel', 0, 205000),
(416, '2010-02-08', '', '611', 'Biaya operasional', 'Pembelian cover, buku besar', 15500, 0),
(417, '2010-02-08', '', '111', 'Kas', 'Pembelian cover, buku besar', 0, 15500),
(418, '2010-03-18', '', '131', 'Peralatan', 'Pembelian DVD panasonic', 250000, 0),
(419, '2010-03-18', '', '111', 'Kas', 'Pembelian DVD panasonic', 0, 250000),
(420, '2010-03-22', '', '611', 'Biaya operasional', 'Pembelian kabel monitor ', 80000, 0),
(421, '2010-03-22', '', '111', 'Kas', 'Pembelian kabel monitor ', 0, 80000),
(422, '2010-03-20', '', '131', 'Peralatan', 'Pembelian RAM VS0004', 309000, 0),
(423, '2010-03-20', '', '111', 'Kas', 'Pembelian RAM VS0004', 0, 309000),
(424, '2010-04-09', '', '611', 'Biaya operasional', 'Pembelian dvd kachi dan tempat dvd', 115000, 0),
(425, '2010-04-09', '', '111', 'Kas', 'Pembelian dvd kachi dan tempat dvd', 0, 115000),
(426, '2010-04-27', '', '631', 'Biaya lain-lain', 'Service kamera', 1089000, 0),
(427, '2010-04-27', '', '111', 'Kas', 'Service kamera', 0, 1089000),
(428, '2010-05-13', '', '611', 'Biaya operasional', 'Pembelian DVD GT Pro dan sterefom', 55000, 0),
(429, '2010-05-13', '', '111', 'Kas', 'Pembelian DVD GT Pro dan sterefom', 0, 55000),
(430, '2010-05-14', '', '131', 'Peralatan', 'Pembelian TV tunner', 280000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kode_akun`
--

CREATE TABLE IF NOT EXISTS `kode_akun` (
  `id` int(11) NOT NULL auto_increment,
  `kode_akun` char(7) NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `saldo_normal` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `kode_akun`
--

INSERT INTO `kode_akun` (`id`, `kode_akun`, `nama_akun`, `jenis`, `saldo_normal`) VALUES
(82, '136', 'Akumulasi depresiasi kendaraan', 'Aktiva tetap', 'kredit'),
(81, '135', 'Kendaraan', 'Aktiva tetap', 'debit'),
(78, '314', 'Hutang jangka panjang', 'Hutang jangka panjang', 'kredit'),
(79, '133', 'Bangunan', 'Aktiva tetap', 'debit'),
(80, '134', 'Akumulasi depresiasi bangunan', 'Aktiva tetap', 'kredit'),
(77, '311', 'hutang jangka pendek', 'Hutang lancar', 'kredit'),
(75, '310', 'Hutang usaha', 'Hutang lancar', 'kredit'),
(76, '122', 'Biaya dibayar dimuka', 'Aktiva lancar', 'debit'),
(72, '631', 'Biaya lain-lain', 'Biaya', 'debit'),
(71, '621', 'Biaya administrasi', 'Biaya', 'debit'),
(74, '121', 'Piutang usaha', 'Aktiva lancar', 'debit'),
(67, '315', 'Modal', 'Modal', 'kredit'),
(73, '132', 'Akumulasi depresiasi peralatan', 'aktiva tetap', 'kredit'),
(69, '511', 'Pendapatan peliputan', 'Pendapatan', 'kredit'),
(70, '611', 'Biaya operasional', 'Biaya', 'debit'),
(65, '131', 'Peralatan', 'Aktiva tetap', 'debit'),
(63, '111', 'Kas', 'Aktiva lancar', 'debit'),
(83, '137', 'Tanah', 'Aktiva tetap', 'debit'),
(84, '512', 'Pendapatan lain-lain', 'Pendapatan', 'kredit'),
(85, '312', 'Hutang Pajak', 'Hutang lancar', 'kredit'),
(86, '641', 'Biaya pajak', 'Biaya', 'debit'),
(87, '123', 'PPN masukan', 'Aktiva lancar', 'debit'),
(88, '313', 'PPN keluaran', 'Hutang lancar', 'kredit'),
(91, '651', 'Deviden', 'Biaya', 'debit'),
(92, '316', 'Laba ditahan', 'Modal', 'kredit'),
(93, '316', 'Laba ditahan', 'Modal', 'kredit');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'agam', 'password');
