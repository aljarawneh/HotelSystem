-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 11:05 PM
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
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotelID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `roomType` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `purchaseDate` datetime NOT NULL,
  `price` float NOT NULL,
  `comment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomType` int(11) NOT NULL,
  `roomName` varchar(40) NOT NULL,
  `roomDescription` longtext NOT NULL,
  `price` float NOT NULL,
  `available` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `ticketType` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `comments` longtext NOT NULL,
  `purchaseDate` datetime NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `ticketType` int(11) NOT NULL,
  `ticketName` varchar(40) NOT NULL,
  `ticketDescription` longtext NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`ticketType`, `ticketName`, `ticketDescription`, `price`) VALUES
(1, 'Adult - Day Ticket', 'Adult (18+ yrs) ticket only £25.00 in advance. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 25),
(2, 'Adult - Week Ticket', 'Adult (18+ yrs) ticket only £150.00 in advance. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 150),
(3, 'Adult - Month Ticket', 'Adult (18+ yrs) ticket only £500.00 in advance. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 500),
(4, 'Adult - Year Ticket', 'Adult (18+ yrs) ticket only £1500.00 in advance. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 1500),
(5, 'Children - Day Ticket', 'Child (3-17 yrs) ticket only £15.00 in advance. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 15),
(6, 'Children - Week Ticket', 'Child (3-17 yrs) ticket only £90.00 in advance. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 90),
(7, 'Children - Month Ticket', 'Child (3-17 yrs) ticket only £300.00 in advance. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 300),
(8, 'Children - Year Ticket', 'Child (3-17 yrs) ticket only £900.00 in advance. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 900),
(9, 'Family - Day Ticket', 'Family ticket for 2 adults and 2 children only £60.00 in advance. Babies (Under 3 yrs) go FREE. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 60),
(10, 'Family - Week Ticket', 'Family ticket for 2 adults and 2 children only £360.00 in advance. Babies (Under 3 yrs) go FREE. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 360),
(11, 'Family - Month Ticket', 'Family ticket for 2 adults and 2 children only £1200.00 in advance. Babies (Under 3 yrs) go FREE. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 1200),
(12, 'Family - Year Ticket', 'Family ticket for 2 adults and 2 children only £3600.00 in advance. Babies (Under 3 yrs) go FREE. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 3600),
(13, 'Educational - Day Ticket', 'Educational admission for a group of 30 students and up to 5 adults for one day. Includes guided tours and educational materials. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 200),
(14, 'Educational - Week Ticket', 'Educational admission for a group of 30 students and up to 5 adults for one week. Includes guided tours and educational materials. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 1000),
(15, 'Educational - Month Ticket', 'Educational admission for a group of 30 students and up to 5 adults for one month. Includes guided tours and educational materials. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 4000),
(16, 'Educational - Year Ticket', 'Educational admission for a group of 30 students and up to 5 adults for one year. Includes guided tours and educational materials. Must pre-book in advance. Access to loyalty scheme when purchased and used. *Save 10% when you book online at least a day in advance. The price for the on-site hotel will be reduced if bought in person with this ticket. FREE parking', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customerID` int(11) NOT NULL,
  `firstName` varchar(80) NOT NULL,
  `lastName` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password_text` varchar(80) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customerID`, `firstName`, `lastName`, `email`, `password_text`, `isAdmin`) VALUES
(4, 'Aveson', 'Testingasdasd', 'aveson123@gmail.com', '$2y$10$9KAUZoYrLNqCmEIoPLwYgerI.oifepjUwWWkwRWq65aiV2CRst95i', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotelID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomType`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ticketType`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `ticketType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
