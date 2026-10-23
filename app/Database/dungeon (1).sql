-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2026 at 11:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dungeon`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `character-id` int(11) NOT NULL,
  `character-name` varchar(100) NOT NULL,
  `character-class` varchar(20) NOT NULL,
  `character-level` int(11) NOT NULL,
  `character-xp` int(11) NOT NULL,
  `character-hp` int(11) NOT NULL,
  `character-mp` int(11) NOT NULL,
  `character-atk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`character-id`, `character-name`, `character-class`, `character-level`, `character-xp`, `character-hp`, `character-mp`, `character-atk`) VALUES
(16, 'Hero', 'Warrior', 1, 0, 150, 10, 15),
(17, 'Hero', 'Warrior', 1, 0, 150, 10, 15),
(18, 'Annie', 'Mage', 1, 0, 80, 100, 8),
(19, 'Hero', 'Warrior', 1, 0, 150, 10, 15),
(20, 'Hero', 'Warrior', 1, 0, 150, 10, 15),
(21, 'Hero', 'Warrior', 1, 0, 150, 10, 15),
(22, 'Annie', 'Mage', 1, 0, 80, 100, 8),
(23, 'Annie', 'Mage', 1, 0, 80, 100, 8),
(24, 'Annie', 'Mage', 1, 0, 80, 100, 8),
(25, 'Annie', 'Mage', 1, 0, 80, 100, 8);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2026-10-23-053138', 'App\\Database\\Migrations\\CreateCharactersTable', 'default', 'App', 1792734403, 2),
(3, '2026-10-21-000001', 'App\\Database\\Migrations\\CreateMonstersTable', 'default', 'App', 1792737321, 3);

-- --------------------------------------------------------

--
-- Table structure for table `monsters`
--

CREATE TABLE `monsters` (
  `monster-id` int(10) UNSIGNED NOT NULL,
  `monster-name` varchar(100) NOT NULL,
  `monster-hp` int(10) UNSIGNED NOT NULL,
  `monster-atk` int(10) UNSIGNED NOT NULL,
  `monster-mp` int(10) UNSIGNED NOT NULL,
  `monster-level` int(10) UNSIGNED NOT NULL,
  `monster-xp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monsters`
--

INSERT INTO `monsters` (`monster-id`, `monster-name`, `monster-hp`, `monster-atk`, `monster-mp`, `monster-level`, `monster-xp`) VALUES
(1, 'Slime', 30, 5, 0, 1, 10),
(2, 'Skeleton', 50, 10, 0, 2, 25),
(3, 'Goblin', 40, 8, 0, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user-id` int(10) NOT NULL,
  `user-name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`character-id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monsters`
--
ALTER TABLE `monsters`
  ADD PRIMARY KEY (`monster-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `character-id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `monsters`
--
ALTER TABLE `monsters`
  MODIFY `monster-id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
