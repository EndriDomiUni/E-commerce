-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Giu 14, 2023 alle 10:18
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
CREATE DATABASE IF NOT EXISTS `e-commerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `e-commerce`;

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo`
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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Articolo`
--

INSERT INTO `Articolo` (`Id`, `Prezzo`, `Utente_id`, `Prodotto_id`, `Status`, `Timestamp`) VALUES
(57, '35', 51, 32, 1, '2023-06-09 16:39:46'),
(58, '15', 51, 33, 1, '2023-06-10 12:49:07'),
(59, '15', 51, 33, 1, '2023-06-10 12:51:04'),
(60, '40', 51, 34, 1, '2023-06-10 12:52:34'),
(61, '40', 51, 35, 1, '2023-06-10 12:54:20'),
(62, '20', 51, 36, 1, '2023-06-10 12:55:49'),
(63, '18', 51, 37, 1, '2023-06-10 12:57:49'),
(64, '25', 51, 38, 1, '2023-06-10 12:58:39'),
(65, '12', 51, 39, 1, '2023-06-10 13:14:14'),
(66, '22', 51, 40, 1, '2023-06-10 13:19:25'),
(67, '50', 51, 41, 1, '2023-06-10 13:27:20'),
(68, '10', 51, 42, 1, '2023-06-10 13:32:20'),
(69, '60', 51, 43, 1, '2023-06-10 13:40:08'),
(70, '35', 51, 44, 1, '2023-06-10 13:52:07'),
(71, '30', 51, 45, 1, '2023-06-10 13:54:22'),
(72, '42', 51, 46, 1, '2023-06-10 13:57:45'),
(73, '80', 52, 47, 1, '2023-06-11 15:32:56');

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo_in_carrello`
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo_in_magazzino`
--

DROP TABLE IF EXISTS `Articolo_in_magazzino`;
CREATE TABLE IF NOT EXISTS `Articolo_in_magazzino` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Quantità` int(30) UNSIGNED NOT NULL,
  `Articolo_id` int(11) NOT NULL,
  `Magazzino_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Articolo_id` (`Articolo_id`),
  KEY `Magazzino_id` (`Magazzino_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Articolo_in_magazzino`
--

INSERT INTO `Articolo_in_magazzino` (`Id`, `Quantità`, `Articolo_id`, `Magazzino_id`, `Status`, `Timestamp`) VALUES
(38, 97, 57, 1, 0, '2023-06-09 16:39:46'),
(39, 100, 58, 1, 0, '2023-06-10 12:49:07'),
(40, 100, 59, 2, 0, '2023-06-10 12:51:04'),
(41, 100, 60, 1, 0, '2023-06-10 12:52:34'),
(42, 99, 61, 2, 0, '2023-06-10 12:54:20'),
(43, 100, 62, 1, 0, '2023-06-10 12:55:49'),
(44, 100, 63, 1, 0, '2023-06-10 12:57:49'),
(45, 100, 64, 1, 0, '2023-06-10 12:58:39'),
(46, 100, 65, 1, 0, '2023-06-10 13:14:14'),
(47, 99, 66, 2, 0, '2023-06-10 13:19:25'),
(48, 100, 67, 1, 0, '2023-06-10 13:27:20'),
(49, 100, 68, 1, 0, '2023-06-10 13:32:20'),
(50, 100, 69, 1, 0, '2023-06-10 13:40:08'),
(51, 98, 70, 1, 0, '2023-06-10 13:52:07'),
(52, 100, 71, 2, 0, '2023-06-10 13:54:22'),
(53, 98, 72, 2, 0, '2023-06-10 13:57:45'),
(54, 44, 73, 1, 0, '2023-06-11 15:32:56');

-- --------------------------------------------------------

--
-- Struttura della tabella `Carrello`
--

DROP TABLE IF EXISTS `Carrello`;
CREATE TABLE IF NOT EXISTS `Carrello` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Utente_id` int(11) NOT NULL,
  `Status` int(4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=563 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Carrello`
--

INSERT INTO `Carrello` (`Id`, `Utente_id`, `Status`, `Timestamp`) VALUES
(558, 50, 0, '2023-06-09 15:47:57'),
(559, 51, 0, '2023-06-09 15:50:09'),
(560, 52, 0, '2023-06-11 15:30:02'),
(561, 53, 0, '2023-06-11 16:30:13'),
(562, 54, 0, '2023-06-11 16:32:28');

-- --------------------------------------------------------

--
-- Struttura della tabella `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
CREATE TABLE IF NOT EXISTS `Categoria` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(300) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Categoria`
--

INSERT INTO `Categoria` (`Id`, `Nome`, `Descrizione`, `Status`, `Timestamp`) VALUES
(1, 'T-shirt', 'maglia, maglietta, canotta', 1, '2023-06-09 16:20:36'),
(2, 'Pantaloni', 'pantaloni, jeans, pantaloncini, costumi', 1, '2023-06-09 16:20:36'),
(3, 'Scarpe', 'Scarpe casual, trecking, infradito, sportive', 1, '2023-06-09 16:20:36'),
(4, 'Felpa', 'Felpe casual, invernali, sportive', 1, '2023-06-09 16:20:36'),
(5, 'Cappelli', 'Cappelli, berrette', 1, '2023-06-09 16:20:36');

-- --------------------------------------------------------

--
-- Struttura della tabella `Claim`
--

DROP TABLE IF EXISTS `Claim`;
CREATE TABLE IF NOT EXISTS `Claim` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(50) NOT NULL,
  `Conto` decimal(10,0) NOT NULL,
  `Status` int(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Claim`
--

INSERT INTO `Claim` (`Id`, `Descrizione`, `Conto`, `Status`, `Timestamp`) VALUES
(104, 'user', '0', 0, '2023-06-09 15:46:30'),
(105, 'user', '0', 0, '2023-06-09 15:47:57'),
(106, 'seller', '42', 0, '2023-06-09 15:50:09'),
(107, 'seller', '80', 0, '2023-06-11 15:30:02'),
(108, 'user', '0', 0, '2023-06-11 16:30:13'),
(109, 'user', '0', 0, '2023-06-11 16:32:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Configurazione_variazione`
--

INSERT INTO `Configurazione_variazione` (`Id`, `Articolo_id`, `Opzio_variazione_id`, `Status`, `Timestamp`) VALUES
(65, 57, 9, 1, '2023-06-09 16:39:46'),
(66, 58, 3, 1, '2023-06-10 12:49:07'),
(67, 58, 5, 1, '2023-06-10 12:49:07'),
(68, 59, 2, 1, '2023-06-10 12:51:04'),
(69, 59, 5, 1, '2023-06-10 12:51:04'),
(70, 60, 8, 1, '2023-06-10 12:52:34'),
(71, 61, 7, 1, '2023-06-10 12:54:20'),
(72, 62, 22, 1, '2023-06-10 12:55:49'),
(73, 62, 24, 1, '2023-06-10 12:55:49'),
(74, 63, 22, 1, '2023-06-10 12:57:49'),
(75, 63, 26, 1, '2023-06-10 12:57:49'),
(76, 64, 23, 1, '2023-06-10 12:58:39'),
(77, 64, 25, 1, '2023-06-10 12:58:39'),
(78, 65, 3, 1, '2023-06-10 13:14:14'),
(79, 65, 4, 1, '2023-06-10 13:14:14'),
(80, 66, 3, 1, '2023-06-10 13:19:25'),
(81, 66, 6, 1, '2023-06-10 13:19:25'),
(82, 67, 12, 1, '2023-06-10 13:27:20'),
(83, 68, 11, 1, '2023-06-10 13:32:20'),
(84, 69, 13, 1, '2023-06-10 13:40:08'),
(85, 70, 16, 1, '2023-06-10 13:52:07'),
(86, 70, 21, 1, '2023-06-10 13:52:07'),
(87, 71, 15, 1, '2023-06-10 13:54:22'),
(88, 71, 19, 1, '2023-06-10 13:54:22'),
(89, 72, 16, 1, '2023-06-10 13:57:45'),
(90, 72, 18, 1, '2023-06-10 13:57:45'),
(91, 73, 3, 1, '2023-06-11 15:32:56'),
(92, 73, 6, 1, '2023-06-11 15:32:56');

-- --------------------------------------------------------

--
-- Struttura della tabella `Dettaglio_ordine`
--

DROP TABLE IF EXISTS `Dettaglio_ordine`;
CREATE TABLE IF NOT EXISTS `Dettaglio_ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` int(11) NOT NULL,
  `Articolo_id` int(11) NOT NULL,
  `Ordine_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Articolo_id` (`Articolo_id`),
  KEY `Ordine_id` (`Ordine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Dettaglio_ordine`
--

INSERT INTO `Dettaglio_ordine` (`Id`, `Tipo`, `Articolo_id`, `Ordine_id`, `Status`, `Timestamp`) VALUES
(34, 1, 57, 30, 0, '2023-06-09 16:43:58'),
(35, 1, 57, 31, 0, '2023-06-09 16:53:45'),
(36, 1, 57, 32, 0, '2023-06-09 16:54:12'),
(37, 1, 61, 33, 0, '2023-06-11 15:28:35'),
(38, 1, 73, 34, 3, '2023-06-11 15:34:29'),
(39, 1, 73, 35, 3, '2023-06-11 15:35:49'),
(40, 1, 73, 36, 3, '2023-06-11 15:37:14'),
(41, 1, 73, 37, 3, '2023-06-11 15:38:02'),
(42, 1, 73, 38, 3, '2023-06-11 15:40:31'),
(43, 1, 73, 39, 0, '2023-06-11 15:43:45'),
(44, 1, 73, 39, 0, '2023-06-11 15:43:45'),
(45, 1, 70, 40, 0, '2023-06-11 15:44:25'),
(46, 1, 70, 40, 0, '2023-06-11 15:44:25'),
(47, 1, 73, 41, 0, '2023-06-11 16:31:25'),
(48, 1, 72, 42, 0, '2023-06-11 16:33:47'),
(49, 1, 73, 43, 0, '2023-06-11 16:42:19'),
(50, 1, 66, 44, 0, '2023-06-11 16:42:57'),
(51, 1, 73, 45, 0, '2023-06-11 16:46:18'),
(52, 1, 73, 46, 0, '2023-06-11 16:47:25'),
(53, 1, 72, 47, 0, '2023-06-11 16:48:03');

-- --------------------------------------------------------

--
-- Struttura della tabella `Dimensione`
--

DROP TABLE IF EXISTS `Dimensione`;
CREATE TABLE IF NOT EXISTS `Dimensione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dim_X` varchar(100) NOT NULL,
  `Dim_Y` varchar(100) NOT NULL,
  `Dim_Z` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Dimensione`
--

INSERT INTO `Dimensione` (`Id`, `Dim_X`, `Dim_Y`, `Dim_Z`, `Timestamp`) VALUES
(5, '1', '1', '1', '2023-06-09 16:35:38');

-- --------------------------------------------------------

--
-- Struttura della tabella `Fattura`
--

DROP TABLE IF EXISTS `Fattura`;
CREATE TABLE IF NOT EXISTS `Fattura` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dettaglio_ordine_id` int(11) NOT NULL,
  `Imponibile` decimal(7,0) NOT NULL,
  `Totale` decimal(10,0) NOT NULL,
  `Status` int(2) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Dettaglio_ordine_id` (`Dettaglio_ordine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Fattura`
--

INSERT INTO `Fattura` (`Id`, `Dettaglio_ordine_id`, `Imponibile`, `Totale`, `Status`, `Timestamp`) VALUES
(1, 34, '27', '35', 0, '2023-06-09 16:43:58'),
(2, 35, '27', '35', 0, '2023-06-09 16:53:45'),
(3, 36, '27', '35', 0, '2023-06-09 16:54:12'),
(4, 37, '31', '40', 0, '2023-06-11 15:28:35'),
(5, 43, '62', '80', 0, '2023-06-11 15:43:45'),
(6, 44, '62', '80', 0, '2023-06-11 15:43:45'),
(7, 45, '27', '35', 0, '2023-06-11 15:44:25'),
(8, 46, '27', '35', 0, '2023-06-11 15:44:25'),
(9, 47, '62', '80', 0, '2023-06-11 16:31:25'),
(10, 48, '33', '42', 0, '2023-06-11 16:33:47'),
(11, 49, '62', '80', 0, '2023-06-11 16:42:20'),
(12, 50, '17', '22', 0, '2023-06-11 16:42:57'),
(13, 51, '62', '80', 0, '2023-06-11 16:46:18'),
(14, 52, '62', '80', 0, '2023-06-11 16:47:25'),
(15, 53, '33', '42', 0, '2023-06-11 16:48:03');

-- --------------------------------------------------------

--
-- Struttura della tabella `Forma_di_pagamento`
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Forma_di_pagamento`
--

INSERT INTO `Forma_di_pagamento` (`Id`, `Circuito`, `Numero_carta`, `Data_scadenza`, `CVV`, `Tipo_di_pagamento`, `Utente_id`, `Status`, `Timestamp`) VALUES
(14, 'Unknown', '12345678909876543212', '2030-12-12', 123, 1, 50, 0, '2023-06-09 15:49:37'),
(15, 'Unknown', '12345678909876543212', '2030-12-12', 123, 1, 53, 0, '2023-06-11 16:31:17'),
(16, 'Unknown', '12345678909876543212', '2040-02-12', 123, 1, 54, 0, '2023-06-11 16:33:19');

-- --------------------------------------------------------

--
-- Struttura della tabella `Indirizzo`
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Indirizzo`
--

INSERT INTO `Indirizzo` (`Id`, `Via`, `Numero_civico`, `Citta`, `CAP`, `Status`, `Timestamp`) VALUES
(1, 'unset', 0, 'unset', 0, 0, '2023-06-09 15:47:33'),
(2, 'Roma', 1, 'Roma', 12345, 0, '2023-06-09 15:49:15'),
(3, 'Ancona', 10, 'Rimini', 12345, 1, '2023-06-09 16:33:25'),
(4, 'Pascoli', 12, 'RImini', 12345, 1, '2023-06-09 16:33:25'),
(5, 'Franci', 104, 'Mercatino', 48000, 0, '2023-06-11 16:30:55'),
(6, 'Baldassarri', 2, 'Rimini', 47111, 0, '2023-06-11 16:32:58');

-- --------------------------------------------------------

--
-- Struttura della tabella `Magazzino`
--

DROP TABLE IF EXISTS `Magazzino`;
CREATE TABLE IF NOT EXISTS `Magazzino` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Metri_cubi` double NOT NULL,
  `Indirizzo_id` int(11) NOT NULL,
  `Tassa` decimal(10,0) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Indirizzo_id` (`Indirizzo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Magazzino`
--

INSERT INTO `Magazzino` (`Id`, `Metri_cubi`, `Indirizzo_id`, `Tassa`, `Status`, `Timestamp`) VALUES
(1, 2000, 3, '3', 1, '2023-06-09 16:34:18'),
(2, 3000, 4, '4', 1, '2023-06-09 16:34:18');

-- --------------------------------------------------------

--
-- Struttura della tabella `Opzione_variazione`
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Opzione_variazione`
--

INSERT INTO `Opzione_variazione` (`Id`, `Valore`, `Variazione_id`, `Status`, `Timestamp`) VALUES
(1, 'S', 1, 1, '2023-06-09 16:32:07'),
(2, 'M', 1, 1, '2023-06-09 16:32:07'),
(3, 'L', 1, 1, '2023-06-09 16:32:07'),
(4, 'Bianco', 2, 1, '2023-06-09 16:32:07'),
(5, 'Nero', 2, 1, '2023-06-09 16:32:07'),
(6, 'Mixed', 2, 1, '2023-06-09 16:32:07'),
(7, 'S', 3, 1, '2023-06-09 16:32:07'),
(8, 'M', 3, 1, '2023-06-09 16:32:07'),
(9, 'L', 3, 1, '2023-06-09 16:32:07'),
(10, '42', 4, 1, '2023-06-09 16:32:07'),
(11, '43', 4, 1, '2023-06-09 16:32:07'),
(12, '44', 4, 1, '2023-06-09 16:32:07'),
(13, '45', 4, 1, '2023-06-09 16:32:07'),
(14, 'S', 5, 1, '2023-06-09 16:32:07'),
(15, 'M', 5, 1, '2023-06-09 16:32:07'),
(16, 'L', 5, 1, '2023-06-09 16:32:07'),
(17, 'Bianco', 6, 1, '2023-06-09 16:32:07'),
(18, 'Nero', 6, 1, '2023-06-09 16:32:07'),
(19, 'Rosso', 6, 1, '2023-06-09 16:32:07'),
(20, 'Blu', 6, 1, '2023-06-09 16:32:07'),
(21, 'Mixed', 6, 1, '2023-06-09 16:32:07'),
(22, 'M', 7, 1, '2023-06-09 16:32:07'),
(23, 'L', 7, 1, '2023-06-09 16:32:07'),
(24, 'Nero', 8, 1, '2023-06-09 16:32:07'),
(25, 'Bianco', 8, 1, '2023-06-09 16:32:07'),
(26, 'Mixed', 8, 1, '2023-06-10 12:56:54');

-- --------------------------------------------------------

--
-- Struttura della tabella `Ordine`
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Ordine`
--

INSERT INTO `Ordine` (`Id`, `Data_ordine`, `Tot_ordine`, `Status`, `Metodo_di_spedizione`, `Forma_di_pag_id`, `Timestamp`) VALUES
(29, '2023-06-09', '35', 0, 1, 14, '2023-06-09 16:41:29'),
(30, '2023-06-09', '35', 0, 1, 14, '2023-06-09 16:43:58'),
(31, '2023-06-09', '35', 0, 1, 14, '2023-06-09 16:53:45'),
(32, '2023-06-09', '35', 0, 1, 14, '2023-06-09 16:54:12'),
(33, '2023-06-11', '40', 0, 1, 14, '2023-06-11 15:28:35'),
(34, '2023-06-11', '160', 1, 1, 14, '2023-06-11 15:34:29'),
(35, '2023-06-11', '160', 1, 1, 14, '2023-06-11 15:35:49'),
(36, '2023-06-11', '160', 1, 1, 14, '2023-06-11 15:37:14'),
(37, '2023-06-11', '160', 1, 1, 14, '2023-06-11 15:38:02'),
(38, '2023-06-11', '160', 1, 1, 14, '2023-06-11 15:40:31'),
(39, '2023-06-11', '160', 0, 1, 14, '2023-06-11 15:43:45'),
(40, '2023-06-11', '70', 0, 1, 14, '2023-06-11 15:44:25'),
(41, '2023-06-11', '80', 0, 1, 15, '2023-06-11 16:31:25'),
(42, '2023-06-11', '42', 0, 1, 16, '2023-06-11 16:33:47'),
(43, '2023-06-11', '80', 0, 1, 16, '2023-06-11 16:42:19'),
(44, '2023-06-11', '22', 0, 1, 16, '2023-06-11 16:42:57'),
(45, '2023-06-11', '80', 0, 1, 16, '2023-06-11 16:46:18'),
(46, '2023-06-11', '80', 0, 1, 16, '2023-06-11 16:47:25'),
(47, '2023-06-11', '42', 0, 1, 16, '2023-06-11 16:48:03');

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto`
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
  KEY `Categoria_id` (`Categoria_id`),
  KEY `Dim_id` (`Dim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Prodotto`
--

INSERT INTO `Prodotto` (`Id`, `Nome`, `Descrizione`, `Immagine`, `Dim_id`, `Categoria_id`, `Status`, `Timestamp`) VALUES
(32, 'Jeans classici', 'Jeans classici, comodi e facilmente lavabili', 'jeans_chiari.jpg', 5, 2, 1, '2023-06-09 16:38:42'),
(33, 'Maglietta easy', 'Maglietta da indossare in qualunque situazione', 'maglia_nera.png', 5, 1, 1, '2023-06-10 12:48:52'),
(34, 'Pantaloni Rossi - Donna', 'Pantaloni comodi ed eleganti', 'pantaloni_rossi.jpg', 5, 2, 1, '2023-06-10 12:52:19'),
(35, 'Jeans scuri', 'Jeans scuri, facilmente lavabili', 'jeans_scuri.jpg', 5, 2, 1, '2023-06-10 12:54:04'),
(36, 'Cappello da pescatore', 'Cappello alla moda', 'cappello_03.jpeg', 5, 5, 1, '2023-06-10 12:55:33'),
(37, 'Cappello invernale', 'Caldo, comodo', 'cappello_02.jpeg', 5, 5, 1, '2023-06-10 12:57:37'),
(38, 'Cappello copri sole', 'Cappello classico', 'cappello_01.jpeg', 5, 5, 1, '2023-06-10 12:58:21'),
(39, 'T-shirt Easy', 'Maglietta bianca classica', 't-shirt_bianca.jpg', 5, 1, 1, '2023-06-10 13:10:38'),
(40, 'T-shirt japanese', 'Basic t-shirt', 't-shirt_mixed.jpg', 5, 1, 1, '2023-06-10 13:19:11'),
(41, 'Geox, scarpe da lavoro', 'Scarpe comodo per lavorare', 'scarpe_03.jpeg', 5, 3, 1, '2023-06-10 13:22:22'),
(42, 'Infradito Rosse', 'Infradito comode da indossare ', 'ciabatte_rosse.jpeg', 5, 3, 1, '2023-06-10 13:32:03'),
(43, 'Scarpe da ginnastica', 'Perfette per qualsiasi attività sportiva', 'sport-shoes.jpg', 5, 3, 1, '2023-06-10 13:39:51'),
(44, 'Felpa Nike sportiva', 'Comoda e facilmente lavabile', 'felpa_02.jpeg', 5, 4, 1, '2023-06-10 13:51:51'),
(45, 'Felpa con cappuccio rossa - Uomo', 'Felpa con cappuccio, stile classico', 'felpa_03.jpeg', 5, 4, 1, '2023-06-10 13:54:07'),
(46, 'Felpa nera classica', 'Felpa nera con cappuccio', 'felpa-nike-nera.jpg', 5, 4, 1, '2023-06-10 13:57:30'),
(47, 'Canotta Originale MJ 23', 'Canotta sportiva, Michael Jordan 23', 'MJ23.jpeg', 5, 1, 1, '2023-06-11 15:32:36');

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto_in_raccolta`
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Raccolta`
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Raccolta`
--

INSERT INTO `Raccolta` (`Id`, `Tipo_raccolta`, `Titolo`, `Utente_id`, `Status`, `Timestamp`) VALUES
(34, 1, 'whislist', 50, 0, '2023-06-09 15:47:57'),
(35, 1, 'whislist', 51, 0, '2023-06-09 15:50:09'),
(36, 1, 'whislist', 52, 0, '2023-06-11 15:30:02'),
(37, 1, 'whislist', 53, 0, '2023-06-11 16:30:13'),
(38, 1, 'whislist', 54, 0, '2023-06-11 16:32:28');

-- --------------------------------------------------------

--
-- Struttura della tabella `Recensione`
--

DROP TABLE IF EXISTS `Recensione`;
CREATE TABLE IF NOT EXISTS `Recensione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Valutazione` int(5) NOT NULL,
  `Commento` varchar(300) NOT NULL,
  `Dettaglio_ordine_id` int(11) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Dettaglio_ordine_id` (`Dettaglio_ordine_id`),
  KEY `Prodotto_id` (`Prodotto_id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Recensione`
--

INSERT INTO `Recensione` (`Id`, `Valutazione`, `Commento`, `Dettaglio_ordine_id`, `Utente_id`, `Prodotto_id`, `Status`, `Timestamp`) VALUES
(1, 5, 'Bel prodotto, consigliato :)', 35, 50, 32, 0, '2023-06-09 16:54:45');

-- --------------------------------------------------------

--
-- Struttura della tabella `Reso`
--

DROP TABLE IF EXISTS `Reso`;
CREATE TABLE IF NOT EXISTS `Reso` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dettaglio_ordine_id` int(11) NOT NULL,
  `Motivo` varchar(1000) NOT NULL,
  `Descrizione` varchar(1000) NOT NULL,
  `Status` int(2) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Dettaglio_ordine_id` (`Dettaglio_ordine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
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
  KEY `Claim_id` (`Claim_id`),
  KEY `Indirizzo_id` (`Indirizzo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Utente`
--

INSERT INTO `Utente` (`Id`, `Nome`, `Cognome`, `Email`, `Password`, `Claim_id`, `Indirizzo_id`, `Status`, `Timestamp`) VALUES
(50, 'endri', 'domi', 'endri.domi@takeit.it', 'takeit', 105, 2, 0, '2023-06-09 15:47:57'),
(51, 'Federico', 'Brunelli', 'fede.bruno@takeit.it', 'takeit', 106, 1, 0, '2023-06-09 15:50:09'),
(52, 'Giacomo', 'Fiolani', 'fiolani@takeit.it', 'takeit', 107, 1, 0, '2023-06-11 15:30:02'),
(53, 'Carla', 'Bernardi', 'bernardi@takeit.it', 'takeit', 108, 5, 0, '2023-06-11 16:30:13'),
(54, 'Simona', 'Caldari', 'caldari@takeit.it', 'takeit', 109, 6, 0, '2023-06-11 16:32:28');

-- --------------------------------------------------------

--
-- Struttura della tabella `Variazione`
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Variazione`
--

INSERT INTO `Variazione` (`Id`, `Nome`, `Categoria_id`, `Status`, `Timestamp`) VALUES
(1, 'Taglia T-shirt', 1, 1, '2023-06-09 16:23:52'),
(2, 'Colore T-shirt', 1, 1, '2023-06-09 16:23:52'),
(3, 'Taglia Pantaloni', 2, 1, '2023-06-09 16:23:52'),
(4, 'Taglia Scarpe', 3, 1, '2023-06-09 16:23:52'),
(5, 'Taglia Felpa', 4, 1, '2023-06-09 16:23:52'),
(6, 'Colore Felpa', 4, 1, '2023-06-09 16:23:52'),
(7, 'Taglia Cappello', 5, 1, '2023-06-09 16:23:52'),
(8, 'Colore Cappelllo', 5, 1, '2023-06-09 16:23:52');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Articolo`
--
ALTER TABLE `Articolo`
  ADD CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`Prodotto_id`) REFERENCES `Prodotto` (`Id`),
  ADD CONSTRAINT `articolo_ibfk_2` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

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
  ADD CONSTRAINT `articolo_in_magazzino_ibfk_1` FOREIGN KEY (`Magazzino_id`) REFERENCES `Magazzino` (`Id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limiti per la tabella `Carrello`
--
ALTER TABLE `Carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Configurazione_variazione`
--
ALTER TABLE `Configurazione_variazione`
  ADD CONSTRAINT `configurazione_variazione_ibfk_1` FOREIGN KEY (`Opzio_variazione_id`) REFERENCES `Opzione_variazione` (`Id`);

--
-- Limiti per la tabella `Dettaglio_ordine`
--
ALTER TABLE `Dettaglio_ordine`
  ADD CONSTRAINT `dettaglio_ordine_ibfk_1` FOREIGN KEY (`Articolo_id`) REFERENCES `Articolo` (`Id`),
  ADD CONSTRAINT `dettaglio_ordine_ibfk_2` FOREIGN KEY (`Ordine_id`) REFERENCES `Ordine` (`Id`);

--
-- Limiti per la tabella `Fattura`
--
ALTER TABLE `Fattura`
  ADD CONSTRAINT `fattura_ibfk_1` FOREIGN KEY (`Dettaglio_ordine_id`) REFERENCES `Dettaglio_ordine` (`Id`);

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
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`Categoria_id`) REFERENCES `Categoria` (`Id`),
  ADD CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`Dim_id`) REFERENCES `Dimensione` (`Id`);

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
  ADD CONSTRAINT `recensione_ibfk_2` FOREIGN KEY (`Prodotto_id`) REFERENCES `Prodotto` (`Id`),
  ADD CONSTRAINT `recensione_ibfk_3` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Reso`
--
ALTER TABLE `Reso`
  ADD CONSTRAINT `reso_ibfk_1` FOREIGN KEY (`Dettaglio_ordine_id`) REFERENCES `Dettaglio_ordine` (`Id`);

--
-- Limiti per la tabella `Utente`
--
ALTER TABLE `Utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`Claim_id`) REFERENCES `Claim` (`Id`),
  ADD CONSTRAINT `utente_ibfk_2` FOREIGN KEY (`Indirizzo_id`) REFERENCES `Indirizzo` (`Id`);

--
-- Limiti per la tabella `Variazione`
--
ALTER TABLE `Variazione`
  ADD CONSTRAINT `variazione_ibfk_1` FOREIGN KEY (`Categoria_id`) REFERENCES `Categoria` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
