-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 08:58 AM
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
-- Database: `cafedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tablestable`
--

CREATE TABLE `tablestable` (
  `tableno` int(4) NOT NULL,
  `servestatus` varchar(20) CHARACTER SET utf8 NOT NULL,
  `reservedate` date DEFAULT NULL,
  `reservetime` time DEFAULT NULL,
  `reservename` varchar(50) CHARACTER SET utf8 NOT NULL,
  `availability` varchar(3) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tablestable`
--

INSERT INTO `tablestable` (`tableno`, `servestatus`, `reservedate`, `reservetime`, `reservename`, `availability`) VALUES
(1, 'no', '2019-11-13', '13:50:00', 'lala', 'yes'),
(2, 'no', NULL, NULL, '', 'yes'),
(3, 'no', NULL, NULL, '', 'yes'),
(4, 'no', NULL, NULL, '', 'yes'),
(5, 'no', NULL, NULL, '', 'yes'),
(6, 'no', NULL, NULL, '', 'yes'),
(7, 'no', NULL, NULL, '', 'yes'),
(8, 'no', NULL, NULL, '', 'yes'),
(9, 'no', NULL, NULL, '', 'yes'),
(10, 'no', NULL, NULL, '', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tablestable`
--
ALTER TABLE `tablestable`
  ADD PRIMARY KEY (`tableno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tablestable`
--
ALTER TABLE `tablestable`
  MODIFY `tableno` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
