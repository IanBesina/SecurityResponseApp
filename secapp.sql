-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2024 at 09:07 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21735645_secapp0a`
--

-- --------------------------------------------------------

--
-- Table structure for table `Incidence`
--

CREATE TABLE `Incidence` (
  `DateTime` text NOT NULL,
  `Latitude` text NOT NULL,
  `Longitude` text NOT NULL,
  `Name` text NOT NULL,
  `Age` int(3) NOT NULL,
  `Gender` text NOT NULL,
  `MobileNumber` text NOT NULL,
  `Status` text NOT NULL,
  `TimeFlagged` text NOT NULL,
  `Details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `PIN` text NOT NULL,
  `Name` text NOT NULL,
  `Age` int(3) NOT NULL,
  `Gender` text NOT NULL,
  `MobileNumber` text NOT NULL,
  `IsActive` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`PIN`, `Name`, `Age`, `Gender`, `MobileNumber`, `IsActive`) VALUES
('ABC123', 'None', 1, 'None', '0', 'False');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Incidence`
--
ALTER TABLE `Incidence`
  ADD UNIQUE KEY `DateTime` (`DateTime`) USING HASH;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
