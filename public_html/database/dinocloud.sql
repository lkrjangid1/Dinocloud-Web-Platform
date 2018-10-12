-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2018 at 04:10 PM
-- Server version: 10.1.23-MariaDB-9+deb9u1
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinocloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'unique ID for every uploaded file',
  `userID` int(11) NOT NULL COMMENT 'userID used to create a separate file path for each individual user. This userid will be associated with ''id'' from table users',
  `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FileType` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FileSize` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL COMMENT 'This ID is unique for each user',
  `userName` varchar(100) NOT NULL COMMENT 'Full name of the registered user',
  `userAddress` varchar(200) NOT NULL COMMENT 'Full address of the member',
  `userPhone` varchar(30) NOT NULL COMMENT 'Users phone number',
  `userCountry` varchar(20) NOT NULL COMMENT 'Users Country, state location',
  `userPlan` varchar(20) NOT NULL DEFAULT 'Free Plan' COMMENT 'Show pricing plan for each user',
  `userEmail` varchar(100) NOT NULL COMMENT 'This field is set with Primary key, users will log in with their email address',
  `userPass` varchar(150) NOT NULL COMMENT 'User password, which requires encrypting',
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '''Is the user account activated? Yes or No?''',
  `userRoles` varchar(100) NOT NULL DEFAULT 'Standard User' COMMENT 'Admin/Standard user roles',
  `tokenCode` varchar(100) NOT NULL COMMENT 'Token code to activate the user account',
  `joinedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Displays the users joind date and time of their accounts'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userAddress`, `userPhone`, `userCountry`, `userPlan`, `userEmail`, `userPass`, `userStatus`, `userRoles`, `tokenCode`, `joinedDate`) VALUES
(41, 'Radu Goada', 'Bd Ferdinand 1 nr. 66B', '0728637370', 'Romania', 'Free Plan', 'radu.goada@gmail.com', 'a2f1e582118f69534aea1022cd6c3f9dc0e1cb4b6f0d56b795c3fb9115db9c8daee1b39666b234d92b79ea59b2db537812d8f3d27de58f62f93cf7e355ac3c19', 'Y', 'Standard User', '0e167dc91ad5fcd3532e04528bc54eb4', '2018-10-11 16:06:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'unique ID for every uploaded file', AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This ID is unique for each user', AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
