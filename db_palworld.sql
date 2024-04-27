-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 04:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_palworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(0, 'Neutral'),
(1, 'Dark'),
(2, 'Dragon'),
(3, 'Ice'),
(4, 'Fire'),
(5, 'Water'),
(6, 'Electric'),
(7, 'Ground'),
(8, 'Grass');

--
-- Triggers `type`
--
DELIMITER $$
CREATE TRIGGER `delete_type` AFTER DELETE ON `type` FOR EACH ROW BEGIN
    DELETE FROM pal WHERE type_id = OLD.type_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `habitat`
--

CREATE TABLE `habitat` (
  `habitat_id` int(11) NOT NULL,
  `habitat_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `habitat`
--

INSERT INTO `habitat` (`habitat_id`, `habitat_name`) VALUES
(0, 'Plain'),
(1, 'Dessert'),
(2, 'Volcano'),
(3, 'Iceland');

--
-- Triggers `habitat`
--
DELIMITER $$
CREATE TRIGGER `delete_habitat` AFTER DELETE ON `habitat` FOR EACH ROW BEGIN
    DELETE FROM pal WHERE habitat_id = OLD.habitat_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pal`
--

CREATE TABLE `pal` (
  `pal_id` int(11) NOT NULL,
  `pal_photo` varchar(255) DEFAULT NULL,
  `pal_level` int(1) DEFAULT NULL,
  `pal_name` varchar(100) DEFAULT NULL,
  `pal_ep` int(3) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `habitat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pal`
--

INSERT INTO `pal` (`pal_id`, `pal_photo`, `pal_level`, `pal_name`, `pal_ep`, `type_id`, `habitat_id`) VALUES
(0, 'rdr2.jpg', 1, 'Chikipi', 5, 0, 0),
(1, 'skyrim-logo.jpg', 3, 'Lamball', 8, 0, 0),
(2, 'zelda.png', 4, 'Cattiva', 10, 0, 0),
(3, 'gta5.jpeg', 2, 'Lifmunk', 6, 8, 0),
(4, 'ac.jpg', 6, 'Vixy', 12, 6, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`habitat_id`);

--
-- Indexes for table `pal`
--
ALTER TABLE `pal`
  ADD PRIMARY KEY (`pal_id`),
  ADD KEY `fk_jabatan` (`type_id`),
  ADD KEY `fk_divisi` (`habitat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `habitat`
--
ALTER TABLE `habitat`
  MODIFY `habitat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pal`
--
ALTER TABLE `pal`
  MODIFY `pal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pal`
--
ALTER TABLE `pal`
  ADD CONSTRAINT `fk_jabatan` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`),
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`habitat_id`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
