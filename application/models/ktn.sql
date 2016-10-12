-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2016 at 10:17 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ktn`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `reporter_id` int(11) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `datetime_last_seen` datetime NOT NULL,
  `status` enum('Unknown','Left','Adopted','Disappeared') NOT NULL DEFAULT 'Unknown'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `reporter_id`, `lat`, `lng`, `address`, `photo`, `description`, `datetime_last_seen`, `status`) VALUES
(1, 0, 10.3304, 123.902, '', '', 'test2', '2016-10-12 09:21:53', 'Unknown'),
(2, 0, 10.3304, 123.902, 'Lahug, Cebu City, Cebu, Philippines', '', 'test3', '2016-10-12 09:33:49', 'Unknown'),
(3, 0, 10.3341, 123.934, 'Sandugo Sandals Khumbu Enterprises Inc Warehouse, M. C. Briones St, Mandaue City, Cebu, Philippines', '', 'test1', '2016-10-12 09:34:27', 'Unknown'),
(4, 0, 10.3304, 123.902, 'Lahug, Cebu City, Cebu, Philippines', '', 'test1x', '2016-10-12 09:44:56', 'Left');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporter_id` (`reporter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
