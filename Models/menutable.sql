-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 08:59 AM
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
-- Table structure for table `menutable`
--

CREATE TABLE `menutable` (
  `img` varchar(200) NOT NULL,
  `foodcode` int(11) NOT NULL,
  `dishname` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menutable`
--

INSERT INTO `menutable` (`img`, `foodcode`, `dishname`, `description`, `price`) VALUES
('americanmocha.jpg', 1, 'American Mocha', 'Coffee', '10.50'),
('charcoal.jpg', 2, 'Charcoal', 'Coffee', '12.00'),
('latte.jpg', 3, 'Latte', 'Coffee', '11.30'),
('cappucino.jpeg', 4, 'Cappuccino', 'Coffee', '15.00'),
('royal.jpg', 5, 'Royal', 'Coffee', '14.00'),
('earlgrey.jpg', 6, 'Earl Grey', 'Tea', '13.00'),
('jasminegreen.jpg', 7, 'Jasmine Green', 'Tea', '14.00'),
('matcha.jpg', 8, 'Matcha', 'Tea', '10.00'),
('lemontea.jpg', 9, 'Lemon', 'Tea', '8.90'),
('chamomile.jpg', 10, 'Chamomile', 'Tea', '13.20'),
('rosetea.jpg', 11, 'Rose', 'Tea', '11.00'),
('black.jpg', 12, 'Black', 'Tea', '9.90'),
('chocowaffle.jpg', 13, 'Choco Waffle', 'Dessert', '5.00'),
('marbledcake.jpg', 14, 'Marbled Cake', 'Dessert', '8.90'),
('lemoncheesecake.jpg', 15, 'Lemon Cheesecake', 'Dessert', '12.50'),
('brownie.jpg', 16, 'Fudge Brownies', 'Dessert', '9.90'),
('macaron.jpg', 17, 'Macaron', 'Dessert', '20.00'),
('muffin.jpg', 18, 'Muffins', 'Dessert', '6.40'),
('blueberrytart.jpg', 19, 'Blueberry Tart', 'Dessert', '6.80'),
('eggmayo.jpg', 20, 'Egg Mayonaise', 'Sandwich', '4.80'),
('hamcheee.jpg', 21, 'Ham Cheese', 'Sandwich', '6.20'),
('tunasalmon.jpg', 22, 'Tuna Salmon', 'Sandwich', '7.90');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menutable`
--
ALTER TABLE `menutable`
  ADD PRIMARY KEY (`foodcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menutable`
--
ALTER TABLE `menutable`
  MODIFY `foodcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
