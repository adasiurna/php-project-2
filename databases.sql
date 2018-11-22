-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2017 at 05:09 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db8`
--

-- --------------------------------------------------------

--
-- Table structure for table `darbuotojai`
--
DROP TABLE IF EXISTS darbuotojai;
CREATE TABLE `darbuotojai` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_general_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8_general_ci NOT NULL,
  `gender` enum('vyras','moteris','','') COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE utf8_general_ci DEFAULT NULL,
  `birthday` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `education` varchar(120) COLLATE utf8_general_ci DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `idarbinimo_tipas` tinyint(4) DEFAULT NULL,
  `pareigos_id` int(11) DEFAULT NULL,
  `projekto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `darbuotojai`
--

INSERT INTO `darbuotojai` (`id`, `name`, `surname`, `gender`, `phone`, `birthday`, `education`, `salary`, `idarbinimo_tipas`, `pareigos_id`, `projekto_id`) VALUES
(39, 'Jonas', 'Jonaitis', 'vyras', '51122', '2017-09-14 14:37:09', 'Aukštasis', 880, 1, 1, 1),
(41, 'Petraitis', 'Petraitis', 'vyras', '51122', '2017-09-19 15:33:46', 'Zemasis', 120, 2, 4, 1),
(42, 'Adolfas ', 'Ramanauskas', 'vyras', '+370212467', '2017-09-06 13:44:06', 'Taip', 408, 1, 1, 1),
(43, 'Antanas ', 'Žemaitis', 'vyras', '+37016666666', '2017-09-06 13:44:17', 'Aukštasis', 1102, 1, 1, 2),
(45, 'Juozas ', 'Vitkus', 'vyras', '66', '2017-09-20 15:10:32', 'Taip', 700, 1, 1, 2),
(46, 'Jonas ', 'Misiūnas', 'vyras', '66', '2017-09-06 13:44:25', 'Taip', 2000, 1, 1, 2),
(47, 'Justinas ', 'Lelešius', 'vyras', '66', '2017-09-06 13:42:56', 'Taip', 1102, 1, 1, 3),
(48, 'Lionginas ', 'Baliukevičius', 'vyras', '66', '2017-09-06 13:44:34', 'Taip', 250, 1, 1, 3),
(50, 'Kazys', 'Petraitis', NULL, NULL, '2017-09-20 15:25:40', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pareigos`
--
DROP TABLE IF EXISTS pareigos;
CREATE TABLE `pareigos` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  `base_salary`int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pareigos`
--

INSERT INTO `pareigos` (`id`, `name`, `base_salary`) VALUES
(1, 'Koderis', 700),
(4, 'Valytojas', 5000);







--
-- Table structure for table `projektai`
--
DROP TABLE IF EXISTS projektai;
CREATE TABLE `projektai` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  `year` varchar(4) NOT NULL,
  `income` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pareigos`
--

INSERT INTO `projektai` (`id`, `name`, `year`, `income`) VALUES
(1, 'INTF', 2008, 50000),
(2, 'SAMBO', 2012, 980050),
(3, 'Green Earth', 2014, 150000),
(4, 'BENQO', 2014, 670500);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `darbuotojai`
--
ALTER TABLE `darbuotojai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pareigos_id` (`pareigos_id`),
  ADD KEY `projekto_id` (`projekto_id`);

--
-- Indexes for table `pareigos`
--
ALTER TABLE `pareigos` ADD PRIMARY KEY (`id`);

ALTER TABLE `projektai` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `darbuotojai`
--
ALTER TABLE `darbuotojai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `pareigos`
--
ALTER TABLE `pareigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `projektai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `darbuotojai`
--
ALTER TABLE `darbuotojai`
  ADD CONSTRAINT `darbuotojai_ibfk_1` FOREIGN KEY (`pareigos_id`) REFERENCES `pareigos` (`id`);

ALTER TABLE `darbuotojai`
  ADD CONSTRAINT `darbuotojai_ibfk_1` FOREIGN KEY (`projekto_id`) REFERENCES `projektai` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


select * from darbuotojai;
select * from pareigos;
select * from projektai;
