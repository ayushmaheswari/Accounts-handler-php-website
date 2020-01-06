-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2020 at 05:00 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `accno` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`accno`, `balance`) VALUES
(410, 124500);

-- --------------------------------------------------------

--
-- Table structure for table `bankcash`
--

CREATE TABLE `bankcash` (
  `cash` int(11) DEFAULT NULL,
  `tdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bankcash`
--

INSERT INTO `bankcash` (`cash`, `tdate`) VALUES
(200000, '2019-12-16'),
(45000, '2019-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `cid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `tdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`cid`, `amount`, `tdate`) VALUES
(6, 3000, '2019-12-16'),
(7, 2500, '2019-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `cheque`
--

CREATE TABLE `cheque` (
  `cid` int(11) NOT NULL,
  `chequeid` varchar(25) NOT NULL,
  `amount` int(11) NOT NULL,
  `tdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cheque`
--

INSERT INTO `cheque` (`cid`, `chequeid`, `amount`, `tdate`) VALUES
(6, '3456', 20000, '2019-12-16'),
(7, '15741', 10000, '2019-12-16'),
(7, '8456', 20000, '2019-12-16'),
(8, '012456', 10500, '2019-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `cid` int(11) NOT NULL,
  `cname` varchar(50) DEFAULT NULL,
  `cballance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`cid`, `cname`, `cballance`) VALUES
(6, 'rishabh dhariwal traders', 0),
(7, 'ayush traders', 0),
(8, 'radha and company', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companyrecite`
--

CREATE TABLE `companyrecite` (
  `cid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `gst` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `billno` varchar(25) DEFAULT NULL,
  `tdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companyrecite`
--

INSERT INTO `companyrecite` (`cid`, `amount`, `gst`, `total`, `billno`, `tdate`) VALUES
(6, 20000, 1000, 21000, '1234', '2019-12-16'),
(6, 40000, 2000, 42000, '2345', '2019-12-16'),
(7, 50000, 2500, 52500, '1478', '2019-12-16'),
(8, 10000, 500, 10500, '475', '2019-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `ebank`
--

CREATE TABLE `ebank` (
  `cid` int(11) NOT NULL,
  `ebankid` varchar(25) NOT NULL,
  `amount` int(11) NOT NULL,
  `tdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ebank`
--

INSERT INTO `ebank` (`cid`, `ebankid`, `amount`, `tdate`) VALUES
(6, '4567', 40000, '2019-12-16'),
(7, '9999', 15000, '2019-12-16'),
(7, '1579', 5000, '2019-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `myuser`
--

CREATE TABLE `myuser` (
  `userid` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myuser`
--

INSERT INTO `myuser` (`userid`, `password`) VALUES
('ram', 'ram123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `cheque`
--
ALTER TABLE `cheque`
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `companyrecite`
--
ALTER TABLE `companyrecite`
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `ebank`
--
ALTER TABLE `ebank`
  ADD KEY `cid` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cash`
--
ALTER TABLE `cash`
  ADD CONSTRAINT `cash_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `company` (`cid`);

--
-- Constraints for table `cheque`
--
ALTER TABLE `cheque`
  ADD CONSTRAINT `cheque_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `company` (`cid`);

--
-- Constraints for table `companyrecite`
--
ALTER TABLE `companyrecite`
  ADD CONSTRAINT `companyrecite_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `company` (`cid`);

--
-- Constraints for table `ebank`
--
ALTER TABLE `ebank`
  ADD CONSTRAINT `ebank_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `company` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
