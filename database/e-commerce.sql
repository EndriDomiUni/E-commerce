-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 12, 2023 alle 23:07
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--
CREATE DATABASE IF NOT EXISTS `e-commerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `e-commerce`;

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Articolo`;
CREATE TABLE IF NOT EXISTS `Articolo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Prezzo` varchar(100) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Prodotto_id` (`Prodotto_id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Articolo`
--

INSERT INTO `Articolo` (`Id`, `Prezzo`, `Utente_id`, `Prodotto_id`, `Status`, `Timestamp`) VALUES
(1, '0', 5, 1, 0, '2023-02-04 10:00:34');

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo_in_carrello`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Articolo_in_carrello`;
CREATE TABLE IF NOT EXISTS `Articolo_in_carrello` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Quantità` int(11) NOT NULL,
  `Carrello_id` int(11) NOT NULL,
  `Articolo_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Carrello_id` (`Carrello_id`),
  KEY `Articolo_id` (`Articolo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Articolo_in_carrello`
--

INSERT INTO `Articolo_in_carrello` (`Id`, `Quantità`, `Carrello_id`, `Articolo_id`, `Status`, `Timestamp`) VALUES
(1, 0, 1, 1, 0, '2023-02-05 10:19:58'),
(2, 1, 175, 1, 0, '2023-02-05 16:13:59'),
(3, 1, 176, 1, 0, '2023-02-06 15:01:01');

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo_in_magazzino`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Articolo_in_magazzino`;
CREATE TABLE IF NOT EXISTS `Articolo_in_magazzino` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tassa` decimal(10,0) NOT NULL,
  `Data_inizio` date NOT NULL,
  `Data_fine` date NOT NULL,
  `Articolo_id` int(11) NOT NULL,
  `Magazzino_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Articolo_id` (`Articolo_id`),
  KEY `Magazzino_id` (`Magazzino_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Carrello`
--
-- Creazione: Feb 12, 2023 alle 21:55
-- Ultimo aggiornamento: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Carrello`;
CREATE TABLE IF NOT EXISTS `Carrello` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Utente_id` int(11) NOT NULL,
  `Status` int(4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=465 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Carrello`
--

INSERT INTO `Carrello` (`Id`, `Utente_id`, `Status`, `Timestamp`) VALUES
(1, 4, 0, '2023-02-02 09:35:40'),
(2, 4, 0, '2023-02-02 09:36:53'),
(3, 4, 0, '2023-02-02 09:36:53'),
(4, 4, 0, '2023-02-02 09:36:53'),
(5, 4, 0, '2023-02-02 09:36:53'),
(6, 4, 0, '2023-02-02 09:36:53'),
(7, 4, 0, '2023-02-02 09:36:53'),
(8, 4, 0, '2023-02-02 09:36:53'),
(9, 4, 0, '2023-02-02 09:36:53'),
(10, 4, 0, '2023-02-02 09:36:53'),
(11, 4, 0, '2023-02-02 09:36:53'),
(12, 4, 0, '2023-02-02 09:36:53'),
(13, 4, 0, '2023-02-02 09:36:53'),
(14, 4, 0, '2023-02-02 09:36:53'),
(15, 4, 0, '2023-02-02 09:36:53'),
(16, 4, 0, '2023-02-02 09:36:53'),
(17, 4, 0, '2023-02-02 09:36:53'),
(18, 4, 0, '2023-02-02 09:36:53'),
(19, 4, 0, '2023-02-02 09:36:53'),
(20, 4, 0, '2023-02-02 09:36:53'),
(21, 4, 0, '2023-02-02 09:36:53'),
(22, 4, 0, '2023-02-02 09:36:53'),
(23, 4, 0, '2023-02-02 09:36:53'),
(24, 4, 0, '2023-02-02 09:36:53'),
(25, 4, 0, '2023-02-02 09:36:53'),
(26, 4, 0, '2023-02-02 09:36:53'),
(27, 4, 0, '2023-02-02 09:36:53'),
(28, 4, 0, '2023-02-02 09:36:53'),
(29, 4, 0, '2023-02-02 09:36:53'),
(30, 4, 0, '2023-02-02 09:36:53'),
(31, 4, 0, '2023-02-02 09:36:53'),
(32, 4, 0, '2023-02-02 09:36:53'),
(33, 4, 0, '2023-02-02 09:36:53'),
(34, 4, 0, '2023-02-02 09:36:53'),
(35, 4, 0, '2023-02-02 09:36:53'),
(36, 4, 0, '2023-02-02 09:36:53'),
(37, 4, 0, '2023-02-02 09:36:53'),
(38, 4, 0, '2023-02-02 09:36:53'),
(39, 4, 0, '2023-02-02 09:36:53'),
(40, 4, 0, '2023-02-02 09:36:53'),
(41, 4, 0, '2023-02-02 09:36:53'),
(42, 4, 0, '2023-02-02 09:36:53'),
(43, 4, 0, '2023-02-02 09:36:53'),
(44, 4, 0, '2023-02-02 09:36:53'),
(45, 4, 0, '2023-02-02 09:36:53'),
(46, 4, 0, '2023-02-02 09:36:53'),
(47, 4, 0, '2023-02-02 09:36:53'),
(48, 4, 0, '2023-02-02 09:36:53'),
(49, 4, 0, '2023-02-02 09:36:53'),
(50, 4, 0, '2023-02-02 09:36:53'),
(51, 4, 0, '2023-02-02 09:36:53'),
(52, 4, 0, '2023-02-02 09:36:53'),
(53, 4, 0, '2023-02-02 09:36:53'),
(54, 4, 0, '2023-02-02 09:36:53'),
(55, 4, 0, '2023-02-02 09:36:53'),
(56, 4, 0, '2023-02-02 09:36:53'),
(57, 4, 0, '2023-02-02 09:36:53'),
(58, 4, 0, '2023-02-02 09:36:53'),
(59, 4, 0, '2023-02-02 09:36:53'),
(60, 4, 0, '2023-02-02 09:36:53'),
(61, 4, 0, '2023-02-02 09:36:53'),
(62, 4, 0, '2023-02-02 09:36:53'),
(63, 4, 0, '2023-02-02 09:36:53'),
(64, 4, 0, '2023-02-02 09:36:53'),
(65, 4, 0, '2023-02-02 09:36:53'),
(66, 4, 0, '2023-02-02 09:36:53'),
(67, 4, 0, '2023-02-02 09:36:53'),
(68, 4, 0, '2023-02-02 09:36:53'),
(69, 4, 0, '2023-02-02 09:36:53'),
(70, 4, 0, '2023-02-02 09:36:53'),
(71, 4, 0, '2023-02-02 09:36:53'),
(72, 4, 0, '2023-02-02 09:36:53'),
(73, 4, 0, '2023-02-02 09:36:53'),
(74, 4, 0, '2023-02-02 09:36:53'),
(75, 4, 0, '2023-02-02 09:36:53'),
(76, 4, 0, '2023-02-02 09:36:53'),
(77, 4, 0, '2023-02-02 09:36:53'),
(78, 12, 0, '2023-02-05 15:27:29'),
(79, 12, 0, '2023-02-05 15:27:29'),
(80, 12, 0, '2023-02-05 15:27:29'),
(81, 12, 0, '2023-02-05 15:27:29'),
(82, 12, 0, '2023-02-05 15:27:29'),
(83, 12, 0, '2023-02-05 15:27:29'),
(84, 14, 0, '2023-02-05 15:43:37'),
(85, 14, 0, '2023-02-05 15:43:37'),
(86, 14, 0, '2023-02-05 15:43:37'),
(87, 14, 0, '2023-02-05 15:43:37'),
(88, 14, 0, '2023-02-05 15:43:37'),
(89, 14, 0, '2023-02-05 15:43:37'),
(90, 14, 0, '2023-02-05 15:43:37'),
(91, 14, 0, '2023-02-05 15:43:37'),
(92, 14, 0, '2023-02-05 15:43:37'),
(93, 14, 0, '2023-02-05 15:43:37'),
(94, 14, 0, '2023-02-05 15:43:37'),
(95, 14, 0, '2023-02-05 15:43:37'),
(96, 14, 0, '2023-02-05 15:43:37'),
(97, 14, 0, '2023-02-05 15:44:45'),
(98, 14, 0, '2023-02-05 15:44:45'),
(99, 14, 0, '2023-02-05 15:44:45'),
(100, 14, 0, '2023-02-05 15:44:45'),
(101, 14, 0, '2023-02-05 15:44:45'),
(102, 14, 0, '2023-02-05 15:44:45'),
(103, 14, 0, '2023-02-05 15:45:02'),
(104, 14, 0, '2023-02-05 15:45:02'),
(105, 14, 0, '2023-02-05 15:45:02'),
(106, 14, 0, '2023-02-05 15:45:02'),
(107, 14, 0, '2023-02-05 15:45:02'),
(108, 14, 0, '2023-02-05 15:45:02'),
(109, 15, 0, '2023-02-05 15:50:47'),
(110, 4, 0, '2023-02-05 16:04:45'),
(111, 4, 0, '2023-02-05 16:04:45'),
(112, 4, 0, '2023-02-05 16:04:45'),
(113, 4, 0, '2023-02-05 16:04:45'),
(114, 4, 0, '2023-02-05 16:04:45'),
(115, 4, 0, '2023-02-05 16:04:45'),
(116, 4, 0, '2023-02-05 16:04:45'),
(117, 4, 0, '2023-02-05 16:04:45'),
(118, 4, 0, '2023-02-05 16:04:45'),
(119, 4, 0, '2023-02-05 16:05:17'),
(120, 4, 0, '2023-02-05 16:05:17'),
(121, 4, 0, '2023-02-05 16:05:17'),
(122, 4, 0, '2023-02-05 16:05:17'),
(123, 4, 0, '2023-02-05 16:05:17'),
(124, 4, 0, '2023-02-05 16:05:17'),
(125, 4, 0, '2023-02-05 16:05:17'),
(126, 4, 0, '2023-02-05 16:05:23'),
(127, 4, 0, '2023-02-05 16:05:23'),
(128, 4, 0, '2023-02-05 16:05:23'),
(129, 4, 0, '2023-02-05 16:05:23'),
(130, 4, 0, '2023-02-05 16:05:23'),
(131, 4, 0, '2023-02-05 16:05:23'),
(132, 4, 0, '2023-02-05 16:05:23'),
(133, 4, 0, '2023-02-05 16:06:11'),
(134, 4, 0, '2023-02-05 16:06:11'),
(135, 4, 0, '2023-02-05 16:06:11'),
(136, 4, 0, '2023-02-05 16:06:11'),
(137, 4, 0, '2023-02-05 16:06:11'),
(138, 4, 0, '2023-02-05 16:06:11'),
(139, 4, 0, '2023-02-05 16:06:11'),
(140, 4, 0, '2023-02-05 16:06:19'),
(141, 4, 0, '2023-02-05 16:06:19'),
(142, 4, 0, '2023-02-05 16:06:19'),
(143, 4, 0, '2023-02-05 16:06:19'),
(144, 4, 0, '2023-02-05 16:06:19'),
(145, 4, 0, '2023-02-05 16:06:19'),
(146, 4, 0, '2023-02-05 16:06:19'),
(147, 4, 0, '2023-02-05 16:07:36'),
(148, 4, 0, '2023-02-05 16:07:36'),
(149, 4, 0, '2023-02-05 16:07:36'),
(150, 4, 0, '2023-02-05 16:07:36'),
(151, 4, 0, '2023-02-05 16:07:36'),
(152, 4, 0, '2023-02-05 16:07:36'),
(153, 4, 0, '2023-02-05 16:07:36'),
(154, 4, 0, '2023-02-05 16:08:00'),
(155, 4, 0, '2023-02-05 16:08:00'),
(156, 4, 0, '2023-02-05 16:08:00'),
(157, 4, 0, '2023-02-05 16:08:00'),
(158, 4, 0, '2023-02-05 16:08:00'),
(159, 4, 0, '2023-02-05 16:08:00'),
(160, 4, 0, '2023-02-05 16:08:00'),
(161, 4, 0, '2023-02-05 16:10:02'),
(162, 4, 0, '2023-02-05 16:10:02'),
(163, 4, 0, '2023-02-05 16:10:02'),
(164, 4, 0, '2023-02-05 16:10:02'),
(165, 4, 0, '2023-02-05 16:10:02'),
(166, 4, 0, '2023-02-05 16:10:02'),
(167, 4, 0, '2023-02-05 16:10:02'),
(168, 4, 0, '2023-02-05 16:10:05'),
(169, 4, 0, '2023-02-05 16:10:05'),
(170, 4, 0, '2023-02-05 16:10:05'),
(171, 4, 0, '2023-02-05 16:10:05'),
(172, 4, 0, '2023-02-05 16:10:05'),
(173, 4, 0, '2023-02-05 16:10:05'),
(174, 4, 0, '2023-02-05 16:10:05'),
(175, 16, 0, '2023-02-05 16:10:23'),
(176, 17, 0, '2023-02-06 14:58:54'),
(177, 18, 0, '2023-02-09 18:14:48'),
(178, 5, 0, '2023-02-12 17:24:57'),
(179, 4, 0, '2023-02-12 18:01:55'),
(180, 4, 0, '2023-02-12 18:01:55'),
(181, 4, 0, '2023-02-12 18:01:55'),
(182, 4, 0, '2023-02-12 18:01:55'),
(183, 4, 0, '2023-02-12 18:01:55'),
(184, 4, 0, '2023-02-12 18:01:55'),
(185, 4, 0, '2023-02-12 18:01:55'),
(186, 4, 0, '2023-02-12 18:01:55'),
(187, 4, 0, '2023-02-12 18:01:55'),
(188, 4, 0, '2023-02-12 18:01:55'),
(189, 4, 0, '2023-02-12 18:01:55'),
(190, 4, 0, '2023-02-12 18:01:55'),
(191, 4, 0, '2023-02-12 18:01:55'),
(192, 4, 0, '2023-02-12 18:01:55'),
(193, 4, 0, '2023-02-12 18:01:55'),
(194, 4, 0, '2023-02-12 18:01:55'),
(195, 4, 0, '2023-02-12 18:01:55'),
(196, 4, 0, '2023-02-12 18:01:55'),
(197, 4, 0, '2023-02-12 18:01:55'),
(198, 4, 0, '2023-02-12 18:01:55'),
(199, 4, 0, '2023-02-12 18:01:55'),
(200, 4, 0, '2023-02-12 18:02:52'),
(201, 4, 0, '2023-02-12 18:02:52'),
(202, 4, 0, '2023-02-12 18:02:52'),
(203, 4, 0, '2023-02-12 18:02:52'),
(204, 4, 0, '2023-02-12 18:02:52'),
(205, 4, 0, '2023-02-12 18:02:52'),
(206, 4, 0, '2023-02-12 18:02:52'),
(207, 4, 0, '2023-02-12 18:02:52'),
(208, 4, 0, '2023-02-12 18:02:52'),
(209, 4, 0, '2023-02-12 18:02:52'),
(210, 4, 0, '2023-02-12 18:08:38'),
(211, 4, 0, '2023-02-12 18:08:38'),
(212, 4, 0, '2023-02-12 18:08:38'),
(213, 4, 0, '2023-02-12 18:08:38'),
(214, 4, 0, '2023-02-12 18:08:38'),
(215, 4, 0, '2023-02-12 18:08:38'),
(216, 4, 0, '2023-02-12 18:08:38'),
(217, 4, 0, '2023-02-12 18:08:38'),
(218, 4, 0, '2023-02-12 18:08:38'),
(219, 4, 0, '2023-02-12 18:08:38'),
(220, 4, 0, '2023-02-12 18:09:49'),
(221, 4, 0, '2023-02-12 18:09:49'),
(222, 4, 0, '2023-02-12 18:09:49'),
(223, 4, 0, '2023-02-12 18:09:49'),
(224, 4, 0, '2023-02-12 18:09:49'),
(225, 4, 0, '2023-02-12 18:09:49'),
(226, 4, 0, '2023-02-12 18:09:49'),
(227, 4, 0, '2023-02-12 18:09:49'),
(228, 4, 0, '2023-02-12 18:09:49'),
(229, 4, 0, '2023-02-12 18:09:49'),
(230, 4, 0, '2023-02-12 20:34:47'),
(231, 4, 0, '2023-02-12 20:34:47'),
(232, 4, 0, '2023-02-12 20:34:47'),
(233, 4, 0, '2023-02-12 20:34:47'),
(234, 4, 0, '2023-02-12 20:34:47'),
(235, 4, 0, '2023-02-12 20:34:47'),
(236, 4, 0, '2023-02-12 20:34:47'),
(237, 4, 0, '2023-02-12 20:34:47'),
(238, 4, 0, '2023-02-12 20:34:47'),
(239, 4, 0, '2023-02-12 20:34:47'),
(240, 4, 0, '2023-02-12 20:34:47'),
(241, 4, 0, '2023-02-12 20:34:47'),
(242, 4, 0, '2023-02-12 20:34:47'),
(243, 4, 0, '2023-02-12 20:34:47'),
(244, 4, 0, '2023-02-12 20:34:47'),
(245, 4, 0, '2023-02-12 20:34:47'),
(246, 4, 0, '2023-02-12 20:34:47'),
(247, 4, 0, '2023-02-12 20:34:47'),
(248, 4, 0, '2023-02-12 20:34:47'),
(249, 4, 0, '2023-02-12 20:34:47'),
(250, 4, 0, '2023-02-12 20:34:47'),
(251, 4, 0, '2023-02-12 20:34:47'),
(252, 4, 0, '2023-02-12 20:34:47'),
(253, 4, 0, '2023-02-12 20:34:47'),
(254, 4, 0, '2023-02-12 20:34:47'),
(255, 4, 0, '2023-02-12 20:35:28'),
(256, 4, 0, '2023-02-12 20:35:28'),
(257, 4, 0, '2023-02-12 20:35:28'),
(258, 4, 0, '2023-02-12 20:35:28'),
(259, 4, 0, '2023-02-12 20:35:28'),
(260, 4, 0, '2023-02-12 20:35:28'),
(261, 4, 0, '2023-02-12 20:35:28'),
(262, 4, 0, '2023-02-12 20:35:28'),
(263, 4, 0, '2023-02-12 20:35:28'),
(264, 4, 0, '2023-02-12 20:35:28'),
(265, 4, 0, '2023-02-12 20:35:28'),
(266, 4, 0, '2023-02-12 20:35:28'),
(267, 4, 0, '2023-02-12 20:35:34'),
(268, 4, 0, '2023-02-12 20:35:34'),
(269, 4, 0, '2023-02-12 20:35:34'),
(270, 4, 0, '2023-02-12 20:35:34'),
(271, 4, 0, '2023-02-12 20:35:34'),
(272, 4, 0, '2023-02-12 20:35:34'),
(273, 4, 0, '2023-02-12 20:35:34'),
(274, 4, 0, '2023-02-12 20:35:34'),
(275, 4, 0, '2023-02-12 20:35:34'),
(276, 4, 0, '2023-02-12 20:35:34'),
(277, 4, 0, '2023-02-12 20:35:34'),
(278, 4, 0, '2023-02-12 20:35:34'),
(279, 4, 0, '2023-02-12 20:36:02'),
(280, 4, 0, '2023-02-12 20:36:02'),
(281, 4, 0, '2023-02-12 20:36:02'),
(282, 4, 0, '2023-02-12 20:36:02'),
(283, 4, 0, '2023-02-12 20:36:02'),
(284, 4, 0, '2023-02-12 20:36:02'),
(285, 4, 0, '2023-02-12 20:36:02'),
(286, 4, 0, '2023-02-12 20:36:02'),
(287, 4, 0, '2023-02-12 20:36:02'),
(288, 4, 0, '2023-02-12 20:36:02'),
(289, 4, 0, '2023-02-12 20:36:02'),
(290, 4, 0, '2023-02-12 20:36:02'),
(291, 4, 0, '2023-02-12 20:36:02'),
(292, 4, 0, '2023-02-12 20:36:02'),
(293, 4, 0, '2023-02-12 20:36:02'),
(294, 4, 0, '2023-02-12 20:36:02'),
(295, 4, 0, '2023-02-12 20:36:02'),
(296, 4, 0, '2023-02-12 20:36:02'),
(297, 4, 0, '2023-02-12 20:36:02'),
(298, 4, 0, '2023-02-12 20:36:02'),
(299, 4, 0, '2023-02-12 20:36:02'),
(300, 4, 0, '2023-02-12 20:36:02'),
(301, 4, 0, '2023-02-12 20:36:02'),
(302, 4, 0, '2023-02-12 20:36:02'),
(303, 4, 0, '2023-02-12 20:36:02'),
(304, 4, 0, '2023-02-12 20:36:37'),
(305, 4, 0, '2023-02-12 20:36:37'),
(306, 4, 0, '2023-02-12 20:36:37'),
(307, 4, 0, '2023-02-12 20:36:37'),
(308, 4, 0, '2023-02-12 20:36:37'),
(309, 4, 0, '2023-02-12 20:36:37'),
(310, 4, 0, '2023-02-12 20:36:37'),
(311, 4, 0, '2023-02-12 20:36:37'),
(312, 4, 0, '2023-02-12 20:36:37'),
(313, 4, 0, '2023-02-12 20:36:37'),
(314, 4, 0, '2023-02-12 20:36:37'),
(315, 4, 0, '2023-02-12 20:36:37'),
(316, 4, 0, '2023-02-12 20:36:45'),
(317, 4, 0, '2023-02-12 20:36:45'),
(318, 4, 0, '2023-02-12 20:36:45'),
(319, 4, 0, '2023-02-12 20:36:45'),
(320, 4, 0, '2023-02-12 20:36:45'),
(321, 4, 0, '2023-02-12 20:36:45'),
(322, 4, 0, '2023-02-12 20:36:45'),
(323, 4, 0, '2023-02-12 20:36:45'),
(324, 4, 0, '2023-02-12 20:36:45'),
(325, 4, 0, '2023-02-12 20:36:45'),
(326, 4, 0, '2023-02-12 20:36:45'),
(327, 4, 0, '2023-02-12 20:36:45'),
(328, 4, 0, '2023-02-12 20:37:15'),
(329, 4, 0, '2023-02-12 20:37:15'),
(330, 4, 0, '2023-02-12 20:37:15'),
(331, 4, 0, '2023-02-12 20:37:15'),
(332, 4, 0, '2023-02-12 20:37:15'),
(333, 4, 0, '2023-02-12 20:37:15'),
(334, 4, 0, '2023-02-12 20:37:15'),
(335, 4, 0, '2023-02-12 20:37:15'),
(336, 4, 0, '2023-02-12 20:37:15'),
(337, 4, 0, '2023-02-12 20:37:15'),
(338, 4, 0, '2023-02-12 20:37:15'),
(339, 4, 0, '2023-02-12 20:37:15'),
(340, 4, 0, '2023-02-12 20:37:15'),
(341, 4, 0, '2023-02-12 20:37:15'),
(342, 4, 0, '2023-02-12 20:37:15'),
(343, 4, 0, '2023-02-12 20:37:15'),
(344, 4, 0, '2023-02-12 20:37:15'),
(345, 4, 0, '2023-02-12 20:37:15'),
(346, 4, 0, '2023-02-12 20:37:15'),
(347, 4, 0, '2023-02-12 20:37:15'),
(348, 4, 0, '2023-02-12 20:37:15'),
(349, 4, 0, '2023-02-12 20:37:15'),
(350, 4, 0, '2023-02-12 20:37:15'),
(351, 4, 0, '2023-02-12 20:37:15'),
(352, 4, 0, '2023-02-12 20:37:15'),
(353, 4, 0, '2023-02-12 20:37:19'),
(354, 4, 0, '2023-02-12 20:37:19'),
(355, 4, 0, '2023-02-12 20:37:19'),
(356, 4, 0, '2023-02-12 20:37:19'),
(357, 4, 0, '2023-02-12 20:37:19'),
(358, 4, 0, '2023-02-12 20:37:19'),
(359, 4, 0, '2023-02-12 20:37:19'),
(360, 4, 0, '2023-02-12 20:37:19'),
(361, 4, 0, '2023-02-12 20:37:19'),
(362, 4, 0, '2023-02-12 20:37:19'),
(363, 4, 0, '2023-02-12 20:37:19'),
(364, 4, 0, '2023-02-12 20:37:19'),
(365, 4, 0, '2023-02-12 20:37:20'),
(366, 4, 0, '2023-02-12 20:37:20'),
(367, 4, 0, '2023-02-12 20:37:20'),
(368, 4, 0, '2023-02-12 20:37:20'),
(369, 4, 0, '2023-02-12 20:37:20'),
(370, 4, 0, '2023-02-12 20:37:20'),
(371, 4, 0, '2023-02-12 20:37:20'),
(372, 4, 0, '2023-02-12 20:37:20'),
(373, 4, 0, '2023-02-12 20:37:20'),
(374, 4, 0, '2023-02-12 20:37:20'),
(375, 4, 0, '2023-02-12 20:37:20'),
(376, 4, 0, '2023-02-12 20:37:20'),
(377, 4, 0, '2023-02-12 20:37:20'),
(378, 4, 0, '2023-02-12 20:37:20'),
(379, 4, 0, '2023-02-12 20:37:20'),
(380, 4, 0, '2023-02-12 20:37:20'),
(381, 4, 0, '2023-02-12 20:37:20'),
(382, 4, 0, '2023-02-12 20:37:20'),
(383, 4, 0, '2023-02-12 20:37:20'),
(384, 4, 0, '2023-02-12 20:37:20'),
(385, 4, 0, '2023-02-12 20:37:20'),
(386, 4, 0, '2023-02-12 20:37:20'),
(387, 4, 0, '2023-02-12 20:37:20'),
(388, 4, 0, '2023-02-12 20:37:20'),
(389, 4, 0, '2023-02-12 20:37:21'),
(390, 4, 0, '2023-02-12 20:37:21'),
(391, 4, 0, '2023-02-12 20:37:21'),
(392, 4, 0, '2023-02-12 20:37:21'),
(393, 4, 0, '2023-02-12 20:37:21'),
(394, 4, 0, '2023-02-12 20:37:21'),
(395, 4, 0, '2023-02-12 20:37:21'),
(396, 4, 0, '2023-02-12 20:37:21'),
(397, 4, 0, '2023-02-12 20:37:21'),
(398, 4, 0, '2023-02-12 20:37:21'),
(399, 4, 0, '2023-02-12 20:37:21'),
(400, 4, 0, '2023-02-12 20:37:21'),
(401, 4, 0, '2023-02-12 20:37:44'),
(402, 4, 0, '2023-02-12 20:37:44'),
(403, 4, 0, '2023-02-12 20:37:44'),
(404, 4, 0, '2023-02-12 20:37:44'),
(405, 4, 0, '2023-02-12 20:37:44'),
(406, 4, 0, '2023-02-12 20:37:44'),
(407, 4, 0, '2023-02-12 20:37:44'),
(408, 4, 0, '2023-02-12 20:37:44'),
(409, 4, 0, '2023-02-12 20:37:44'),
(410, 4, 0, '2023-02-12 20:37:44'),
(411, 4, 0, '2023-02-12 20:37:44'),
(412, 4, 0, '2023-02-12 20:37:44'),
(413, 4, 0, '2023-02-12 20:38:50'),
(414, 4, 0, '2023-02-12 20:38:50'),
(415, 4, 0, '2023-02-12 20:38:50'),
(416, 4, 0, '2023-02-12 20:38:50'),
(417, 4, 0, '2023-02-12 20:38:50'),
(418, 4, 0, '2023-02-12 20:38:50'),
(419, 4, 0, '2023-02-12 20:38:50'),
(420, 4, 0, '2023-02-12 20:38:50'),
(421, 4, 0, '2023-02-12 20:38:50'),
(422, 4, 0, '2023-02-12 20:38:50'),
(423, 4, 0, '2023-02-12 20:38:50'),
(424, 4, 0, '2023-02-12 20:38:50'),
(425, 4, 0, '2023-02-12 20:40:18'),
(426, 4, 0, '2023-02-12 20:40:18'),
(427, 4, 0, '2023-02-12 20:40:18'),
(428, 4, 0, '2023-02-12 20:40:18'),
(429, 4, 0, '2023-02-12 20:40:18'),
(430, 4, 0, '2023-02-12 20:40:18'),
(431, 4, 0, '2023-02-12 20:40:18'),
(432, 4, 0, '2023-02-12 20:40:18'),
(433, 4, 0, '2023-02-12 20:40:18'),
(434, 4, 0, '2023-02-12 20:40:18'),
(435, 4, 0, '2023-02-12 20:40:18'),
(436, 4, 0, '2023-02-12 20:40:18'),
(437, 4, 0, '2023-02-12 20:40:18'),
(438, 4, 0, '2023-02-12 20:40:18'),
(439, 4, 0, '2023-02-12 20:40:18'),
(440, 4, 0, '2023-02-12 20:40:18'),
(441, 4, 0, '2023-02-12 20:40:18'),
(442, 4, 0, '2023-02-12 20:40:18'),
(443, 4, 0, '2023-02-12 20:40:18'),
(444, 4, 0, '2023-02-12 20:40:18'),
(445, 4, 0, '2023-02-12 20:40:18'),
(446, 4, 0, '2023-02-12 20:40:18'),
(447, 4, 0, '2023-02-12 20:40:18'),
(448, 4, 0, '2023-02-12 20:40:18'),
(449, 4, 0, '2023-02-12 20:40:18'),
(450, 4, 0, '2023-02-12 20:52:05'),
(451, 4, 0, '2023-02-12 20:52:05'),
(452, 4, 0, '2023-02-12 20:52:05'),
(453, 4, 0, '2023-02-12 20:52:05'),
(454, 4, 0, '2023-02-12 20:52:05'),
(455, 4, 0, '2023-02-12 20:52:05'),
(456, 4, 0, '2023-02-12 20:52:05'),
(457, 4, 0, '2023-02-12 20:52:05'),
(458, 4, 0, '2023-02-12 20:52:05'),
(459, 4, 0, '2023-02-12 20:52:05'),
(460, 4, 0, '2023-02-12 20:52:05'),
(461, 4, 0, '2023-02-12 20:52:05'),
(462, 19, 0, '2023-02-12 20:52:26'),
(463, 20, 0, '2023-02-12 20:55:47'),
(464, 21, 0, '2023-02-12 21:55:43');

-- --------------------------------------------------------

--
-- Struttura della tabella `Categoria`
--
-- Creazione: Feb 12, 2023 alle 21:55
-- Ultimo aggiornamento: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Categoria`;
CREATE TABLE IF NOT EXISTS `Categoria` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(300) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Categoria`
--

INSERT INTO `Categoria` (`Id`, `Nome`, `Descrizione`, `Status`, `Timestamp`) VALUES
(1, 'name_unset', 'desc_unset', 0, '2023-02-04 09:47:10');

-- --------------------------------------------------------

--
-- Struttura della tabella `Claim`
--
-- Creazione: Feb 12, 2023 alle 21:55
-- Ultimo aggiornamento: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Claim`;
CREATE TABLE IF NOT EXISTS `Claim` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(50) NOT NULL,
  `Conto` decimal(10,0) NOT NULL,
  `Status` int(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Claim`
--

INSERT INTO `Claim` (`Id`, `Descrizione`, `Conto`, `Status`, `Timestamp`) VALUES
(55, 'user', '0', 0, '2023-01-31 15:35:38'),
(56, 'seller', '0', 0, '2023-01-31 15:38:04'),
(57, 'seller', '0', 0, '2023-02-02 08:32:19'),
(58, 'user', '0', 0, '2023-02-02 13:44:59'),
(59, 'user', '0', 0, '2023-02-05 09:16:32'),
(60, 'user', '0', 0, '2023-02-05 09:21:09'),
(61, 'user', '0', 0, '2023-02-05 15:02:49'),
(62, 'user', '0', 0, '2023-02-05 15:07:55'),
(63, 'user', '0', 0, '2023-02-05 15:09:34'),
(64, 'user', '0', 0, '2023-02-05 15:28:06'),
(65, 'user', '0', 0, '2023-02-05 15:43:37'),
(66, 'user', '0', 0, '2023-02-05 15:50:47'),
(67, 'user', '0', 0, '2023-02-05 16:10:23'),
(68, 'user', '0', 0, '2023-02-06 14:58:54'),
(69, 'seller', '0', 0, '2023-02-09 18:14:48'),
(70, 'user', '0', 0, '2023-02-12 20:52:26'),
(71, 'seller', '0', 0, '2023-02-12 20:55:47'),
(72, 'user', '0', 0, '2023-02-12 21:55:43');

-- --------------------------------------------------------

--
-- Struttura della tabella `Configurazione_variazione`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Configurazione_variazione`;
CREATE TABLE IF NOT EXISTS `Configurazione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Articolo_id` int(11) NOT NULL,
  `Opzio_variazione_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Opzio_variazione_id` (`Opzio_variazione_id`),
  KEY `Articolo_id` (`Articolo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Dettaglio_ordine`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Dettaglio_ordine`;
CREATE TABLE IF NOT EXISTS `Dettaglio_ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` int(11) NOT NULL,
  `Articolo_in_carr_id` int(11) NOT NULL,
  `Ordine_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Articolo_in_carr_id` (`Articolo_in_carr_id`),
  KEY `Ordine_id` (`Ordine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Dimensione`
--
-- Creazione: Feb 12, 2023 alle 21:55
-- Ultimo aggiornamento: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Dimensione`;
CREATE TABLE IF NOT EXISTS `Dimensione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dim_X` varchar(100) NOT NULL,
  `Dim_Y` varchar(100) NOT NULL,
  `Dim_Z` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Dimensione`
--

INSERT INTO `Dimensione` (`Id`, `Dim_X`, `Dim_Y`, `Dim_Z`, `Timestamp`) VALUES
(2, 'dimX_unset', 'dimY_unset', 'dimZ_unset', '2023-02-04 09:43:18');

-- --------------------------------------------------------

--
-- Struttura della tabella `Forma_di_pagamento`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Forma_di_pagamento`;
CREATE TABLE IF NOT EXISTS `Forma_di_pagamento` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Circuito` varchar(20) NOT NULL,
  `Numero_carta` varchar(20) NOT NULL,
  `Data_scadenza` varchar(20) NOT NULL,
  `CVV` int(3) NOT NULL,
  `Tipo_di_pagamento` int(10) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Forma_di_pagamento`
--

INSERT INTO `Forma_di_pagamento` (`Id`, `Circuito`, `Numero_carta`, `Data_scadenza`, `CVV`, `Tipo_di_pagamento`, `Utente_id`, `Status`, `Timestamp`) VALUES
(3, 'Unknown', '4444 5555 6666 7777', '2023-02-02', 1, 1, 4, 0, '2023-02-02 14:59:11'),
(4, 'American Express', '3434 4545 5656 6767', '2023-02-12', 2, 1, 5, 0, '2023-02-02 15:02:01');

-- --------------------------------------------------------

--
-- Struttura della tabella `Indirizzo`
--
-- Creazione: Feb 12, 2023 alle 21:55
-- Ultimo aggiornamento: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Indirizzo`;
CREATE TABLE IF NOT EXISTS `Indirizzo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Via` varchar(100) NOT NULL,
  `Numero_civico` int(5) NOT NULL,
  `Citta` varchar(50) NOT NULL,
  `CAP` int(5) NOT NULL,
  `Status` int(4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Indirizzo`
--

INSERT INTO `Indirizzo` (`Id`, `Via`, `Numero_civico`, `Citta`, `CAP`, `Status`, `Timestamp`) VALUES
(1, 'Unset', 0, 'Unset', 0, 0, '2023-01-28 14:15:44'),
(2, 'Santa Maria Maddalena', 100, 'Rimini', 47900, 0, '2023-02-02 13:52:44'),
(3, 'Santa Maria Maddalena', 100, 'Rimini', 47900, 0, '2023-02-02 14:00:40');

-- --------------------------------------------------------

--
-- Struttura della tabella `Magazzino`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Magazzino`;
CREATE TABLE IF NOT EXISTS `Magazzino` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Metri_cubi` double NOT NULL,
  `Indirizzo_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Indirizzo_id` (`Indirizzo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Opzione_variazione`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Opzione_variazione`;
CREATE TABLE IF NOT EXISTS `Opzione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Valore` varchar(300) NOT NULL,
  `Variazione_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Variazione_id` (`Variazione_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Ordine`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Ordine`;
CREATE TABLE IF NOT EXISTS `Ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Data_ordine` date NOT NULL,
  `Tot_ordine` decimal(10,0) NOT NULL,
  `Status` int(11) NOT NULL,
  `Metodo_di_spedizione` int(11) NOT NULL,
  `Forma_di_pag_id` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Forma_di_pag_id` (`Forma_di_pag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Prodotto`;
CREATE TABLE IF NOT EXISTS `Prodotto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(50) NOT NULL,
  `Immagine` varchar(300) NOT NULL,
  `Dim_id` int(11) NOT NULL,
  `Categoria_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Dim_id` (`Dim_id`),
  KEY `Categoria_id` (`Categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Prodotto`
--

INSERT INTO `Prodotto` (`Id`, `Nome`, `Descrizione`, `Immagine`, `Dim_id`, `Categoria_id`, `Status`, `Timestamp`) VALUES
(1, 'name_unset', 'desc_unset', 'img_unset', 2, 1, 0, '2023-02-04 09:55:55');

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto_in_raccolta`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Prodotto_in_raccolta`;
CREATE TABLE IF NOT EXISTS `Prodotto_in_raccolta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Raccolta_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Prodotto_id` (`Prodotto_id`),
  KEY `Raccolta_id` (`Raccolta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Prodotto_in_raccolta`
--

INSERT INTO `Prodotto_in_raccolta` (`Id`, `Raccolta_id`, `Prodotto_id`, `Status`, `Timestamp`) VALUES
(1, 1, 1, 0, '2023-02-10 15:49:37');

-- --------------------------------------------------------

--
-- Struttura della tabella `Raccolta`
--
-- Creazione: Feb 12, 2023 alle 21:55
-- Ultimo aggiornamento: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Raccolta`;
CREATE TABLE IF NOT EXISTS `Raccolta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_raccolta` int(5) NOT NULL,
  `Titolo` varchar(50) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Status` int(4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Raccolta`
--

INSERT INTO `Raccolta` (`Id`, `Tipo_raccolta`, `Titolo`, `Utente_id`, `Status`, `Timestamp`) VALUES
(1, 1, 'Wishlist', 17, 0, '2023-02-10 15:31:09'),
(2, 1, 'whislist', 5, 0, '2023-02-12 18:17:51'),
(3, 1, 'whislist', 4, 0, '2023-02-12 20:34:47'),
(4, 1, 'whislist', 19, 0, '2023-02-12 20:52:26'),
(5, 1, 'whislist', 20, 0, '2023-02-12 20:55:47'),
(6, 1, 'whislist', 21, 0, '2023-02-12 21:55:43');

-- --------------------------------------------------------

--
-- Struttura della tabella `Recensione`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Recensione`;
CREATE TABLE IF NOT EXISTS `Recensione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Valutazione` int(5) NOT NULL,
  `Commento` varchar(300) NOT NULL,
  `Dettaglio_ordine_id` int(11) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Dettaglio_ordine_id` (`Dettaglio_ordine_id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--
-- Creazione: Feb 12, 2023 alle 21:55
-- Ultimo aggiornamento: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Utente`;
CREATE TABLE IF NOT EXISTS `Utente` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Claim_id` int(11) NOT NULL,
  `Indirizzo_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Indirizzo_id` (`Indirizzo_id`),
  KEY `Claim_id` (`Claim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Utente`
--

INSERT INTO `Utente` (`Id`, `Nome`, `Cognome`, `Email`, `Password`, `Claim_id`, `Indirizzo_id`, `Status`, `Timestamp`) VALUES
(4, 'Endri', 'Domi', 'endri@takeit.com', 'takeit', 55, 3, 0, '2023-01-31 15:35:38'),
(5, 'Federico', 'Brunelli', 'fede@takeit.com', 'takeit', 56, 1, 0, '2023-01-31 15:38:04'),
(6, 'Chiara', 'Delmonte', 'chiara.delmonte@takeit.com', 'takeit', 57, 1, 0, '2023-02-02 08:32:19'),
(7, 'Mario', 'Rossi', 'mario@rossi.com', 'mariorossi', 58, 1, 0, '2023-02-02 13:44:59'),
(8, 'Alessandro', 'Pioggia', 'ale@pioggia.com', 'takeit', 59, 1, 0, '2023-02-05 09:16:32'),
(9, 'ale', 'pio', 'alepio@sdf.com', 'dsfsdfsdf', 60, 1, 0, '2023-02-05 09:21:09'),
(10, 'Marco', 'Pesaresi', 'marco@takeit.com', 'takeit', 61, 1, 0, '2023-02-05 15:02:49'),
(11, 'Riccardo', 'Battelli', 'riccardo@takeit.com', 'takeit', 62, 1, 0, '2023-02-05 15:07:55'),
(12, 'Matteo', 'Amadori', 'matteo@takeit.com', 'takeit', 63, 1, 0, '2023-02-05 15:09:34'),
(13, 'User', 'user', 'user@takeit.com', 'takeit', 64, 1, 0, '2023-02-05 15:28:06'),
(14, 'Franceso', 'Migani', 'francesco.migani@test.com', 'takeit', 65, 1, 0, '2023-02-05 15:43:37'),
(15, 'Alessandro', 'Ricci', 'a@ricci.com', 'takeit', 66, 1, 0, '2023-02-05 15:50:47'),
(16, 'Roberto', 'Rossi', 'roberto@rossi.com', 'takeit', 67, 1, 0, '2023-02-05 16:10:23'),
(17, 'Aurora', 'Rossi', 'aurora@rossi.com', 'takeit', 68, 1, 0, '2023-02-06 14:58:54'),
(18, 'Dario', 'Ricci', 'dario@takeit.it', 'takeit', 69, 1, 0, '2023-02-09 18:14:48'),
(19, 'Mirko', 'Viroli', 'mirko@viroli.com', 'takeit', 70, 1, 0, '2023-02-12 20:52:26'),
(20, 'Alessandro', 'Mancini', 'ale@mancini.com', 'takeit', 71, 1, 0, '2023-02-12 20:55:47'),
(21, 'Roberto', 'Casadei', 'robi@casadei.com', 'takeit', 72, 1, 0, '2023-02-12 21:55:43');

-- --------------------------------------------------------

--
-- Struttura della tabella `Variazione`
--
-- Creazione: Feb 12, 2023 alle 21:55
--

DROP TABLE IF EXISTS `Variazione`;
CREATE TABLE IF NOT EXISTS `Variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(300) NOT NULL,
  `Categoria_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Categoria_id` (`Categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Articolo`
--
ALTER TABLE `Articolo`
  ADD CONSTRAINT `articolo_ibfk_2` FOREIGN KEY (`Prodotto_id`) REFERENCES `Prodotto` (`Id`),
  ADD CONSTRAINT `articolo_ibfk_3` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Articolo_in_carrello`
--
ALTER TABLE `Articolo_in_carrello`
  ADD CONSTRAINT `articolo_in_carrello_ibfk_1` FOREIGN KEY (`Carrello_id`) REFERENCES `Carrello` (`Id`),
  ADD CONSTRAINT `articolo_in_carrello_ibfk_2` FOREIGN KEY (`Articolo_id`) REFERENCES `Articolo` (`Id`);

--
-- Limiti per la tabella `Articolo_in_magazzino`
--
ALTER TABLE `Articolo_in_magazzino`
  ADD CONSTRAINT `articolo_in_magazzino_ibfk_1` FOREIGN KEY (`Articolo_id`) REFERENCES `Articolo` (`Id`),
  ADD CONSTRAINT `articolo_in_magazzino_ibfk_2` FOREIGN KEY (`Magazzino_id`) REFERENCES `Magazzino` (`Id`);

--
-- Limiti per la tabella `Carrello`
--
ALTER TABLE `Carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Configurazione_variazione`
--
ALTER TABLE `Configurazione_variazione`
  ADD CONSTRAINT `configurazione_variazione_ibfk_1` FOREIGN KEY (`Opzio_variazione_id`) REFERENCES `Opzione_variazione` (`Id`),
  ADD CONSTRAINT `configurazione_variazione_ibfk_2` FOREIGN KEY (`Articolo_id`) REFERENCES `Articolo` (`Id`);

--
-- Limiti per la tabella `Dettaglio_ordine`
--
ALTER TABLE `Dettaglio_ordine`
  ADD CONSTRAINT `dettaglio_ordine_ibfk_1` FOREIGN KEY (`Articolo_in_carr_id`) REFERENCES `Articolo_in_carrello` (`Id`),
  ADD CONSTRAINT `dettaglio_ordine_ibfk_2` FOREIGN KEY (`Ordine_id`) REFERENCES `Ordine` (`Id`);

--
-- Limiti per la tabella `Forma_di_pagamento`
--
ALTER TABLE `Forma_di_pagamento`
  ADD CONSTRAINT `forma_di_pagamento_ibfk_1` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Magazzino`
--
ALTER TABLE `Magazzino`
  ADD CONSTRAINT `magazzino_ibfk_1` FOREIGN KEY (`Indirizzo_id`) REFERENCES `Indirizzo` (`Id`);

--
-- Limiti per la tabella `Opzione_variazione`
--
ALTER TABLE `Opzione_variazione`
  ADD CONSTRAINT `opzione_variazione_ibfk_1` FOREIGN KEY (`Variazione_id`) REFERENCES `Variazione` (`Id`);

--
-- Limiti per la tabella `Ordine`
--
ALTER TABLE `Ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`Forma_di_pag_id`) REFERENCES `Forma_di_pagamento` (`Id`);

--
-- Limiti per la tabella `Prodotto`
--
ALTER TABLE `Prodotto`
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`Dim_id`) REFERENCES `Dimensione` (`Id`),
  ADD CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`Categoria_id`) REFERENCES `Categoria` (`Id`);

--
-- Limiti per la tabella `Prodotto_in_raccolta`
--
ALTER TABLE `Prodotto_in_raccolta`
  ADD CONSTRAINT `prodotto_in_raccolta_ibfk_1` FOREIGN KEY (`Prodotto_id`) REFERENCES `Prodotto` (`Id`),
  ADD CONSTRAINT `prodotto_in_raccolta_ibfk_2` FOREIGN KEY (`Raccolta_id`) REFERENCES `Raccolta` (`Id`);

--
-- Limiti per la tabella `Raccolta`
--
ALTER TABLE `Raccolta`
  ADD CONSTRAINT `raccolta_ibfk_1` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Recensione`
--
ALTER TABLE `Recensione`
  ADD CONSTRAINT `recensione_ibfk_1` FOREIGN KEY (`Dettaglio_ordine_id`) REFERENCES `Dettaglio_ordine` (`Id`),
  ADD CONSTRAINT `recensione_ibfk_2` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Utente`
--
ALTER TABLE `Utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`Indirizzo_id`) REFERENCES `Indirizzo` (`Id`),
  ADD CONSTRAINT `utente_ibfk_2` FOREIGN KEY (`Claim_id`) REFERENCES `Claim` (`Id`);

--
-- Limiti per la tabella `Variazione`
--
ALTER TABLE `Variazione`
  ADD CONSTRAINT `variazione_ibfk_1` FOREIGN KEY (`Categoria_id`) REFERENCES `Categoria` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
