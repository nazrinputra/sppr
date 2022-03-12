-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2015 at 07:47 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sppr`
--

-- --------------------------------------------------------

--
-- Table structure for table `maklumbalas`
--

CREATE TABLE IF NOT EXISTS `maklumbalas` (
  `Maklumbalas_ID` int(11) NOT NULL,
  `Maklumbalas_Dari` varchar(25) NOT NULL,
  `Maklumbalas_Subjek` varchar(100) NOT NULL,
  `Maklumbalas_Mesej` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maklumbalas`
--

INSERT INTO `maklumbalas` (`Maklumbalas_ID`, `Maklumbalas_Dari`, `Maklumbalas_Subjek`, `Maklumbalas_Mesej`) VALUES
(1, 'hajar@gitn.com.my', 'testing maklumbalas', 'Maklumbalas dari Sistem Pengurusan Penyelenggaraan Rangkaian (SPPR): maklumbalas masuk database'),
(2, 'putranaz94@gmail.com', 'Percubaan Sistem', 'Maklumbalas dari Sistem Pengurusan Penyelenggaraan Rangkaian (SPPR): Testing email');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `Notifikasi_ID` int(11) NOT NULL,
  `Notifikasi_Dari` varchar(25) NOT NULL,
  `Notifikasi_Kepada` varchar(25) NOT NULL,
  `Notifikasi_Subjek` varchar(100) NOT NULL,
  `Notifikasi_Mesej` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`Notifikasi_ID`, `Notifikasi_Dari`, `Notifikasi_Kepada`, `Notifikasi_Subjek`, `Notifikasi_Mesej`) VALUES
(1, 'hajar@gitn.com.my', 'nisa.sabrina94@gmail.com', 'Amaran Gangguan', 'Notifikasi dari Sistem Pengurusan Penyelenggaraan Rangkaian (SPPR): Amaran yang sangat bahaya'),
(3, 'hajar@gitn.com.my', 'edrial.bs@gmail.com', 'Perubahan Sistem', 'Notifikasi dari Sistem Pengurusan Penyelenggaraan Rangkaian (SPPR): Akaun anda telah disekat. Sila selesaikan bayaran untuk menyambung penggunaan perkhidmatan kami.'),
(5, 'hajar@gitn.com.my', 'putra_naz94@yahoo.com', 'Notifikasi', 'Notifikasi dari Sistem Pengurusan Penyelenggaraan Rangkaian (SPPR): Mesej baru kedua'),
(7, 'hajar@gitn.com.my', 'putra_naz94@yahoo.com', 'Notifikasi #1', 'Notifikasi dari Sistem Pengurusan Penyelenggaraan Rangkaian (SPPR): Mesej baru ketiga');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `Pelanggan_ID` int(11) NOT NULL,
  `Pelanggan_Nama` varchar(100) NOT NULL,
  `Pelanggan_Agensi` varchar(100) NOT NULL,
  `Pelanggan_Email` varchar(25) NOT NULL,
  `Pelanggan_Tel` varchar(12) NOT NULL,
  `Pelanggan_Imej` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`Pelanggan_ID`, `Pelanggan_Nama`, `Pelanggan_Agensi`, `Pelanggan_Email`, `Pelanggan_Tel`, `Pelanggan_Imej`) VALUES
(1, 'Rosmah Mansor', 'Kediaman Perdana Menteri', 'rosmahmansor88@gmail.com', '0134567824', 'pelanggan/1.png'),
(2, 'Najib Razak', 'Jabatan Perdana Menteri', 'najibrazak77@yahoo.com', '0145672345', 'avatar1.png'),
(3, 'Ahmad Maslan', 'Kementerian Kewangan Malaysia', 'ahmadmaslan@gmail.com', '098762345', 'avatar5.png'),
(4, 'Shamsul', 'NRE', 'shamsul@nre.gov.my', '03324957574', 'avatar5.png'),
(5, 'Azwan Ali', 'Kementerian Dalam Negeri', 'azwanali@yahoo.com', '0147786543', 'avatar5.png');

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggara`
--

CREATE TABLE IF NOT EXISTS `penyelenggara` (
  `Penyelenggara_ID` int(11) NOT NULL,
  `Penyelenggara_Nama` varchar(100) NOT NULL,
  `Penyelenggara_Unit` varchar(25) NOT NULL,
  `Penyelenggara_Email` varchar(25) NOT NULL,
  `Penyelenggara_Password` varchar(25) NOT NULL,
  `Penyelenggara_Tel` varchar(12) NOT NULL,
  `Penyelenggara_Imej` varchar(100) NOT NULL,
  `Penyelenggara_Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyelenggara`
--

INSERT INTO `penyelenggara` (`Penyelenggara_ID`, `Penyelenggara_Nama`, `Penyelenggara_Unit`, `Penyelenggara_Email`, `Penyelenggara_Password`, `Penyelenggara_Tel`, `Penyelenggara_Imej`, `Penyelenggara_Admin`) VALUES
(1, 'Hajar Md Nor', 'CCO', 'hajar@gitn.com.my', 'hajar1234', '0123456788', 'profile/1.png', 1),
(2, 'Nazrin Putra', 'SFM', 'putranaz94@gmail.com', 'password94', '0123456789', 'avatar5.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggaraan`
--

