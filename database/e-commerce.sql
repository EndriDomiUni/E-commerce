-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 29, 2022 alle 22:21
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
-- Creazione: Dic 29, 2022 alle 20:58
--

DROP TABLE IF EXISTS `Articolo`;
CREATE TABLE IF NOT EXISTS `Articolo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Prezzo` double NOT NULL,
  `Quantita` int(10) NOT NULL,
  `Carrello_id` int(11) NOT NULL,
  `Dettaglio_ord_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  `Conf_variaz_id` int(11) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Carrello_id` (`Carrello_id`),
  KEY `Prodotto_id` (`Prodotto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Articolo`:
--   `Carrello_id`
--       `Carrello` -> `Id`
--   `Prodotto_id`
--       `Prodotto` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Carrello`
--
-- Creazione: Dic 29, 2022 alle 21:02
--

DROP TABLE IF EXISTS `Carrello`;
CREATE TABLE IF NOT EXISTS `Carrello` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Utente_id` int(11) NOT NULL,
  `Status` int(10) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Carrello`:
--   `Utente_id`
--       `Utente` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Categoria`
--
-- Creazione: Dic 29, 2022 alle 21:11
--

DROP TABLE IF EXISTS `Categoria`;
CREATE TABLE IF NOT EXISTS `Categoria` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(150) NOT NULL,
  `Status` int(7) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  `Variazione_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Categoria`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Claim`
--
-- Creazione: Dic 29, 2022 alle 20:16
--

DROP TABLE IF EXISTS `Claim`;
CREATE TABLE IF NOT EXISTS `Claim` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(150) NOT NULL,
  `Valore` int(10) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Claim`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Configurazione_variazione`
--
-- Creazione: Dic 29, 2022 alle 21:17
--

DROP TABLE IF EXISTS `Configurazione_variazione`;
CREATE TABLE IF NOT EXISTS `Configurazione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Variazione_id` int(11) NOT NULL,
  `Opzio_variazione_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Variazione_id` (`Variazione_id`),
  KEY `Opzio_variazione_id` (`Opzio_variazione_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Configurazione_variazione`:
--   `Variazione_id`
--       `Variazioni` -> `Id`
--   `Opzio_variazione_id`
--       `Opzione_variazione` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Dettaglio_ordine`
--
-- Creazione: Dic 29, 2022 alle 21:20
--

DROP TABLE IF EXISTS `Dettaglio_ordine`;
CREATE TABLE IF NOT EXISTS `Dettaglio_ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ordine_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Ordine_id` (`Ordine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Dettaglio_ordine`:
--   `Ordine_id`
--       `Ordine` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Dimensione`
--
-- Creazione: Dic 29, 2022 alle 20:50
--

DROP TABLE IF EXISTS `Dimensione`;
CREATE TABLE IF NOT EXISTS `Dimensione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dim_X` int(7) NOT NULL,
  `Dim_Y` int(7) NOT NULL,
  `Dim_Z` int(7) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Dimensione`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Forma_di_pagamento`
--
-- Creazione: Dic 29, 2022 alle 20:35
--

DROP TABLE IF EXISTS `Forma_di_pagamento`;
CREATE TABLE IF NOT EXISTS `Forma_di_pagamento` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Circuito` varchar(20) NOT NULL,
  `Numero_carta` varchar(20) NOT NULL,
  `Data_scadenza` varchar(5) NOT NULL,
  `CV2` int(3) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Utente_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Forma_di_pagamento`:
--   `Utente_id`
--       `Utente` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Indirizzo`
--
-- Creazione: Dic 29, 2022 alle 20:46
--

DROP TABLE IF EXISTS `Indirizzo`;
CREATE TABLE IF NOT EXISTS `Indirizzo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Via` varchar(150) NOT NULL,
  `Numero_civico` int(10) NOT NULL,
  `Citta` varchar(50) NOT NULL,
  `CAP` int(5) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Indirizzo`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Magazzino`
--
-- Creazione: Dic 29, 2022 alle 21:09
--

DROP TABLE IF EXISTS `Magazzino`;
CREATE TABLE IF NOT EXISTS `Magazzino` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Metri_cubi` int(7) NOT NULL,
  `Status` int(7) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Indirizzo_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Indirizzo_id` (`Indirizzo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Magazzino`:
--   `Indirizzo_id`
--       `Indirizzo` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Metodo_spedizione`
--
-- Creazione: Dic 29, 2022 alle 21:06
--

DROP TABLE IF EXISTS `Metodo_spedizione`;
CREATE TABLE IF NOT EXISTS `Metodo_spedizione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Prezzo` int(7) NOT NULL,
  `Ordine_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Ordine_id` (`Ordine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Metodo_spedizione`:
--   `Ordine_id`
--       `Ordine` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Opzione_variazione`
--
-- Creazione: Dic 29, 2022 alle 21:16
--

DROP TABLE IF EXISTS `Opzione_variazione`;
CREATE TABLE IF NOT EXISTS `Opzione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Valore` varchar(50) NOT NULL,
  `Status` int(6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Opzione_variazione`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Ordine`
--
-- Creazione: Dic 29, 2022 alle 21:01
--

DROP TABLE IF EXISTS `Ordine`;
CREATE TABLE IF NOT EXISTS `Ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Forma_pag_id` int(11) NOT NULL,
  `Data_ordine` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Tot_ordine` int(7) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Forma_pag_id` (`Forma_pag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Ordine`:
--   `Forma_pag_id`
--       `Forma_di_pagamento` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto`
--
-- Creazione: Dic 29, 2022 alle 20:57
--

DROP TABLE IF EXISTS `Prodotto`;
CREATE TABLE IF NOT EXISTS `Prodotto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(50) NOT NULL,
  `Immagine` varchar(50) NOT NULL,
  `Dim_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Dim_id` (`Dim_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Prodotto`:
--   `Dim_id`
--       `Dimensione` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto_in_raccolta`
--
-- Creazione: Dic 29, 2022 alle 21:18
--

DROP TABLE IF EXISTS `Prodotto_in_raccolta`;
CREATE TABLE IF NOT EXISTS `Prodotto_in_raccolta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Raccolta_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Prodotto_id` (`Prodotto_id`),
  KEY `Raccolta_id` (`Raccolta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Prodotto_in_raccolta`:
--   `Prodotto_id`
--       `Prodotto` -> `Id`
--   `Raccolta_id`
--       `Raccolta` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Raccolta`
--
-- Creazione: Dic 29, 2022 alle 20:41
--

DROP TABLE IF EXISTS `Raccolta`;
CREATE TABLE IF NOT EXISTS `Raccolta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_raccolta` varchar(50) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Raccolta`:
--   `Utente_id`
--       `Utente` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Status_ordine`
--
-- Creazione: Dic 29, 2022 alle 21:04
--

DROP TABLE IF EXISTS `Status_ordine`;
CREATE TABLE IF NOT EXISTS `Status_ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ordine_id` int(11) NOT NULL,
  `Valore` int(7) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Status_ordine`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Tipo_di_pagamento`
--
-- Creazione: Dic 29, 2022 alle 20:38
--

DROP TABLE IF EXISTS `Tipo_di_pagamento`;
CREATE TABLE IF NOT EXISTS `Tipo_di_pagamento` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Valore` int(11) NOT NULL,
  `Fk_for_pag_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Fk_for_pag_id` (`Fk_for_pag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Tipo_di_pagamento`:
--   `Fk_for_pag_id`
--       `Forma_di_pagamento` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--
-- Creazione: Dic 29, 2022 alle 20:47
--

DROP TABLE IF EXISTS `Utente`;
CREATE TABLE IF NOT EXISTS `Utente` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Claim_id` int(11) NOT NULL,
  `Indirizzo_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Claim_id` (`Claim_id`),
  KEY `Indirizzo_id` (`Indirizzo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Utente`:
--   `Indirizzo_id`
--       `Indirizzo` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Variazioni`
--
-- Creazione: Dic 29, 2022 alle 21:15
--

DROP TABLE IF EXISTS `Variazioni`;
CREATE TABLE IF NOT EXISTS `Variazioni` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `Variazioni`:
--

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Articolo`
--
ALTER TABLE `Articolo`
  ADD CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`Carrello_id`) REFERENCES `Carrello` (`Id`),
  ADD CONSTRAINT `articolo_ibfk_2` FOREIGN KEY (`Prodotto_id`) REFERENCES `Prodotto` (`Id`);

--
-- Limiti per la tabella `Carrello`
--
ALTER TABLE `Carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Configurazione_variazione`
--
ALTER TABLE `Configurazione_variazione`
  ADD CONSTRAINT `configurazione_variazione_ibfk_1` FOREIGN KEY (`Variazione_id`) REFERENCES `Variazioni` (`Id`),
  ADD CONSTRAINT `configurazione_variazione_ibfk_2` FOREIGN KEY (`Opzio_variazione_id`) REFERENCES `Opzione_variazione` (`Id`);

--
-- Limiti per la tabella `Dettaglio_ordine`
--
ALTER TABLE `Dettaglio_ordine`
  ADD CONSTRAINT `dettaglio_ordine_ibfk_1` FOREIGN KEY (`Ordine_id`) REFERENCES `Ordine` (`Id`);

--
-- Limiti per la tabella `Forma_di_pagamento`
--
ALTER TABLE `Forma_di_pagamento`
  ADD CONSTRAINT `Utente_id` FOREIGN KEY (`Utente_id`) REFERENCES `Utente` (`Id`);

--
-- Limiti per la tabella `Magazzino`
--
ALTER TABLE `Magazzino`
  ADD CONSTRAINT `magazzino_ibfk_1` FOREIGN KEY (`Indirizzo_id`) REFERENCES `Indirizzo` (`Id`);

--
-- Limiti per la tabella `Metodo_spedizione`
--
ALTER TABLE `Metodo_spedizione`
  ADD CONSTRAINT `metodo_spedizione_ibfk_1` FOREIGN KEY (`Ordine_id`) REFERENCES `Ordine` (`Id`);

--
-- Limiti per la tabella `Ordine`
--
ALTER TABLE `Ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`Forma_pag_id`) REFERENCES `Forma_di_pagamento` (`Id`);

--
-- Limiti per la tabella `Prodotto`
--
ALTER TABLE `Prodotto`
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`Dim_id`) REFERENCES `Dimensione` (`Id`);

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
-- Limiti per la tabella `Tipo_di_pagamento`
--
ALTER TABLE `Tipo_di_pagamento`
  ADD CONSTRAINT `tipo_di_pagamento_ibfk_1` FOREIGN KEY (`Fk_for_pag_id`) REFERENCES `Forma_di_pagamento` (`Id`);

--
-- Limiti per la tabella `Utente`
--
ALTER TABLE `Utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`Indirizzo_id`) REFERENCES `Indirizzo` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
