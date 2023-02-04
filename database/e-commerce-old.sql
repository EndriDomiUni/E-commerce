-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 02, 2023 alle 16:18
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

DROP TABLE IF EXISTS `Articolo`;
CREATE TABLE IF NOT EXISTS `Articolo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Prezzo` decimal(11,0) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Prodotto_id` (`Prodotto_id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo_in_magazzino`
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

DROP TABLE IF EXISTS `Carrello`;
CREATE TABLE IF NOT EXISTS `Carrello` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Utente_id` int(11) NOT NULL,
  `Status` int(4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(77, 4, 0, '2023-02-02 09:36:53');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Claim`
--

INSERT INTO `Claim` (`Id`, `Descrizione`, `Conto`, `Status`, `Timestamp`) VALUES
(55, 'user', '0', 0, '2023-01-31 15:35:38'),
(56, 'seller', '0', 0, '2023-01-31 15:38:04'),
(57, 'seller', '0', 0, '2023-02-02 08:32:19'),
(58, 'user', '0', 0, '2023-02-02 13:44:59');

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
  KEY `Opzio_variazione_id` (`Opzio_variazione_id`),
  KEY `Articolo_id` (`Articolo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Dettaglio_ordine`
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

DROP TABLE IF EXISTS `Dimensione`;
CREATE TABLE IF NOT EXISTS `Dimensione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dim_X` decimal(11,0) NOT NULL,
  `Dim_Y` decimal(11,0) NOT NULL,
  `Dim_Z` decimal(11,0) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Utente`
--

INSERT INTO `Utente` (`Id`, `Nome`, `Cognome`, `Email`, `Password`, `Claim_id`, `Indirizzo_id`, `Status`, `Timestamp`) VALUES
(4, 'Endri', 'Domi', 'endri@takeit.com', 'takeit', 55, 3, 0, '2023-01-31 15:35:38'),
(5, 'Federico', 'Brunelli', 'fede@takeit.com', 'takeit', 56, 1, 0, '2023-01-31 15:38:04'),
(6, 'Chiara', 'Delmonte', 'chiara.delmonte@takeit.com', 'takeit', 57, 1, 0, '2023-02-02 08:32:19'),
(7, 'Mario', 'Rossi', 'mario@rossi.com', 'mariorossi', 58, 1, 0, '2023-02-02 13:44:59');

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
