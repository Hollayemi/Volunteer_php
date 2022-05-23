-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 02:53 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newhelper_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id` int(255) NOT NULL,
  `password` text NOT NULL,
  `isAdmin` int(20) DEFAULT NULL,
  `authToken` text NOT NULL,
  `fullname` text NOT NULL,
  `status` text CHARACTER SET utf8 NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`email`, `id`, `password`, `isAdmin`, `authToken`, `fullname`, `status`) VALUES
('test@test.com', 13, '$2y$10$DnIsmnetF0AwKcTeLrCI9OQZJJpoIqZuRSkpwVbUEzwPBgcwnh6zK', NULL, '8b4f5e71ae9f855fb30e851ebd1b303d78154bf056ea11a19cdae70ac9ee251619689a815eb8930288fa1918c8a124f64099', 'test1', 'deactivated'),
('test2@test.com', 14, '$2y$10$rKxdNa0Ow958HnNMQJTWtepWdvqMcVyy0Eq9uGhc2gSr1tdsrJhV6', NULL, 'c02340f0955dccc8fb544d4f57b2e91bb2a826a0a0bedd6e36c362f78928f7effca9af0a75d06d6eb9db1b027f7306d1b617', 'test2', 'deactivated'),
('test3@test.com', 15, '$2y$10$urPtoYmy1mwNUfT.LUTfduN.urEycBzI70npMGBoNDvgk/P1344rC', NULL, 'c3db1d0aca916cab778a0e072a7189706a058d6c15b6443a498d998334d0c7dab07e78cbac018f68d8a89d64ad98b7ecc242', 'test3', 'active'),
('test4@test.com', 16, '$2y$10$7EF5Mp5I.d/I1.xYkNB13.iHNep6k2Vulkuj3gelNgbej3wfKgAf6', NULL, '134bfc502ee1847df7d14a627471e718b99861e1308c57497577bbd627d01550b78bc494e584e4b512be6a65ea17a89c498a', 'test4', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `vol_admin`
--

CREATE TABLE `vol_admin` (
  `id` int(100) NOT NULL,
  `password` text NOT NULL,
  `authToken` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vol_admin`
--

INSERT INTO `vol_admin` (`id`, `password`, `authToken`, `email`, `fullname`) VALUES
(1, '$2y$10$rKxdNa0Ow958HnNMQJTWtepWdvqMcVyy0Eq9uGhc2gSr1tdsrJhV6', 'jfhakhbaUGVDGAdvjdvfuavdjfgakdfvudyfgvueyweuyvfyvauvdfuagvkdufhvakdf', 'admin@admin.com', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vol_admin`
--
ALTER TABLE `vol_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vol_admin`
--
ALTER TABLE `vol_admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
