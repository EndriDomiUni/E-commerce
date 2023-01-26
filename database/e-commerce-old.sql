-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 19, 2023 alle 18:38
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
-- Struttura della tabella `articolo`
--

DROP TABLE IF EXISTS `articolo`;
CREATE TABLE IF NOT EXISTS `articolo` (
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

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

DROP TABLE IF EXISTS `carrello`;
CREATE TABLE IF NOT EXISTS `carrello` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Utente_id` int(11) NOT NULL,
  `Status` int(10) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(150) NOT NULL,
  `Status` int(7) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Variazione_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Variazione_id` (`Variazione_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `claim`
--

DROP TABLE IF EXISTS `claim`;
CREATE TABLE IF NOT EXISTS `claim` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(150) NOT NULL,
  `Conto` int(10) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `claim`
--

INSERT INTO `claim` (`Id`, `Descrizione`, `Conto`, `Status`, `Timestamp`) VALUES
(1, 'Guest', 0, 0, '0000-00-00 00:00:00'),
(2, 'User', 1, 0, '0000-00-00 00:00:00'),
(3, 'Seller', 2, 0, '0000-00-00 00:00:00'),
(4, 'User pro', 3, 0, '0000-00-00 00:00:00'),
(5, 'Seller pro', 4, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `configurazione_variazione`
--

DROP TABLE IF EXISTS `configurazione_variazione`;
CREATE TABLE IF NOT EXISTS `configurazione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Variazione_id` int(11) NOT NULL,
  `Opzio_variazione_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Variazione_id` (`Variazione_id`),
  KEY `Opzio_variazione_id` (`Opzio_variazione_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `dettaglio_ordine`
--

DROP TABLE IF EXISTS `dettaglio_ordine`;
CREATE TABLE IF NOT EXISTS `dettaglio_ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ordine_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Ordine_id` (`Ordine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `dimensione`
--

DROP TABLE IF EXISTS `dimensione`;
CREATE TABLE IF NOT EXISTS `dimensione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dim_X` int(7) NOT NULL,
  `Dim_Y` int(7) NOT NULL,
  `Dim_Z` int(7) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `forma_di_pagamento`
--

DROP TABLE IF EXISTS `forma_di_pagamento`;
CREATE TABLE IF NOT EXISTS `forma_di_pagamento` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Circuito` varchar(20) NOT NULL,
  `Numero_carta` varchar(20) NOT NULL,
  `Data_scadenza` varchar(10) NOT NULL,
  `CVV` int(3) NOT NULL,
  `Tipo_di_pagam` int(1) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Utente_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

DROP TABLE IF EXISTS `indirizzo`;
CREATE TABLE IF NOT EXISTS `indirizzo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Via` varchar(150) NOT NULL,
  `Numero_civico` int(10) NOT NULL,
  `Citta` varchar(50) NOT NULL,
  `CAP` int(5) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`Id`, `Via`, `Numero_civico`, `Citta`, `CAP`, `Status`, `Timestamp`) VALUES
(1, 'Unset', 0, 'Unset', 0, 0, '2022-12-30 17:08:36'),
(2, 'Via Don Oreste Benzi', 1, 'Rimini', 47923, 0, '2022-12-31 13:57:45'),
(3, 'Via Rossi', 1, 'Roma', 11111, 0, '2022-12-31 14:32:01'),
(5, 'dsd', 1, 'ds', 11111, 0, '2022-12-31 14:34:31'),
(6, 'Via Don Oreste Benzi', 1, 'Rimini', 47832, 0, '2023-01-01 15:39:43');

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

DROP TABLE IF EXISTS `magazzino`;
CREATE TABLE IF NOT EXISTS `magazzino` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Metri_cubi` int(7) NOT NULL,
  `Status` int(7) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Indirizzo_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Indirizzo_id` (`Indirizzo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `metodo_spedizione`
--

DROP TABLE IF EXISTS `metodo_spedizione`;
CREATE TABLE IF NOT EXISTS `metodo_spedizione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Prezzo` int(7) NOT NULL,
  `Ordine_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Ordine_id` (`Ordine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `opzione_variazione`
--

DROP TABLE IF EXISTS `opzione_variazione`;
CREATE TABLE IF NOT EXISTS `opzione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Valore` varchar(50) NOT NULL,
  `Status` int(6) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

DROP TABLE IF EXISTS `ordine`;
CREATE TABLE IF NOT EXISTS `ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Forma_pag_id` int(11) NOT NULL,
  `Data_ordine` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Tot_ordine` int(7) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Forma_pag_id` (`Forma_pag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--+ value

-- Struttura della tabella `prodotto`
--

DROP TABLE IF EXISTS `prodotto`;
CREATE TABLE IF NOT EXISTS `prodotto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(50) NOT NULL,
  `Immagine` varchar(50) NOT NULL,
  `Dimensione_id` int(11) NOT NULL,
  `Categoria_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Dim_id` (`Dimensione_id`),
  KEY `Categoria_Id` (`Categoria_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_in_raccolta`
--

DROP TABLE IF EXISTS `prodotto_in_raccolta`;
CREATE TABLE IF NOT EXISTS `prodotto_in_raccolta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Raccolta_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Prodotto_id` (`Prodotto_id`),
  KEY `Raccolta_id` (`Raccolta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `raccolta`
--

DROP TABLE IF EXISTS `raccolta`;
CREATE TABLE IF NOT EXISTS `raccolta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_raccolta` varchar(50) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

DROP TABLE IF EXISTS `utente`;
CREATE TABLE IF NOT EXISTS `utente` (
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`Id`, `Nome`, `Cognome`, `Email`, `Password`, `Status`, `Timestamp`, `Claim_id`, `Indirizzo_id`) VALUES
(4, 'Endri', 'Domi', 'endri.domi@lasersoft.it', 'lasersoft', 1, '2023-01-01 15:39:43', 2, 6),
(5, 'Federico', 'Brunelli', 'federico.brunelli@lasersoft.it', 'lasersoft', 1, '2022-12-31 14:34:31', 2, 5),
(6, 'Alessandro', 'Pioggia', 'alessandro.pioggia@lasersoft.it', 'lasersoft', 1, '2022-12-31 14:34:31', 2, 5),
(7, 'Mario', 'Rossi', 'mario.rossi@takeit.com', 'takeit', 1, '2022-12-31 14:34:31', 2, 5),
(8, 'Marco', 'Pesaresi', 'marco.pesaresi@lasersoft.it', 'lasersoft', 0, '2023-01-01 15:38:45', 3, 1),
(9, 'Luca', 'Franci', 'luca.franci@lasersoft.it', 'lasersoft', 0, '2023-01-02 15:50:29', 3, 1),
(10, 'luca', 'balda', 'luca.balda@lasersoft.it', 'lasersoft', 0, '2023-01-02 15:59:28', 2, 1),
(11, 'antonio', 'piolanti', 'antonio.piolanti@lasersoft.it', 'lasersoft', 0, '2023-01-02 16:10:43', 3, 1),
(12, 'silvio', 'berlusconi', 'silvio.berlusconi@lasersoft.it', 'lasersoft', 0, '2023-01-02 16:15:55', 2, 1),
(13, 'Prova', 'Ficserror', 'prova.ficserror@lasersoft.it', 'lasersoft', 0, '2023-01-02 16:17:15', 3, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `variazione`
--

DROP TABLE IF EXISTS `variazione`;
CREATE TABLE IF NOT EXISTS `variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`Carrello_id`) REFERENCES `carrello` (`Id`),
  ADD CONSTRAINT `articolo_ibfk_2` FOREIGN KEY (`Prodotto_id`) REFERENCES `prodotto` (`Id`);

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`Utente_id`) REFERENCES `utente` (`Id`);

--
-- Limiti per la tabella `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`Variazione_id`) REFERENCES `variazione` (`Id`);

--
-- Limiti per la tabella `configurazione_variazione`
--
ALTER TABLE `configurazione_variazione`
  ADD CONSTRAINT `configurazione_variazione_ibfk_1` FOREIGN KEY (`Variazione_id`) REFERENCES `variazione` (`Id`),
  ADD CONSTRAINT `configurazione_variazione_ibfk_2` FOREIGN KEY (`Opzio_variazione_id`) REFERENCES `opzione_variazione` (`Id`);

--
-- Limiti per la tabella `dettaglio_ordine`
--
ALTER TABLE `dettaglio_ordine`
  ADD CONSTRAINT `dettaglio_ordine_ibfk_1` FOREIGN KEY (`Ordine_id`) REFERENCES `ordine` (`Id`);

--
-- Limiti per la tabella `forma_di_pagamento`
--
ALTER TABLE `forma_di_pagamento`
  ADD CONSTRAINT `Utente_id` FOREIGN KEY (`Utente_id`) REFERENCES `utente` (`Id`);

--
-- Limiti per la tabella `magazzino`
--
ALTER TABLE `magazzino`
  ADD CONSTRAINT `magazzino_ibfk_1` FOREIGN KEY (`Indirizzo_id`) REFERENCES `indirizzo` (`Id`);

--
-- Limiti per la tabella `metodo_spedizione`
--
ALTER TABLE `metodo_spedizione`
  ADD CONSTRAINT `metodo_spedizione_ibfk_1` FOREIGN KEY (`Ordine_id`) REFERENCES `ordine` (`Id`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`Forma_pag_id`) REFERENCES `forma_di_pagamento` (`Id`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`Dimensione_id`) REFERENCES `dimensione` (`Id`),
  ADD CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`Categoria_Id`) REFERENCES `categoria` (`Id`);

--
-- Limiti per la tabella `prodotto_in_raccolta`
--
ALTER TABLE `prodotto_in_raccolta`
  ADD CONSTRAINT `prodotto_in_raccolta_ibfk_1` FOREIGN KEY (`Prodotto_id`) REFERENCES `prodotto` (`Id`),
  ADD CONSTRAINT `prodotto_in_raccolta_ibfk_2` FOREIGN KEY (`Raccolta_id`) REFERENCES `raccolta` (`Id`);

--
-- Limiti per la tabella `raccolta`
--
ALTER TABLE `raccolta`
  ADD CONSTRAINT `raccolta_ibfk_1` FOREIGN KEY (`Utente_id`) REFERENCES `utente` (`Id`);

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`Indirizzo_id`) REFERENCES `indirizzo` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
