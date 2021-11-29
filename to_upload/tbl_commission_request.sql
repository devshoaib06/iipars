-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2017 at 02:42 PM
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
-- Table structure for table `tbl_commission_request`
--

CREATE TABLE `tbl_commission_request` (
  `request_id` int(55) NOT NULL,
  `user_id` int(55) NOT NULL,
  `request_amount` float(12,2) NOT NULL,
  `request_status` enum('pending','approved','paid') NOT NULL DEFAULT 'pending',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_commission_request`
--

INSERT INTO `tbl_commission_request` (`request_id`, `user_id`, `request_amount`, `request_status`, `created_date`) VALUES
(1, 7, 2000.00, 'approved', '2017-06-23 15:28:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_commission_request`
--
ALTER TABLE `tbl_commission_request`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_commission_request`
--
ALTER TABLE `tbl_commission_request`
  MODIFY `request_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
