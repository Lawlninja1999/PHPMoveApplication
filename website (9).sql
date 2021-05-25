-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2018 at 09:06 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `memberdetails`
--

CREATE TABLE `memberdetails` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `FirstName` char(30) NOT NULL,
  `LastName` char(30) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `YearOfBirth` year(4) NOT NULL,
  `Country` char(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `AccessLevel` char(10) DEFAULT 'Member',
  `Ban` varchar(100) DEFAULT NULL,
  `Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memberdetails`
--

INSERT INTO `memberdetails` (`UserID`, `FirstName`, `LastName`, `Username`, `EmailAddress`, `YearOfBirth`, `Country`, `Password`, `AccessLevel`, `Ban`, `Time`) VALUES
(29, '', '', 'Adam21', 'cc', 1999, '', 'Adam21', 'Admin', NULL, NULL),
(28, '', '', 'bteah', 'aaa', 1992, '', 'bteah', 'Member', NULL, NULL),
(30, '', '', 'Tam', 'baba', 1999, '', 'Tamishere', 'Member', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moviesdb`
--

CREATE TABLE `moviesdb` (
  `movieName` varchar(100) NOT NULL,
  `Director` char(30) NOT NULL,
  `Date` year(4) NOT NULL,
  `Duration` int(10) UNSIGNED NOT NULL,
  `Writers` varchar(30) NOT NULL,
  `Plot` varchar(255) NOT NULL,
  `MovieID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moviesdb`
--

INSERT INTO `moviesdb` (`movieName`, `Director`, `Date`, `Duration`, `Writers`, `Plot`, `MovieID`) VALUES
('Armstrong', 'wevdw', 2012, 122, 'wdkvj w', ' nfn', 64);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `MovieRating` int(11) NOT NULL,
  `MovieID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratingtable`
--

CREATE TABLE `ratingtable` (
  `Chat` varchar(200) NOT NULL,
  `chatID` int(100) UNSIGNED NOT NULL,
  `MovieID` int(100) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratingtable`
--

INSERT INTO `ratingtable` (`Chat`, `chatID`, `MovieID`, `Date`, `Username`) VALUES
('hahah', 60, 64, '2018-10-03 00:59:14', 'bteah'),
('what is this?', 61, 64, '2018-10-03 00:59:25', 'bteah'),
('i like ', 62, 64, '2018-10-03 01:00:16', 'Tam'),
('nice', 63, 64, '2018-10-03 01:00:22', 'Tam'),
('lol', 64, 64, '2018-10-03 01:00:59', 'Adam21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memberdetails`
--
ALTER TABLE `memberdetails`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Email Address` (`EmailAddress`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `moviesdb`
--
ALTER TABLE `moviesdb`
  ADD PRIMARY KEY (`MovieID`),
  ADD UNIQUE KEY `MovieID` (`MovieID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`MovieID`,`Username`);

--
-- Indexes for table `ratingtable`
--
ALTER TABLE `ratingtable`
  ADD PRIMARY KEY (`chatID`),
  ADD UNIQUE KEY `chatID` (`chatID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memberdetails`
--
ALTER TABLE `memberdetails`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `moviesdb`
--
ALTER TABLE `moviesdb`
  MODIFY `MovieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `ratingtable`
--
ALTER TABLE `ratingtable`
  MODIFY `chatID` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
