-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2019 at 01:14 AM
-- Server version: 10.3.12-MariaDB-log
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cahine_cs489`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `set_cookie` text DEFAULT NULL,
  `register_at` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `firstname`, `phone`, `set_cookie`, `register_at`, `created_at`) VALUES
(7, 'Mobilusis', '', 'mobilusis', '22:45:00', '2019-02-17 20:45:00'),
(10, 'Pardon', '', 'pardon', '23:00:00', '2019-02-17 21:00:00'),
(13, 'Mantas', '', 'mantas', '23:15:00', '2019-02-17 21:15:00'),
(15, 'Civiliokas', '', NULL, '10:15:00', '2019-02-18 08:15:00'),
(56, 'Jolanda', '865800000', NULL, '13:45:00', '2019-02-21 11:45:00'),
(17, 'Tepliones', '', NULL, '11:00:00', '2019-02-19 09:00:00'),
(19, 'Omnitelis', '', 'omnitelis', '10:00:00', '2019-02-18 08:00:00'),
(20, 'Kopralas', '', 'kopralas', '12:45:00', '2019-02-18 10:45:00'),
(21, 'Lobis', '865899836', 'lobis', '18:30:00', '2019-02-18 16:30:00'),
(22, 'Laura', '863137292', 'laura', '16:15:00', '2019-02-18 14:15:00'),
(23, 'SnieguraÄka', '863137292', NULL, '13:00:00', '2019-02-21 11:00:00'),
(55, 'Jupiteris', '865800000', NULL, '12:30:00', '2019-02-27 10:30:00'),
(25, 'Mantas', '', 'mantas', '19:00:00', '2019-02-19 17:00:00'),
(26, 'Laura', '865800000', NULL, '11:15:00', '2019-02-19 09:15:00'),
(27, 'Olegas', '865800000', NULL, '11:45:00', '2019-02-19 09:45:00'),
(28, 'SaulÄ—', '865800000', NULL, '18:15:00', '2019-02-19 16:15:00'),
(29, 'Erikas', '865899836', NULL, '10:00:00', '2019-02-20 08:00:00'),
(30, 'Natalija', '865899836', NULL, '10:15:00', '2019-02-20 08:15:00'),
(31, 'Oliveris', '865899836', NULL, '10:30:00', '2019-02-20 08:30:00'),
(32, 'ArtÅ«ras', '865899836', NULL, '10:45:00', '2019-02-20 08:45:00'),
(33, 'Aruodas', '865899836', NULL, '11:00:00', '2019-02-20 09:00:00'),
(34, 'SkirmantÄ—', '865800000', NULL, '11:15:00', '2019-02-20 09:15:00'),
(35, 'Skirmantas', '865800000', NULL, '11:30:00', '2019-02-20 09:30:00'),
(36, 'JokÅ«bas', '865800000', NULL, '11:45:00', '2019-02-20 09:45:00'),
(37, 'ArÅ«nÄ—', '865800000', NULL, '12:00:00', '2019-02-20 10:00:00'),
(38, 'Ernestas', '865800000', NULL, '14:00:00', '2019-02-20 12:00:00'),
(39, 'Eligijus', '865800000', NULL, '14:15:00', '2019-02-20 12:15:00'),
(40, 'Osvaldas', '865800000', NULL, '14:30:00', '2019-02-20 12:30:00'),
(41, 'JÅ«rga', '865800000', NULL, '14:45:00', '2019-02-20 12:45:00'),
(42, 'Paulius', '865800000', NULL, '18:15:00', '2019-02-20 16:15:00'),
(43, 'Ernestas', '865800000', NULL, '14:15:00', '2019-02-28 12:15:00'),
(44, 'Ovidijus', '865800000', NULL, '11:30:00', '2019-02-23 09:30:00'),
(45, 'Zigmas', '865800000', NULL, '11:30:00', '2019-02-21 09:30:00'),
(46, 'ArtÅ«ras', '865800000', NULL, '10:00:00', '2019-02-21 08:00:00'),
(47, 'Lina', '865800000', NULL, '12:15:00', '2019-02-21 10:15:00'),
(48, 'Augustas', '865800000', NULL, '13:00:00', '2019-02-23 11:00:00'),
(49, 'JarÅ«nÄ—', '865800000', NULL, '13:30:00', '2019-02-22 11:30:00'),
(50, 'Kristina', '865800000', NULL, '12:45:00', '2019-02-28 10:45:00'),
(51, 'Natalija', '865800000', NULL, '13:30:00', '2019-02-28 11:30:00'),
(52, 'IndrÄ—', '865800000', NULL, '12:00:00', '2019-03-04 10:00:00'),
(53, 'Mindaugas', '865800000', NULL, '10:15:00', '2019-03-01 08:15:00'),
(54, 'Oksana', '865800000', NULL, '12:30:00', '2019-02-28 10:30:00'),
(57, 'Eugenijus', '865800000', NULL, '13:15:00', '2019-02-28 11:15:00'),
(58, 'Tomas', '865800000', NULL, '11:30:00', '2019-02-27 09:30:00'),
(59, 'Å½ygimantas', '865800000', NULL, '13:00:00', '2019-02-24 11:00:00'),
(60, 'Arnoldas', '865800000', NULL, '13:30:00', '2019-03-05 11:30:00'),
(61, 'Laurita', '865800000', NULL, '12:45:00', '2019-02-24 10:45:00'),
(62, 'Saulius', '865800000', NULL, '14:00:00', '2019-02-25 12:00:00'),
(63, 'Euforija', '865800000', NULL, '12:30:00', '2019-02-24 10:30:00'),
(64, 'RimantÄ—', '865800000', NULL, '13:15:00', '2019-02-20 11:15:00'),
(65, 'Domas', '865800000', NULL, '13:30:00', '2019-02-23 11:30:00'),
(66, 'Stasys', '865800000', NULL, '13:30:00', '2019-02-24 11:30:00'),
(67, 'Sandra', '865800000', NULL, '13:00:00', '2019-02-28 11:00:00'),
(68, 'Ieva', '865800000', NULL, '12:15:00', '2019-02-28 10:15:00'),
(69, 'Likarija', '865800000', NULL, '12:45:00', '2019-02-23 10:45:00'),
(70, 'Izraelita', '865800000', NULL, '10:45:00', '2019-02-24 08:45:00'),
(71, 'Stefanija', '865800000', NULL, '14:00:00', '2019-02-28 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `created_at`) VALUES
(1, 'Laura', 'VGVzdGFz', '2019-02-18 01:20:24'),
(2, 'Mantas', 'ZGVtbw==', '2019-02-18 01:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `visited_customers`
--

CREATE TABLE `visited_customers` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `visited` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visited_customers`
--

