-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 11:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prison`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `route` ()  NO SQL BEGIN
SELECT * FROM registration;
SELECT * FROM courses;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `profilepic` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `creationdate`, `updationdate`, `profilepic`, `contact`) VALUES
(1, 'admin', 'admin@gmail.com', 'ffc6c627e5533458e860427ec2e54ad1', '2019-11-14 17:36:19', '2023-01-08 10:14:27', 'zane-lee-RRhmemtmBS4-unsplash.jpg', '0712345678');

-- --------------------------------------------------------

--
-- Table structure for table `cells`
--

CREATE TABLE `cells` (
  `id` int(11) NOT NULL,
  `prison_id` int(20) NOT NULL,
  `cell_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `cell_type` varchar(10) NOT NULL,
  `cell_number` int(11) NOT NULL,
  `seater` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cells`
--

INSERT INTO `cells` (`id`, `prison_id`, `cell_name`, `status`, `date_created`, `cell_type`, `cell_number`, `seater`) VALUES
(17, 9, 'Men Cell 3', 1, '2022-07-11 07:48:10', 'Male', 67, 5);

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `id` int(11) NOT NULL,
  `cell_number` int(11) NOT NULL,
  `cell_type` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `leave_date` date NOT NULL,
  `ad_date` date NOT NULL,
  `seater` int(11) NOT NULL,
  `cell_name` varchar(20) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `prisoner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`id`, `cell_number`, `cell_type`, `status`, `leave_date`, `ad_date`, `seater`, `cell_name`, `date_created`, `prisoner_id`) VALUES
(2, 12, '12', 1, '0000-00-00', '0000-00-00', 0, '12', '2022-07-10', 17),
(3, 16, '16', 1, '0000-00-00', '0000-00-00', 0, '16', '2022-07-10', 17),
(4, 16, '16', 1, '0000-00-00', '0000-00-00', 0, '16', '2022-07-10', 16),
(5, 16, '16', 1, '0000-00-00', '0000-00-00', 0, '16', '2022-07-11', 16),
(6, 16, '16', 1, '0000-00-00', '0000-00-00', 0, '16', '2022-07-11', 16),
(7, 17, '17', 1, '0000-00-00', '0000-00-00', 0, '17', '2022-07-11', 19);

-- --------------------------------------------------------

--
-- Table structure for table `prisoners`
--

CREATE TABLE `prisoners` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `country` varchar(50) NOT NULL,
  `passport` varchar(20) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `crime_name` varchar(100) NOT NULL,
  `profilepic` varchar(100) NOT NULL,
  `conviction` varchar(11000) NOT NULL,
  `jail_date` date NOT NULL,
  `release_date` date NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `updationDate` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prisons`
--

CREATE TABLE `prisons` (
  `prison_id` int(11) NOT NULL,
  `pname` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `date_updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisons`
--

INSERT INTO `prisons` (`prison_id`, `pname`, `type`, `status`, `date_updated`) VALUES
(8, 'Women Prison 1', 'Female', 1, '2022-06-20 10:50:13'),
(9, 'Mens Prison 1', 'Male', 1, '2022-07-10 11:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `table_crime`
--

CREATE TABLE `table_crime` (
  `id` int(11) NOT NULL,
  `crime_name` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_crime`
--

INSERT INTO `table_crime` (`id`, `crime_name`, `status`, `date_created`) VALUES
(4, 'Prostitution', 1, '2022-06-14 06:30:01'),
(7, 'Attempted Murder', 1, '2022-06-14 06:33:07'),
(12, 'TRESSPASS', 1, '2022-06-20 10:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `profilepic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `username`, `email`, `contact`, `password`, `creationdate`, `status`, `profilepic`) VALUES
(4, 'Test', 'Test', 'Test', 'test', 'test@gmail.com', '0712345678', '5dd1e33dd7e4b1f9a4edc3fcb2520ab0', '2022-06-14 13:04:31', 1, 'istockphoto-77931645-170667a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `prisoner_id` int(11) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `m_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `relation` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `updationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cells`
--
ALTER TABLE `cells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prisoners`
--
ALTER TABLE `prisoners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prisons`
--
ALTER TABLE `prisons`
  ADD PRIMARY KEY (`prison_id`);

--
-- Indexes for table `table_crime`
--
ALTER TABLE `table_crime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cells`
--
ALTER TABLE `cells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prisoners`
--
ALTER TABLE `prisoners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `prisons`
--
ALTER TABLE `prisons`
  MODIFY `prison_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `table_crime`
--
ALTER TABLE `table_crime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
