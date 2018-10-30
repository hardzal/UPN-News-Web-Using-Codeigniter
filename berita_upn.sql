-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2018 at 01:29 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berita_upn`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `no_berita` int(3) NOT NULL,
  `no_kategori` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `judul_berita` varchar(50) NOT NULL,
  `headline_berita` text NOT NULL,
  `isi_berita` text NOT NULL,
  `hari` varchar(20) NOT NULL,
  `tgl_berita` date NOT NULL,
  `jam_berita` time NOT NULL,
  `gambar_berita` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`no_berita`, `no_kategori`, `username`, `judul_berita`, `headline_berita`, `isi_berita`, `hari`, `tgl_berita`, `jam_berita`, `gambar_berita`) VALUES
(2, 3, 'bayu', 'Belajar PHP MySQLi', 'Programming', 'merupakan kependekan dari MYSQL Improved extension. Seperti yang terlihat dari namanya, extension PHP ini merupakan versi perbaikan dan penambahan dari extension MYSQL sebelumnya yang umum digunakan. Extension PHP MYSQLI dibuat dengan tujuan untuk mendukung fitur-fitur terbaru dari MYSQL server versi 4.1 ke atas.', 'Senin', '2018-10-29', '17:20:15', 'img_acm.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `no_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL,
  `gambar_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`no_kategori`, `nama_kategori`, `gambar_kategori`) VALUES
(1, 'politik', 'politik.jpg'),
(2, 'ekonomi', 'ekonomi.jog'),
(3, 'pendidikan', 'pendidikan.jpg'),
(4, 'kriminal', 'kriminal.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reporter`
--

CREATE TABLE `reporter` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `gambar_reporter` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reporter`
--

INSERT INTO `reporter` (`username`, `password`, `nama_lengkap`, `email`, `no_hp`, `gambar_reporter`) VALUES
('anda', '54321', 'andae', 'andae@gmail.com', '0843190391', 'img_chelsea.jpg'),
('andi', '54321', 'andi', 'andi@gmail.com', '08793189831', 'img_chelsea.jpg'),
('bayu', 'bayu', 'Bayu Saputra', 'babahayoo@gmail.com', '081261868994', 'img_acm.png'),
('fanda', '54321', 'nsifyu', 'fanda@gmail.com', '08409232032', 'img_chelsea.jpg'),
('nisfu', '54321', 'nsifyu', 'nisfu@gmail.com', '08409232032', 'img_chelsea.jpg'),
('riski', '12345', 'riski m', 'riski@gmail.com', '08783120931', 'img_arsenal.jpg'),
('sakti', '5431321', 'sakte', 'saktie@gmail.com', '08409232032', 'img_chelsea.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`no_berita`),
  ADD KEY `kategori_foreign` (`no_kategori`),
  ADD KEY `username_foreign` (`username`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`no_kategori`);

--
-- Indexes for table `reporter`
--
ALTER TABLE `reporter`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `no_berita` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `no_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `username_foreign` FOREIGN KEY (`username`) REFERENCES `reporter` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
