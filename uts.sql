-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2020 at 06:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `teks_comment` varchar(200) DEFAULT NULL,
  `id_timeline` int(3) DEFAULT NULL,
  `id_profile` int(3) DEFAULT NULL,
  `time_posted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `teks_comment`, `id_timeline`, `id_profile`, `time_posted`) VALUES
(1, 'wah liburan kemana tuh', 1, 1, '2020-03-21 18:18:56'),
(2, 'asd', 16, 2, '2020-03-21 20:00:01'),
(3, 'sddd', 16, 3, '2020-03-23 15:26:06'),
(4, 'asddd', 16, 3, '2020-03-23 15:28:41'),
(6, 'maap', 16, 6, '2020-03-23 18:05:38'),
(9, 'knp', 16, 6, '2020-03-23 18:06:02'),
(12, 'yup', 16, 6, '2020-03-23 18:15:51'),
(13, 'masa', 14, 6, '2020-03-23 18:15:57'),
(15, 'apa', 16, 7, '2020-03-24 21:15:42'),
(16, 'ga', 15, 8, '2020-03-26 09:21:44'),
(17, 'nah, im', 17, 8, '2020-03-26 11:05:17'),
(18, 'yes', 18, 8, '2020-03-26 13:12:09'),
(19, 'ha', 18, 8, '2020-03-26 13:24:33'),
(20, 'qwe', 15, 8, '2020-03-26 13:38:44'),
(21, 'ikut', 1, 8, '2020-03-26 13:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id_profile` int(11) NOT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `website` varchar(30) DEFAULT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `date_joined` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `id_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id_profile`, `first_name`, `last_name`, `username`, `password`, `location`, `website`, `bio`, `birthdate`, `date_joined`, `gender`, `id_image`) VALUES
(1, 'Jordy', 'Van Bastian', 'JordyVB', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, '1999-08-27', '2020-03-19', 'm', ''),
(2, 'Yuan', 'aja', 'asd', '4f5ad910d7a80de71bfad3e43757be77', 'Bali, Indonesia', 'www.youtube.com', 'Saya Senang Main ps4', '2020-03-03', '2020-03-19', 'm', ''),
(3, 'Jokide', 'jukide', 'jukide', '8cc7ae3e3e8b8963c9108aeff96b22da', NULL, NULL, NULL, '2019-11-06', '2020-03-23', 'm', NULL),
(5, 'abc', 'abc', 'abc', '104ae987f3e0252ca8a8c9c431f3a6a2', NULL, NULL, NULL, '2020-03-03', '2020-03-23', 'm', NULL),
(6, 'Jay', 'Z', 'z', 'b03620d0b95de5abdb7feb2037ccc6bb', 'Jakarta', 'umn.ac.id', 'zz', '2020-03-03', '2020-03-23', 'm', ''),
(7, 'Kendrick', 'Lamar', 'best', 'f5e93aa40305c2babddcf904396d9cd7', 'Bali, Indonesia', 'google.com', 'Thanks God.', '2020-03-04', '2020-03-24', 'm', ''),
(8, 'Jermaine', 'Cole', 'JCole', '96f07a4cbff9e8806f113afe2b296860', 'New York, USA', 'cole.com', '4 Your Eyez Only', '2020-03-27', '2020-03-24', 'm', '27374618-headphones-sketch.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `timelines`
--

CREATE TABLE `timelines` (
  `id_timeline` int(11) NOT NULL,
  `teks_timeline` varchar(200) DEFAULT NULL,
  `id_profile` int(3) DEFAULT NULL,
  `time_posted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timelines`
--

INSERT INTO `timelines` (`id_timeline`, `teks_timeline`, `id_profile`, `time_posted`) VALUES
(1, 'Seru juga libur', 2, '2020-03-19 18:24:33'),
(2, 'takehome seru juga', 1, '2020-03-19 18:24:35'),
(3, 'test dulu aja', 2, '2020-03-19 21:58:47'),
(14, 'Kuliah Online', 2, '2020-03-19 22:43:07'),
(15, 'Liburan Murah nih', 2, '2020-03-19 22:44:22'),
(16, 'test aja kali', 2, '2020-03-19 23:01:11'),
(17, 'im a god', 7, '2020-03-24 21:15:53'),
(18, 'k', 8, '2020-03-26 13:11:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_timeline` (`id_timeline`),
  ADD KEY `id_profile` (`id_profile`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id_profile`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `website` (`website`);

--
-- Indexes for table `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`id_timeline`),
  ADD KEY `id_profile` (`id_profile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `timelines`
--
ALTER TABLE `timelines`
  MODIFY `id_timeline` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_timeline`) REFERENCES `timelines` (`id_timeline`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_profile`) REFERENCES `profiles` (`id_profile`);

--
-- Constraints for table `timelines`
--
ALTER TABLE `timelines`
  ADD CONSTRAINT `timelines_ibfk_1` FOREIGN KEY (`id_profile`) REFERENCES `profiles` (`id_profile`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
