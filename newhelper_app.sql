-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 07:41 PM
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
  `fullname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`email`, `id`, `password`, `isAdmin`, `authToken`, `fullname`) VALUES
('savy@gmail.com', 8, '$2y$10$d55UfbYnx5ATLA0v2bfi4OM5uAOQjiZxV0BQvvSPo5xudSvTeGa0K', NULL, '6104297347c8c0b8a06080a75f691a8068c280564a69d194d867dbf0dba0c3e41a7ad9874632b4c9c59a7011334b9926a70f', 'Savy'),
('Holla@gmail.com', 10, '$2y$10$9OllomUjat09VQJ/fKPHTOuF21V.TPcKUbiF3Tg3VNLi/NmoTV.YW', NULL, '604c9c20d436881f20e8fc5c3e3f87e9bbe02c185c5f34e06ec619de6d8a2c20dc29b8777f713bce2b65bb78d04c4f638039', 'stephan Olayemi');

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
(1, '$2y$10$d55UfbYnx5ATLA0v2bfi4OM5uAOQjiZxV0BQvvSPo5xudSvTeGa0K', 'jhndisuh9ie899423u8hr9823u9r39h27f394ur39487r394ufbuo34f', 'admin@admin.com', 'Admin'),
(2, '$2y$10$L5AUd7ph70Ky8aHtlc6lUehKopJyekZc1y.H.LquNn6pxB6We3HBy', 'da9f0a2cbd436e000639968253d937d7ee709da9a750d7d6365a1a989ba5feff1427721449b30256065c1387645368b677e1', 'Holla@gmail.com', 'Hollayemi'),
(3, '$2y$10$P1NoD/GdX4NaLzcyUZvqPuCrA4GbMYtjVA3BchxIsSMFCdUayIuWu', 'b27205e4bd12dc212f08be543bdc7e6fc618e998a6c65b2ac5bddf11150bbffd05ba866ca19b25fad9c8b3114e89e13c9d7a', 'Holla2@gmail.com', 'Hollayemi');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vol_admin`
--
ALTER TABLE `vol_admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
