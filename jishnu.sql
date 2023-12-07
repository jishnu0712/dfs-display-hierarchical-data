-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2023 at 05:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jishnu`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Id` int(11) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `ParentId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Id`, `CreatedDate`, `Name`, `ParentId`) VALUES
(1, '2023-12-06 21:02:44', 'Jishnu', 1),
(5, NULL, 'Kapil', 1),
(6, NULL, 'ddd', 1),
(7, NULL, 'gg', 5),
(8, NULL, 'fff', 7),
(9, NULL, 'rrrr', 8),
(10, NULL, 'eeee', 7),
(11, NULL, 'ccccc', 6),
(12, '2023-12-07 00:00:00', 'Indranil', 1),
(13, '2023-12-07 04:48:48', 'prakash', 12),
(14, '2023-12-07 04:51:12', 'lll', 6),
(15, '2023-12-07 04:54:22', 'Raju', 13),
(16, '2023-12-07 04:55:31', 'Rajesh', 1),
(17, '2023-12-07 04:58:56', 'Rakesh', 16),
(18, '2023-12-07 05:00:19', 'zzzz', 6),
(19, '2023-12-07 05:05:08', 'Sharma', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ParentId` (`ParentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`ParentId`) REFERENCES `members` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
