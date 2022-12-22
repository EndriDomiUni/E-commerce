-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 22, 2022 alle 18:23
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
-- Struttura della tabella `carrello`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `carrello` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Ammontare` int(20) UNSIGNED NOT NULL,
  `Quantità` int(20) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `carrello`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `catalogo`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `catalogo` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `catalogo`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nome` varchar(30) NOT NULL,
  `Descrizione` varchar(30) NOT NULL,
  `IdCatalogo` int(10) UNSIGNED NOT NULL,
  `IdCategoriaPadre` int(10) UNSIGNED NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `categoria`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Cliente`
--
-- Creazione: Dic 22, 2022 alle 10:09
-- Ultimo aggiornamento: Dic 22, 2022 alle 17:20
--

CREATE TABLE IF NOT EXISTS `Cliente` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Cliente`:
--

--
-- Dump dei dati per la tabella `Cliente`
--

INSERT INTO `Cliente` (`Id`, `Nome`, `Cognome`, `Email`, `Password`, `Status`, `Timestamp`) VALUES
(1, 'Demo', 'Private', 'demo.private@test.com', '123456789', 1, '2022-12-22 14:34:39'),
(2, 'Demo2', 'Private2', 'demo.private2@test.com', '1234567890', 1, '2022-12-22 14:36:03'),
(3, 'Demo', 'Private', 'demo3@private.com', 'password', 1, '2022-12-22 15:35:27'),
(4, 'Demo3', 'Private3', 'demo3@private.com', '123456789', 1, '2022-12-22 15:39:00'),
(5, 'Test', 'Test', 'text@test.com', 'test', 1, '2022-12-22 15:43:38'),
(6, 'Test', 'Test', 'text@test.com', '12345678', 1, '2022-12-22 15:46:55'),
(7, 'Demo', 'Private', 'test@tesrt.com', '1234567890', 1, '2022-12-22 16:57:11'),
(8, 'Demo123', 'Private', 'test123@tesrt.com', '12347890', 1, '2022-12-22 17:20:23');

-- --------------------------------------------------------

--
-- Struttura della tabella `corriere`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `corriere` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(30) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `corriere`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `galleria immagini`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `galleria immagini` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdProdotto` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `galleria immagini`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `immagine` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Risorsa` varchar(30) NOT NULL,
  `IdGalleriaImmagini` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdGalleriaImmagini` (`IdGalleriaImmagini`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `immagine`:
--   `IdGalleriaImmagini`
--       `galleria immagini` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `ordine` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Carrello` int(10) UNSIGNED NOT NULL,
  `IdStatusOrdine` int(10) UNSIGNED NOT NULL,
  `Ammontare` int(11) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Carrello` (`Carrello`),
  KEY `IdStatusOrdine` (`IdStatusOrdine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `ordine`:
--   `Carrello`
--       `carrello` -> `Id`
--   `IdStatusOrdine`
--       `status ordine` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamento`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `pagamento` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdOrdine` int(10) UNSIGNED NOT NULL,
  `Data` date NOT NULL,
  `Importo` int(30) UNSIGNED NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `pagamento`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto`
--
-- Creazione: Nov 26, 2022 alle 15:38
--

CREATE TABLE IF NOT EXISTS `Prodotto` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(100) NOT NULL,
  `Prezzo` double NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Prodotto`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `spedizione`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `spedizione` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdOrdine` int(10) UNSIGNED NOT NULL,
  `DataSpedizione` date NOT NULL,
  `LuogoSpedizione` varchar(30) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `IdOrdine` (`IdOrdine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `spedizione`:
--   `IdOrdine`
--       `ordine` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `status ordine`
--
-- Creazione: Dic 22, 2022 alle 10:08
--

CREATE TABLE IF NOT EXISTS `status ordine` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `status ordine`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Venditore`
--
-- Creazione: Dic 22, 2022 alle 14:53
--

CREATE TABLE IF NOT EXISTS `Venditore` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Ragione_Sociale` varchar(25) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `P._IVA` int(20) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Venditore`:
--

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`IdGalleriaImmagini`) REFERENCES `galleria immagini` (`Id`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`Carrello`) REFERENCES `carrello` (`Id`),
  ADD CONSTRAINT `ordine_ibfk_2` FOREIGN KEY (`IdStatusOrdine`) REFERENCES `status ordine` (`Id`);

--
-- Limiti per la tabella `spedizione`
--
ALTER TABLE `spedizione`
  ADD CONSTRAINT `spedizione_ibfk_1` FOREIGN KEY (`IdOrdine`) REFERENCES `ordine` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
