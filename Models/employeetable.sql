-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2019 at 01:55 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

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
-- Table structure for table `employeetable`
--

CREATE TABLE `employeetable` (
  `empid` int(2) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contactinfo` int(12) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `hiredate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeetable`
--

INSERT INTO `employeetable` (`empid`, `name`, `address`, `contactinfo`, `role`, `gender`, `email`, `password`, `hiredate`) VALUES
(26, 'Rob', 'Parkville', 1298124329, 'Admin', 'Male', 'rob@gmail.com', '123456789', '2019-11-23 00:00:00'),
(27, 'Bob', 'Texas', 111222983, 'Staff', 'Male', 'bob@gmail.com', '12345', '2019-11-14 00:00:00'),
(28, 'Abaca', 'Sarawak', 132823127, 'Admin', 'Female', 'abaca@gmail.com', '12345', '2019-11-06 00:00:00'),
(29, 'Qwerty', 'Qwertyland', 180793409, 'Admin', 'Female', 'qwerty@gmail.com', 'qwerty', '2019-07-24 00:00:00'),
(30, 'test', 'testland', 10127471, 'Staff', 'Female', 'test@gmail.com', '12345', '0000-00-00 00:00:00'),
(31, 'John', 'Kuala Lumpur', 173109721, 'Staff', 'Male', 'john@gmail.com', 'johnjohn', '2019-11-10 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeetable`
--
ALTER TABLE `employeetable`
  ADD PRIMARY KEY (`empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employeetable`
--
ALTER TABLE `employeetable`
  MODIFY `empid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
