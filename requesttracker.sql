-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 05:55 PM
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
-- Database: `requesttracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `pp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`firstName`, `lastName`, `email`, `username`, `password`, `pp`) VALUES
('George', 'Bravo', 'george.bravo@wayoeltd.com', 'Admin', '$2a$12$PIT.lgXMJOkGPSZLeH0Rjefmzd6Fp.j8.MlfmV4z1vlDlYg/dCHcW', 'default.png'),
('Paul', 'Arthur', 'paularthurjnr@outlook.com', 'Admin', '$2y$10$d3DkjTZUhyhRTr5OCd4OVugLP99Vdkx625Vpa2RFIr3zSZXkWTWFC', '63dbb77a9f5a7.png');

-- --------------------------------------------------------

--
-- Table structure for table `completedrequest`
--

CREATE TABLE `completedrequest` (
  `id` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `department` text NOT NULL,
  `category` text NOT NULL,
  `description` text NOT NULL,
  `time` text NOT NULL,
  `status` text DEFAULT 'Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendingrequest`
--

CREATE TABLE `pendingrequest` (
  `id` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `department` text NOT NULL,
  `category` text NOT NULL,
  `description` text NOT NULL,
  `time` text NOT NULL,
  `status` text NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unsuccessfulrequest`
--

CREATE TABLE `unsuccessfulrequest` (
  `id` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `department` text NOT NULL,
  `category` text NOT NULL,
  `description` text NOT NULL,
  `time` text NOT NULL,
  `status` text NOT NULL DEFAULT 'Unsuccessful'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `pp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`, `pp`) VALUES
('John', 'Doe', 'john.doe@wayoeltd.com', '$2y$10$R5H/gBfGXTD8ewO/i9X6SeAAxQARZNVHxPx1AH8GttvVvF3LHvVL2', '63dbe8c68fedd.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
