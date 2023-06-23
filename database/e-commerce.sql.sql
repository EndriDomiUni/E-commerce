-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Giu 23, 2023 alle 12:40
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
-- Struttura della tabella `Claim`
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
