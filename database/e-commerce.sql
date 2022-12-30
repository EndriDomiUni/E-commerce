-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 30, 2022 alle 17:13
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

DROP TABLE IF EXISTS `carrello`;
CREATE TABLE IF NOT EXISTS `carrello` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Ammontare` int(20) UNSIGNED NOT NULL,
  `Quantità` int(20) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `catalogo`
--

DROP TABLE IF EXISTS `catalogo`;
CREATE TABLE IF NOT EXISTS `catalogo` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Prodotto_id` int(11) NOT NULL,
  `Variazione_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `claim`
--

DROP TABLE IF EXISTS `claim`;
CREATE TABLE IF NOT EXISTS `claim` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(150) NOT NULL,
  `Valore` int(10) NOT NULL,
  `Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`Id`, `Nome`, `Cognome`, `Email`, `Password`, `Status`, `Timestamp`) VALUES
(0, 'prima', 'prova', 'prima.prova@fakemail.it', 'primaprova', 1, '2022-12-22 17:24:24'),
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
-- Struttura della tabella `configurazione_variazione`
--

DROP TABLE IF EXISTS `configurazione_variazione`;
CREATE TABLE IF NOT EXISTS `configurazione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Variazione_id` int(11) NOT NULL,
  `Opzio_variazione_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Variazione_id` (`Variazione_id`),
  KEY `Opzio_variazione_id` (`Opzio_variazione_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `corriere`
--

DROP TABLE IF EXISTS `corriere`;
CREATE TABLE IF NOT EXISTS `corriere` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(30) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `dettaglio_ordine`
--

DROP TABLE IF EXISTS `dettaglio_ordine`;
CREATE TABLE IF NOT EXISTS `dettaglio_ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ordine_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Ordine_id` (`Ordine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `forma_di_pagamento`
--

DROP TABLE IF EXISTS `forma_di_pagamento`;
CREATE TABLE IF NOT EXISTS `forma_di_pagamento` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `galleria immagini`
--

DROP TABLE IF EXISTS `galleria immagini`;
CREATE TABLE IF NOT EXISTS `galleria immagini` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdProdotto` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

DROP TABLE IF EXISTS `immagine`;
CREATE TABLE IF NOT EXISTS `immagine` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Risorsa` varchar(30) NOT NULL,
  `IdGalleriaImmagini` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdGalleriaImmagini` (`IdGalleriaImmagini`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  PRIMARY KEY (`Id`),
  KEY `Ordine_id` (`Ordine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `opzione_variazione`
--

DROP TABLE IF EXISTS `opzione_variazione`;
CREATE TABLE IF NOT EXISTS `opzione_variazione` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Valore` varchar(50) NOT NULL,
  `Status` int(6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

DROP TABLE IF EXISTS `ordine`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE IF NOT EXISTS `pagamento` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdOrdine` int(10) UNSIGNED NOT NULL,
  `Data` date NOT NULL,
  `Importo` int(30) UNSIGNED NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

DROP TABLE IF EXISTS `prodotto`;
CREATE TABLE IF NOT EXISTS `prodotto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(50) NOT NULL,
  `Immagine` varchar(50) NOT NULL,
  `Dim_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Dim_id` (`Dim_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `raccolta`
--

DROP TABLE IF EXISTS `raccolta`;
CREATE TABLE IF NOT EXISTS `raccolta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_raccolta` varchar(50) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Utente_id` (`Utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `spedizione`
--

DROP TABLE IF EXISTS `spedizione`;
CREATE TABLE IF NOT EXISTS `spedizione` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdOrdine` int(10) UNSIGNED NOT NULL,
  `DataSpedizione` date NOT NULL,
  `LuogoSpedizione` varchar(30) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `IdOrdine` (`IdOrdine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `status ordine`
--

DROP TABLE IF EXISTS `status ordine`;
CREATE TABLE IF NOT EXISTS `status ordine` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `status_ordine`
--

DROP TABLE IF EXISTS `status_ordine`;
CREATE TABLE IF NOT EXISTS `status_ordine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ordine_id` int(11) NOT NULL,
  `Valore` int(7) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_di_pagamento`
--

DROP TABLE IF EXISTS `tipo_di_pagamento`;
CREATE TABLE IF NOT EXISTS `tipo_di_pagamento` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Valore` int(11) NOT NULL,
  `Fk_for_pag_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Fk_for_pag_id` (`Fk_for_pag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `variazioni`
--

DROP TABLE IF EXISTS `variazioni`;
CREATE TABLE IF NOT EXISTS `variazioni` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore`
--

DROP TABLE IF EXISTS `venditore`;
CREATE TABLE IF NOT EXISTS `venditore` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Ragione_Sociale` varchar(25) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `P_IVA` int(20) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `venditore`
--

INSERT INTO `venditore` (`Id`, `Nome`, `Cognome`, `Ragione_Sociale`, `Email`, `Password`, `P_IVA`, `Status`, `Timestamp`) VALUES
(0, 'primaV', 'primaV', 'primaVprova', 'primaVprova@fakemail.com', 'primaVprova', 0, 1, '2022-12-22 18:18:29');

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
