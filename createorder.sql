-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2019 at 04:00 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `createorder`
--

CREATE TABLE `createorder` (
  `orderid` int(11) NOT NULL,
  `amt` decimal(10,2) NOT NULL,
  `foodname` varchar(50) NOT NULL,
  `tableid` int(4) NOT NULL,
  `empid` int(4) NOT NULL,
  `datetime` datetime(6) NOT NULL,
  `qty` int(11) NOT NULL,
  `foodcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `createorder`
--
ALTER TABLE `createorder`
  ADD KEY `foodcode` (`foodcode`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `createorder`
--
ALTER TABLE `createorder`
  ADD CONSTRAINT `createorder_ibfk_1` FOREIGN KEY (`foodcode`) REFERENCES `menutable` (`foodcode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
