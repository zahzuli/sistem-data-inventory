-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 05:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `qty` int(11) NOT NULL,
  `penerima` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `qty`, `penerima`) VALUES
(2, 4, '0000-00-00', 100, 'Fares');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(2, 'stocker55@gmail.com', 'stocker');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `qty`, `keterangan`) VALUES
(5, 4, '0000-00-00', 20, 'Barang Baru'),
(6, 4, '0000-00-00', 10, 'Aiman'),
(8, 4, '2024-09-18', 5, 'Fares'),
(9, 4, '2024-09-17', 5, 'Baru Datang');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `kd` varchar(25) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `spek` varchar(20) NOT NULL,
  `produsen` varchar(45) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `lokasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `kd`, `namabarang`, `spek`, `produsen`, `stock`, `satuan`, `lokasi`) VALUES
(7, '2PV-F1585-00', 'ARM', 'Null', 'Gudang 3', 5000, 'Pcs', ''),
(8, '19040-K84-9001-21', 'AS JOINT SHROUD (CUT+BENDING)', 'Null', 'Gudang 2', 6000, 'Pcs', ''),
(9, '50190-KWW-B200-20', 'BAR COMP STD STOPPER', 'Null', 'Gudang 1', 6000, 'Pcs', ''),
(10, '2PV-XFI41-00', 'BAR CROSS', 'Null', 'Gudang 1', 6000, 'Pcs', ''),
(11, '50530-K45-N000-21', 'BAR INNER K45 (PIPE INNER)', 'Null', 'Gudang 3', 7000, 'Pcs', ''),
(12, '50530-K64 -NA00-20', 'BAR STAND K64J', 'Null', 'Gudang 3', 1500, 'Pcs', ''),
(13, '50530-K64 -N000-20', 'BAR STAND K64A', 'Null', 'Gudang 3', 1000, 'Pcs', ''),
(14, '46500-K64A-N000-23', 'BOSS K64A', 'Null', 'Gudang 3', 3000, 'Pcs', ''),
(15, '1FD-F1437-00', 'BOSS MAIN STAND 1', 'Null', 'CV. WPG', 7000, 'Pcs', ''),
(16, '1FD-F138-00', 'BOSS MAIN STAND 2', 'Null', 'CV. WPG', 7000, 'Pcs', ''),
(17, '48516-25050-A', 'COLLAR ABSORBER', 'Null', 'Gudang 3', 3000, 'Pcs', ''),
(18, '24711-K64J-ND00-22', 'COLLAR K64J', 'Null', 'Gudang 3', 3000, 'Pcs', ''),
(19, '50500-KOJA-N002-22', 'COLLAR KOJA', 'Null', 'Gudang 4', 10000, 'Pcs', ''),
(20, '50190-KWW0-6000-23', 'COLLAR RR BRAKE PIVOT', 'Null', 'Gudang 4', 7000, 'Pcs', ''),
(21, '5BP-F5388-00', 'COLLAR SHAFT, PULLER CHAIN', 'Null', 'Gudang 1', 1500, 'Pcs', ''),
(22, '50130-K56A-N002-21', 'HOOK A K56', 'Null', 'Gudang 4', 10000, 'Pcs', ''),
(23, '46500-K64A-N000-22', 'PEDAL K64A', 'Null', 'Gudang 3', 3000, 'Pcs', ''),
(24, '50610-KYZ-9000-27', 'PIN HOOK K41', 'Null', 'CV. SKT', 10000, 'Pcs', ''),
(25, '50503-KZL-9300-21', 'PIN K1AA', 'Null', 'CV. SKT, PT. API, CV. DUA SEJAHTERA', 60000, 'Pcs', ''),
(26, '50259-KPH-9000H1', 'PIN SPRING HOOK KPH', 'Null', 'CV.WPG & Endarto', 10000, 'Pcs', ''),
(27, '00000841', 'PIPA ROD OTL ISUZU (JASA MAKLON)', 'Null', 'Gudang 3', 1000, 'Pcs', ''),
(28, '2PV-XF141-00-C', 'PIPE 3', 'Null', 'Gudang 3', 3000, 'Pcs', ''),
(29, '50711-KZL-9000-22 (CT1)', 'PIPE BAR ASSY L (CT1)/ R(CT1)', 'Null', 'Gudang 3', 12000, 'Pcs', ''),
(30, '50512-KAN-9610-A', 'PIPE MAIN STAND PIVOT', 'Null', 'Gudang 3', 3000, 'Pcs', ''),
(31, '50530-K81A-N001-21', 'PIPE STAND INNER', 'Null', 'Gudang 4', 20000, 'Pcs', ''),
(32, '50107-K56A-N0006-21', 'PIPE STAND PIVOT', 'Null', 'Gudang 1', 2000, 'Pcs', ''),
(33, '50351-K0J -N000-28', 'PIPE, LINK ENG HANGER', 'Null', 'Gudang 4', 8000, 'Pcs', ''),
(34, '50500-K15-9200-21', 'PIVOT STAND PIPE', 'Null', 'CV. WPG', 8000, 'Pcs', ''),
(35, '50503-KOJA-N003-20', 'SHAFT KOJA', 'Null', 'Gudang 1', 20000, 'Pcs', ''),
(36, '50526-KVX-6000-A', 'SHAFT MAIN STD PVT KVX', 'Null', 'Gudang 2', 3000, 'Pcs', ''),
(37, '77234-KYZ-9000', 'SPRING SEAT LOCK', 'Null', 'CV. Hasatech', 30000, 'Pcs', ''),
(38, '50500-K59-A100-24', 'COLLAR K2SA', 'Null', 'Gudang 4', 8000, 'Pcs', ''),
(39, '50351-KZR-6000-21', 'COLLAR K59 Ø15 x 10.1 x 175,5', 'Null', 'Gudang 4', 7000, 'Pcs', ''),
(40, '50351-KZL-9300', 'BAR ENG STOPPER', 'Null', 'Endarto', 6000, 'Pcs', ''),
(41, 'SZ106-08029', 'BOLT LURUS', 'Null', 'Gudang 3', 1000, 'Pcs', ''),
(42, 'SZ106-08030', 'BOLT TIRUS', 'Null', 'Gudang 3', 1000, 'Pcs', ''),
(43, '52525-EWO21', 'COLLAR BUMPER', 'Null', 'Gudang 4', 5000, 'Pcs', ''),
(44, '46500-K64A-N000-22', 'BOSS K64A', 'Null', 'Gudang 3', 1500, 'Pcs', ''),
(45, '46500-K64A-N000-22', 'PEDAL K64A', 'Null', 'Gudang 3', 1500, 'Pcs', ''),
(46, 'ES40400486', 'CARIER SHAFT', 'Null', 'Gudang 1', 12000, 'Pcs', ''),
(47, 'BBS-F7419-01', 'BOSS 1 Ø 20', 'Null', 'Gudang 1', 2000, 'Pcs', ''),
(48, 'STKM 19,1x4,5x16', 'BOSS HANGER ENGINE 1 ', 'Null', 'Plant 3 cileungsi', 6000, 'Pcs', ''),
(49, 'STKM 19,1x4,5x14', 'BOSS HANGER ENGINE 2 ', 'Null', 'Plant 3 cileungsi', 6000, 'Pcs', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
