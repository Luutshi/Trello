-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 01, 2022 at 02:40 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trello`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `createdAt`, `updatedAt`) VALUES
(1, 'Coucou Alexandre :)', '2022-06-01 16:03:29', '2022-06-01 16:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `tasks_steps`
--

CREATE TABLE `tasks_steps` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks_steps`
--

INSERT INTO `tasks_steps` (`id`, `task_id`, `name`, `createdAt`, `updatedAt`) VALUES
(238, 1, 'Et bien, voici mon rendu !', '2022-06-01 16:03:35', '2022-06-01 16:03:42'),
(239, 1, 'Ici, on peut créer des tâches avec toutes les étapes de ces tâches!', '2022-06-01 16:03:42', '2022-06-01 16:04:01'),
(240, 1, 'Chaque rectangle blanc peut donc être :', '2022-06-01 16:04:02', '2022-06-01 16:04:18'),
(241, 1, 'Crée, supprimé, édité.', '2022-06-01 16:04:19', '2022-06-01 16:04:28'),
(242, 1, 'Amuses-toi bien :)', '2022-06-01 16:04:30', '2022-06-01 16:04:38'),
(243, 1, '(mets moi 24/20 s\'il te plaît)', '2022-06-01 16:04:39', '2022-06-01 16:04:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks_steps`
--
ALTER TABLE `tasks_steps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks_steps`
--
ALTER TABLE `tasks_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
