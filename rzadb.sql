-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 09:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rzadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(11) NOT NULL,
  `roomName` varchar(40) NOT NULL,
  `roomDescription` longtext NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomName`, `roomDescription`, `price`) VALUES
(1, 'Single', 'Cozy single room with a comfortable bed and basic amenities.', 50),
(2, 'Single', 'Cozy single room with a comfortable bed and basic amenities.', 50),
(3, 'Single', 'Cozy single room with a comfortable bed and basic amenities.', 50),
(4, 'Single', 'Cozy single room with a comfortable bed and basic amenities.', 50),
(5, 'Single', 'Cozy single room with a comfortable bed and basic amenities.', 50),
(6, 'Double', 'Comfortable double room with two beds ideal for couples or friends.', 70),
(7, 'Double', 'Comfortable double room with two beds ideal for couples or friends.', 70),
(8, 'Double', 'Comfortable double room with two beds ideal for couples or friends.', 70),
(9, 'Double', 'Comfortable double room with two beds ideal for couples or friends.', 70),
(10, 'Double', 'Comfortable double room with two beds ideal for couples or friends.', 70),
(11, 'Deluxe', 'Luxurious room with elegant decor and premium amenities.', 100),
(12, 'Deluxe', 'Luxurious room with elegant decor and premium amenities.', 100),
(13, 'Deluxe', 'Luxurious room with elegant decor and premium amenities.', 100),
(14, 'Deluxe', 'Luxurious room with elegant decor and premium amenities.', 100),
(15, 'Deluxe', 'Luxurious room with elegant decor and premium amenities.', 100),
(16, 'Family', 'Spacious room suitable for families, featuring multiple beds and family-friendly amenities.', 120),
(17, 'Family', 'Spacious room suitable for families, featuring multiple beds and family-friendly amenities.', 120),
(18, 'Family', 'Spacious room suitable for families, featuring multiple beds and family-friendly amenities.', 120),
(19, 'Family', 'Spacious room suitable for families, featuring multiple beds and family-friendly amenities.', 120),
(20, 'Family', 'Spacious room suitable for families, featuring multiple beds and family-friendly amenities.', 120);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