CREATE TABLE IF NOT EXISTS `penyelenggaraan` (
  `Penyelenggaraan_ID` int(11) NOT NULL,
  `Penyelenggaraan_Rujukan` varchar(25) NOT NULL,
  `Penyelenggaraan_Tarikh` date NOT NULL,
  `Penyelenggaraan_Lokasi` varchar(25) NOT NULL,
  `Penyelenggaraan_Aktiviti` varchar(100) NOT NULL,
  `Penyelenggaraan_Status` varchar(25) NOT NULL,
  `Penyelenggaraan_Penyelenggara` varchar(100) NOT NULL,
  `Penyelenggaraan_Implikasi` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyelenggaraan`
--

INSERT INTO `penyelenggaraan` (`Penyelenggaraan_ID`, `Penyelenggaraan_Rujukan`, `Penyelenggaraan_Tarikh`, `Penyelenggaraan_Lokasi`, `Penyelenggaraan_Aktiviti`, `Penyelenggaraan_Status`, `Penyelenggaraan_Penyelenggara`, `Penyelenggaraan_Implikasi`) VALUES
(1, 'PE2013110154253', '2015-08-15', 'Selangor', '( Jalan Raja Chulan- Kajang ) TRANSFER AND NORMALISE SYSTEM CORE BY CORE FOC KJ-JRC 48C', 'Segera(Urgent)', 'PCCM/TM', ''),
(2, 'PE2014010668901', '2015-08-16', 'Putrajaya', '( Brickfields- Putrajaya  ) IPLL BULK MIGRATION for ESRBRF901 & ESRPUJ901 port 8/0/0 & port 8/0/0', 'Tunda(Reschedule)', 'Numix', ''),
(3, 'PE2013122666951', '2015-08-20', 'Sarawak', 'SIBU (SB) NGN MIGRATION FROM PSTN TO NGN NETWORK', 'Biasa(Normal)', 'PCCM/TM', ''),
(4, 'PE2013110154256', '2015-08-22', 'Johor', '( Brickfields- Putrajaya  ) IPLL BULK MIGRATION for ESRBRF901 & ESRPUJ901 port 8/0/0 & port 8/0/0', 'Segera(Urgent)', 'GITN', ''),
(6, 'PE2014010667598', '2015-08-17', 'Terengganu', '( Jalan Raja Chulan- Kajang ) TRANSFER AND NORMALISE SYSTEM CORE BY CORE FOC KJ-JRC 48C', 'Biasa(Normal)', 'Numix', ''),
(7, 'PE2014015467598', '2015-08-17', 'Sarawak', '( Jalan Raja Chulan- KL) TRANSFER AND NORMALISE SYSTEM FOC KJ-JRC 48C', 'Tunda(Reschedule)', 'Other/TM', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maklumbalas`
--
ALTER TABLE `maklumbalas`
  ADD PRIMARY KEY (`Maklumbalas_ID`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`Notifikasi_ID`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`Pelanggan_ID`);

--
-- Indexes for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  ADD PRIMARY KEY (`Penyelenggara_ID`);

--
-- Indexes for table `penyelenggaraan`
--
ALTER TABLE `penyelenggaraan`
  ADD PRIMARY KEY (`Penyelenggaraan_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maklumbalas`
--
ALTER TABLE `maklumbalas`
  MODIFY `Maklumbalas_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `Notifikasi_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `Pelanggan_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `Penyelenggara_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `penyelenggaraan`
--
ALTER TABLE `penyelenggaraan`
  MODIFY `Penyelenggaraan_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
