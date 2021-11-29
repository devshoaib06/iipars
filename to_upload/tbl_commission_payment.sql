-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2017 at 02:44 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_commission_payment`
--

CREATE TABLE `tbl_commission_payment` (
  `commission_payment_id` int(55) NOT NULL,
  `request_id` int(55) NOT NULL,
  `pay_amount` decimal(12,2) NOT NULL,
  `pay_by` varchar(255) NOT NULL,
  `pay_mode` varchar(255) NOT NULL,
  `pay_details` text NOT NULL,
  `pay_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_commission_payment`
--
ALTER TABLE `tbl_commission_payment`
  ADD PRIMARY KEY (`commission_payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_commission_payment`
--
ALTER TABLE `tbl_commission_payment`
  MODIFY `commission_payment_id` int(55) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
