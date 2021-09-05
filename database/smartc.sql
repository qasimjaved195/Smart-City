-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2020 at 08:06 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartc`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `a_id` int(100) NOT NULL,
  `m_id` int(100) NOT NULL,
  `a_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`a_id`, `m_id`, `a_name`) VALUES
(2, 6, 'Gulistan Colony'),
(16, 4, 'ahmadabad'),
(17, 2, 'mil'),
(18, 3, 'Uos'),
(19, 4, 'MilatTown'),
(20, 5, 'fsd'),
(24, 1, 'Main'),
(25, 1, 'Canal'),
(26, 1, 'WaterTank'),
(27, 1, 'Buildings');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `m_id` int(100) NOT NULL,
  `m_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`m_id`, `m_name`) VALUES
(1, 'Waste Bin'),
(2, 'Traffic Lights'),
(3, 'Parking'),
(4, 'Water Tank'),
(5, 'Canal water level'),
(25, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mvariables`
--

CREATE TABLE `mvariables` (
  `mv_id` int(100) NOT NULL,
  `a_id` int(100) NOT NULL,
  `m_id` int(100) NOT NULL,
  `mv_name` varchar(100) NOT NULL,
  `min` int(10) NOT NULL,
  `max` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mvariables`
--

INSERT INTO `mvariables` (`mv_id`, `a_id`, `m_id`, `mv_name`, `min`, `max`) VALUES
(9, 17, 2, 't1', 0, 0),
(10, 17, 2, 't2', 0, 0),
(11, 18, 3, 'p1', 0, 0),
(12, 20, 5, 'uc', 45, 27),
(21, 16, 4, 'uw', 65, 29),
(22, 18, 3, 'p2', 0, 0),
(23, 18, 3, 'p3', 0, 0),
(24, 18, 3, 'p4', 0, 0),
(25, 24, 1, 'ub1', 64, 25),
(26, 24, 1, 'ub2', 57, 23),
(27, 24, 1, 'ub3', 58, 21),
(28, 25, 1, 'ub1', 64, 25),
(29, 26, 1, 'ub2', 57, 23),
(30, 27, 1, 'ub3', 58, 21);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(10) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'water'),
(3, 'traffic'),
(4, 'slights'),
(5, 'wasteb'),
(6, 'parking');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(50) NOT NULL,
  `u_fname` varchar(50) NOT NULL,
  `u_lname` varchar(50) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `m_id` int(10) NOT NULL,
  `u_vrs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_fname`, `u_lname`, `u_email`, `u_pass`, `m_id`, `u_vrs`) VALUES
(5, 'Mmmm', 'Mehran', 'mehran.shabir@hotmail.com', '$2y$10$gVjTJ5RrWffPErj3vZx89OpnnK9KoI41s97TvwmnR0hMvkET4IS32', 4, NULL),
(7, 'M', 'Mehrann', 'mehran.shabir@gmail.com', '$2y$10$6YoF0epMagNWXpGoNwq.QOBxKg04Q642F/Kupb25A4gn5WaIluSsO', 25, NULL),
(8, 'admin', 'admin', 'admin@admin.com', '$2y$10$t85z6D/DVy3qD1c5eS0.BeMO2gTTPg9HewgpqPzwmy.PtdriTql8O', 25, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `mvariables`
--
ALTER TABLE `mvariables`
  ADD PRIMARY KEY (`mv_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `a_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `m_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mvariables`
--
ALTER TABLE `mvariables`
  MODIFY `mv_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
