-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2017 at 04:16 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yukirim`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_user_sub`
--

CREATE TABLE `m_user_sub` (
  `user_sub_id` int(11) NOT NULL,
  `user_sub_email` varchar(50) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `user_sub_fullname` text NOT NULL,
  `user_group` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_sub_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` text NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `m_user_sub`
--
ALTER TABLE `m_user_sub`
  ADD PRIMARY KEY (`user_sub_id`),
  ADD UNIQUE KEY `email` (`user_sub_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_user_sub`
--
ALTER TABLE `m_user_sub`
  MODIFY `user_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
