-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 05:09 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistempakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `analisa_hasil`
--

CREATE TABLE IF NOT EXISTS `analisa_hasil` (
`id` int(15) NOT NULL,
  `pengguna_id` int(11) DEFAULT NULL,
  `penyakit_id` int(11) DEFAULT NULL,
  `tgl_konsultasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE IF NOT EXISTS `gejala` (
`id` int(10) NOT NULL,
  `nm_gejala` varchar(125) NOT NULL,
  `gmbr_gejala` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `nm_gejala`, `gmbr_gejala`) VALUES
(1, 'Leher akar mengecil', '21.jpg'),
(2, 'Batang mengering', 'download.png'),
(3, 'Batang dalam tanah membusuk', 'batang_dalam_tanah_membusuk.jpg'),
(4, 'Batang berkerut', 'batang_mengkerut.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
`id` int(15) NOT NULL,
  `status` varchar(25) NOT NULL,
  `nm_pengguna` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `tanggal_lahir` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(25) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `status`, `nm_pengguna`, `jenis_kelamin`, `tanggal_lahir`, `username`, `password`, `tanggal`) VALUES
(2, 'pengguna', 'imam', 'Laki-laki', '2017-07-12', 'dinata', 'dinata1234', '2017-07-23 16:00:00'),
(3, 'admin', 'asda', 'Perempuan', '2017-07-14', 'asdas', 'qqqq', '2017-07-25 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE IF NOT EXISTS `penyakit` (
`id` int(10) NOT NULL,
  `nm_penyakit` varchar(25) NOT NULL,
  `gbr_penyakit` text NOT NULL,
  `penyebab` text NOT NULL,
  `penanganan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `nm_penyakit`, `gbr_penyakit`, `penyebab`, `penanganan`) VALUES
(5, 'Hangus batang', '66-5122.png', 'hama', 'disemprot');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit_detail`
--

CREATE TABLE IF NOT EXISTS `penyakit_detail` (
`id` int(15) NOT NULL,
  `penyakit_id` int(11) NOT NULL,
  `gejala_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisa_hasil`
--
ALTER TABLE `analisa_hasil`
 ADD PRIMARY KEY (`id`), ADD KEY `fkanalisa01` (`pengguna_id`), ADD KEY `fkanalisa02` (`penyakit_id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyakit_detail`
--
ALTER TABLE `penyakit_detail`
 ADD PRIMARY KEY (`id`), ADD KEY `fk01` (`penyakit_id`), ADD KEY `fk02` (`gejala_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisa_hasil`
--
ALTER TABLE `analisa_hasil`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `penyakit_detail`
--
ALTER TABLE `penyakit_detail`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `analisa_hasil`
--
ALTER TABLE `analisa_hasil`
ADD CONSTRAINT `fkanalisa01` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fkanalisa02` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penyakit_detail`
--
ALTER TABLE `penyakit_detail`
ADD CONSTRAINT `fk01` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk02` FOREIGN KEY (`gejala_id`) REFERENCES `gejala` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
