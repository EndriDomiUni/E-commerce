-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Giu 09, 2023 alle 17:28
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

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

-- --------------------------------------------------------

--
-- Struttura della tabella `Configurazione_variazione`
--

DROP TABLE IF EXISTS `Configurazione_variazione`;
CREATE TABLE IF NOT EXISTS `Configurazione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Articolo_id` int(11) NOT NULL,
  `Opzio_variazione_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Articolo_id` (`Articolo_id`),
  KEY `Opzio_variazione_id` (`Opzio_variazione_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Configurazione_variazione`
--

INSERT INTO `Configurazione_variazione` (`Id`, `Articolo_id`, `Opzio_variazione_id`, `Status`, `Timestamp`) VALUES
(1, 13, 2, 1, '2023-02-13 00:07:25'),
(2, 13, 6, 1, '2023-02-13 00:07:25'),
(3, 15, 2, 1, '2023-02-13 00:10:48'),
(4, 15, 6, 1, '2023-02-13 00:10:48'),
(5, 17, 2, 1, '2023-02-13 00:13:00'),
(6, 17, 6, 1, '2023-02-13 00:13:00'),
(7, 19, 11, 1, '2023-02-13 22:13:52'),
(8, 19, 14, 1, '2023-02-13 22:13:52'),
(9, 21, 8, 1, '2023-02-13 22:17:19'),
(10, 21, 18, 1, '2023-02-13 22:17:19'),
(11, 22, 4, 1, '2023-02-15 10:12:48'),
(12, 22, 5, 1, '2023-02-15 10:12:48'),
(13, 23, 21, 1, '2023-02-15 10:20:48'),
(14, 23, 22, 1, '2023-02-15 10:20:48'),
(15, 24, 19, 1, '2023-02-15 10:23:14'),
(16, 24, 22, 1, '2023-02-15 10:23:14'),
(17, 25, 19, 1, '2023-02-15 10:23:38'),
(18, 25, 22, 1, '2023-02-15 10:23:38'),
(19, 26, 20, 1, '2023-02-15 10:27:56'),
(20, 26, 24, 1, '2023-02-15 10:27:56'),
(21, 27, 11, 1, '2023-02-15 10:30:58'),
(22, 27, 15, 1, '2023-02-15 10:30:58'),
(23, 28, 12, 1, '2023-02-15 10:33:58'),
(24, 28, 15, 1, '2023-02-15 10:33:58'),
(25, 29, 3, 1, '2023-02-15 10:37:56'),
(26, 29, 25, 1, '2023-02-15 10:37:56'),
(27, 30, 8, 1, '2023-02-15 10:40:20'),
(28, 30, 18, 1, '2023-02-15 10:40:20'),
(29, 31, 21, 1, '2023-02-15 10:43:29'),
(30, 31, 23, 1, '2023-02-15 10:43:29'),
(31, 32, 8, 1, '2023-02-15 12:28:31'),
(32, 32, 17, 1, '2023-02-15 12:28:31'),
(33, 33, 2, 1, '2023-05-18 14:09:35'),
(34, 33, 5, 1, '2023-05-18 14:09:35'),
(35, 34, 10, 1, '2023-05-18 14:25:18'),
(36, 34, 13, 1, '2023-05-18 14:25:18'),
(37, 35, 10, 1, '2023-05-18 14:33:00'),
(38, 35, 13, 1, '2023-05-18 14:33:00'),
(39, 36, 10, 1, '2023-05-18 14:33:38'),
(40, 36, 13, 1, '2023-05-18 14:33:38'),
(41, 37, 10, 1, '2023-05-18 14:34:53'),
(42, 37, 13, 1, '2023-05-18 14:34:53'),
(43, 38, 10, 1, '2023-05-18 14:36:32'),
(44, 38, 13, 1, '2023-05-18 14:36:32'),
(45, 39, 10, 1, '2023-05-18 14:39:00'),
(46, 39, 13, 1, '2023-05-18 14:39:00'),
(47, 40, 10, 1, '2023-05-18 14:41:49'),
(48, 40, 13, 1, '2023-05-18 14:41:49'),
(49, 41, 10, 1, '2023-05-18 14:41:59'),
(50, 41, 13, 1, '2023-05-18 14:41:59'),
(51, 42, 2, 1, '2023-05-18 14:43:54'),
(52, 42, 5, 1, '2023-05-18 14:43:54'),
(53, 43, 2, 1, '2023-05-18 14:45:40'),
(54, 43, 5, 1, '2023-05-18 14:45:40'),
(55, 44, 2, 1, '2023-05-18 15:34:54'),
(56, 44, 6, 1, '2023-05-18 15:34:54'),
(57, 45, 2, 1, '2023-05-19 14:16:27'),
(58, 45, 5, 1, '2023-05-19 14:16:27'),
(59, 46, 20, 1, '2023-05-19 14:19:00'),
(60, 46, 23, 1, '2023-05-19 14:19:00'),
(61, 47, 10, 1, '2023-05-19 16:34:36'),
(62, 47, 13, 1, '2023-05-19 16:34:36'),
(63, 55, 26, 1, '2023-06-09 15:17:46'),
(64, 56, 28, 1, '2023-06-09 15:25:00');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Configurazione_variazione`
--
ALTER TABLE `Configurazione_variazione`
  ADD CONSTRAINT `configurazione_variazione_ibfk_1` FOREIGN KEY (`Opzio_variazione_id`) REFERENCES `Opzione_variazione` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
