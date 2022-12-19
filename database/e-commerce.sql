-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 29, 2022 alle 18:24
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
-- Struttura della tabella `carrello`
--
-- Creazione: Nov 28, 2022 alle 15:21
--

CREATE TABLE IF NOT EXISTS `carrello` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Ammontare` int(20) UNSIGNED NOT NULL,
  `Quantità` int(20) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `carrello`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `catalogo`
--
-- Creazione: Nov 28, 2022 alle 17:14
--

CREATE TABLE IF NOT EXISTS `catalogo` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Descrizione` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `catalogo`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--
-- Creazione: Nov 29, 2022 alle 15:08
-- Ultimo aggiornamento: Nov 29, 2022 alle 15:08
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Descrizione` varchar(30) NOT NULL,
  `IdCatalogo` int(10) UNSIGNED NOT NULL,
  `IdCategoriaPadre` int(10) UNSIGNED NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `TImestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `categoria`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--
-- Creazione: Nov 03, 2022 alle 16:39
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `cliente`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `corriere`
--
-- Creazione: Nov 29, 2022 alle 15:33
--

CREATE TABLE IF NOT EXISTS `corriere` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Descrizione` varchar(30) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `corriere`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `galleria immagini`
--
-- Creazione: Nov 28, 2022 alle 16:30
--

CREATE TABLE IF NOT EXISTS `galleria immagini` (
  `Id` int(10) UNSIGNED NOT NULL,
  `IdProdotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `galleria immagini`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--
-- Creazione: Nov 29, 2022 alle 14:53
--

CREATE TABLE IF NOT EXISTS `immagine` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Risorsa` varchar(30) NOT NULL,
  `IdGalleriaImmagini` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- MEDIA TYPES FOR TABLE `immagine`:
--   `Risorsa`
--       `Image_JPEG`
--

--
-- RELAZIONI PER TABELLA `immagine`:
--   `IdGalleriaImmagini`
--       `galleria immagini` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--
-- Creazione: Nov 28, 2022 alle 16:14
--

CREATE TABLE IF NOT EXISTS `ordine` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Carrello` int(10) UNSIGNED NOT NULL,
  `IdStatusOrdine` int(10) UNSIGNED NOT NULL,
  `Ammontare` int(11) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `ordine`:
--   `Carrello`
--       `carello` -> `Id`
--   `Carrello`
--       `carrello` -> `Id`
--   `IdStatusOrdine`
--       `status ordine` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamento`
--
-- Creazione: Nov 29, 2022 alle 15:22
--

CREATE TABLE IF NOT EXISTS `pagamento` (
  `Id` int(10) UNSIGNED NOT NULL,
  `IdOrdine` int(10) UNSIGNED NOT NULL,
  `Data` date NOT NULL,
  `Importo` int(30) UNSIGNED NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `pagamento`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--
-- Creazione: Nov 18, 2022 alle 15:13
--

CREATE TABLE IF NOT EXISTS `prodotto` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(100) NOT NULL,
  `Prezzo` double NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `prodotto`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `spedizione`
--
-- Creazione: Nov 29, 2022 alle 15:27
--

CREATE TABLE IF NOT EXISTS `spedizione` (
  `Id` int(10) UNSIGNED NOT NULL,
  `IdOrdine` int(10) UNSIGNED NOT NULL,
  `DataSpedizione` date NOT NULL,
  `LuogoSpedizione` varchar(30) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `spedizione`:
--   `IdOrdine`
--       `ordine` -> `Id`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `status ordine`
--
-- Creazione: Nov 28, 2022 alle 16:25
--

CREATE TABLE IF NOT EXISTS `status ordine` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Descrizione` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `status ordine`:
--

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore`
--
-- Creazione: Nov 03, 2022 alle 16:39
--

CREATE TABLE IF NOT EXISTS `venditore` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Ragione Sociale` varchar(25) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `P. IVA` int(20) NOT NULL,
  `Status` tinyint(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAZIONI PER TABELLA `venditore`:
--

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `corriere`
--
ALTER TABLE `corriere`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `galleria immagini`
--
ALTER TABLE `galleria immagini`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdGalleriaImmagini` (`IdGalleriaImmagini`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Carrello` (`Carrello`),
  ADD KEY `IdStatusOrdine` (`IdStatusOrdine`);

--
-- Indici per le tabelle `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `spedizione`
--
ALTER TABLE `spedizione`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdOrdine` (`IdOrdine`);

--
-- Indici per le tabelle `status ordine`
--
ALTER TABLE `status ordine`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `corriere`
--
ALTER TABLE `corriere`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `galleria immagini`
--
ALTER TABLE `galleria immagini`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `spedizione`
--
ALTER TABLE `spedizione`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `status ordine`
--
ALTER TABLE `status ordine`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
