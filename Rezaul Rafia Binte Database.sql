-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Dec 03, 2024 at 10:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(250) NOT NULL,
  `name` varchar(450) NOT NULL,
  `email` varchar(450) NOT NULL,
  `doctor_id` int(250) NOT NULL,
  `booking_slot` int(250) NOT NULL,
  `contact` varchar(300) NOT NULL,
  `address` varchar(400) NOT NULL,
  `date_of_birth` date NOT NULL,
  `remarks` varchar(999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `doctor_id`, `booking_slot`, `contact`, `address`, `date_of_birth`, `remarks`) VALUES
(1, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 1, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-15', NULL),
(2, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 1, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-15', NULL),
(3, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 1, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-15', NULL),
(4, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 1, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-15', NULL),
(5, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 1, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-15', NULL),
(6, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 1, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-15', NULL),
(7, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 2, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-29', NULL),
(8, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 2, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-29', NULL),
(9, 'Rezaul Rafia Binte', 'rafiabinterezaul7@gmail.com', 1, 0, 'zzz', 'flat no1301,building no-18,', '2024-11-16', NULL),
(10, 'umme ruman', 'UdemyKL27@segi4u.my', 2, 0, '55656', 'flat no1301,building no-18,', '2024-11-22', NULL),
(11, 'umme ruman', 'UdemyKL27@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-22', NULL),
(12, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(13, 'aysha', 'UdemyKL27@segi4u.my', 1, 3, '55656', 'flat no1301,building no-18,', '2024-11-29', NULL),
(14, 'aysha', 'UdemyKL27@segi4u.my', 1, 3, '55656', 'flat no1301,building no-18,', '2024-11-29', NULL),
(15, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(16, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(17, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(18, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(19, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(20, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(21, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(22, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(23, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(24, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(25, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(27, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(28, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(29, 'Rafia', 'SCKL2300423@segi4u.my', 2, 6, '55656', 'flat no1301,building no-18,', '2024-11-23', NULL),
(43, 'Rezaul Rafia Binte', 'rafiabinterezaul@gmail.com', 3, 11, '01133179934', 'flat no1301,building no-18,', '2024-12-26', 'Please Remind Me');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `specialist` varchar(250) NOT NULL,
  `doctor_image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `specialist`, `doctor_image`) VALUES
(1, 'Dr. Rafia Zayra', 'Trichologist', 'igm01.jpg'),
(2, 'Dr. Chong Wei', 'Cosmetic Surgeon', 'doc2.jpg'),
(3, 'Dr. Sara Khan', 'Immunodermatologist', 'rafia.avif');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(250) NOT NULL,
  `doctor_id` int(250) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `doctor_id`, `date_time`) VALUES
(2, 1, '2024-10-23 11:00:00'),
(3, 1, '2024-11-23 15:03:09'),
(5, 2, '2024-11-22 15:03:09'),
(6, 2, '2024-11-21 15:03:09'),
(7, 3, '2024-11-15 15:03:09'),
(8, 3, '2024-11-09 15:26:27'),
(9, 1, '2024-11-22 15:03:09'),
(10, 2, '2024-11-14 15:03:09'),
(11, 3, '2024-11-11 15:03:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doctor` (`doctor_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