INSERT INTO `visited_customers` (`id`, `firstname`, `visited`, `created_at`) VALUES
(1, 'mantas', 7, '2019-02-14 22:40:00'),
(2, 'algirdas', 1, '2019-02-14 22:40:00'),
(3, 'laura', 1, '2019-02-14 22:40:00'),
(42, 'erikas', 1, '2019-02-18 22:53:00'),
(5, 'snaigutä—', 5, '2019-02-16 15:19:00'),
(6, 'snaigulis', 2, '2019-02-16 15:24:00'),
(7, 'martis', 1, '2019-02-16 15:39:00'),
(44, 'oliveris', 1, '2019-02-18 22:53:00'),
(9, 'snaigutis', 0, '2019-02-16 16:24:00'),
(10, 'mancius', 2, '2019-02-17 00:05:00'),
(43, 'natalija', 2, '2019-02-18 22:53:00'),
(14, 'mantins', 1, '2019-02-17 15:42:00'),
(15, 'mantuks', 2, '2019-02-17 15:44:00'),
(16, 'bamper', 1, '2019-02-17 16:07:00'),
(17, 'tupcik', 1, '2019-02-17 16:11:00'),
(18, 'geras', 1, '2019-02-17 16:12:00'),
(19, 'mantiz', 1, '2019-02-17 16:14:00'),
(20, 'maybach', 1, '2019-02-17 16:15:00'),
(21, 'gipsas', 1, '2019-02-17 16:21:00'),
(46, 'aruodas', 1, '2019-02-18 22:54:00'),
(23, 'mantosas', 1, '2019-02-17 16:31:00'),
(24, 'opcija', 0, '2019-02-17 20:09:00'),
(45, 'artÅ«ras', 2, '2019-02-18 22:54:00'),
(26, 'kopecios', 0, '2019-02-17 20:45:00'),
(27, 'peckorys', 0, '2019-02-17 20:46:00'),
(28, 'pardon', 1, '2019-02-17 20:51:00'),
(29, 'mob kuop', 0, '2019-02-17 21:01:00'),
(30, 'grybelis', 0, '2019-02-17 21:06:00'),
(31, 'trepsys', 1, '2019-02-17 22:51:00'),
(32, 'civiliokas', 1, '2019-02-17 22:52:00'),
(33, 'traktuojamas', 1, '2019-02-18 00:08:00'),
(34, 'tepliones', 1, '2019-02-18 00:23:00'),
(35, 'omnitelis', 1, '2019-02-18 00:36:00'),
(36, 'kopralas', 1, '2019-02-18 10:39:00'),
(37, 'lobis', 1, '2019-02-18 12:32:00'),
(38, 'snieguraÄka', 1, '2019-02-18 12:45:00'),
(39, 'mantasez', 1, '2019-02-18 12:46:00'),
(40, 'olegas', 1, '2019-02-18 22:50:00'),
(41, 'saulÄ—', 1, '2019-02-18 22:51:00'),
(47, 'skirmantÄ—', 1, '2019-02-18 22:55:00'),
(48, 'skirmantas', 1, '2019-02-18 22:55:00'),
(49, 'jokÅ«bas', 1, '2019-02-18 22:55:00'),
(50, 'arÅ«nÄ—', 1, '2019-02-18 22:55:00'),
(51, 'ernestas', 2, '2019-02-18 22:56:00'),
(52, 'eligijus', 1, '2019-02-18 22:56:00'),
(53, 'osvaldas', 1, '2019-02-18 22:57:00'),
(54, 'jÅ«rga', 1, '2019-02-18 22:57:00'),
(55, 'paulius', 1, '2019-02-18 22:58:00'),
(56, 'ovidijus', 1, '2019-02-18 22:58:00'),
(57, 'zigmas', 1, '2019-02-18 22:59:00'),
(58, 'lina', 1, '2019-02-18 23:00:00'),
(59, 'augustas', 1, '2019-02-18 23:00:00'),
(60, 'jarÅ«nÄ—', 1, '2019-02-18 23:00:00'),
(61, 'kristina', 1, '2019-02-18 23:01:00'),
(62, 'indrÄ—', 1, '2019-02-18 23:01:00'),
(63, 'mindaugas', 1, '2019-02-18 23:01:00'),
(64, 'oksana', 1, '2019-02-18 23:02:00'),
(65, 'jupiteris', 1, '2019-02-18 23:08:00'),
(66, 'jolanda', 1, '2019-02-18 23:08:00'),
(67, 'eugenijus', 1, '2019-02-18 23:08:00'),
(68, 'tomas', 1, '2019-02-18 23:09:00'),
(69, 'Å½ygimantas', 1, '2019-02-18 23:09:00'),
(70, 'arnoldas', 1, '2019-02-18 23:09:00'),
(71, 'laurita', 1, '2019-02-18 23:09:00'),
(72, 'saulius', 1, '2019-02-18 23:10:00'),
(73, 'euforija', 1, '2019-02-18 23:10:00'),
(74, 'rimantÄ—', 1, '2019-02-18 23:10:00'),
(75, 'domas', 1, '2019-02-18 23:10:00'),
(76, 'stasys', 1, '2019-02-18 23:10:00'),
(77, 'sandra', 1, '2019-02-18 23:11:00'),
(78, 'ieva', 1, '2019-02-18 23:11:00'),
(79, 'likarija', 1, '2019-02-18 23:11:00'),
(80, 'izraelita', 1, '2019-02-18 23:11:00'),
(81, 'stefanija', 1, '2019-02-18 23:12:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visited_customers`
--
ALTER TABLE `visited_customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visited_customers`
--
ALTER TABLE `visited_customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
