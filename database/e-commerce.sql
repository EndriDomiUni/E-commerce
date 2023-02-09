-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 09, 2023 alle 19:17
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
CREATE TABLE `Articolo` (
  `Id` int(11) NOT NULL,
  `Prezzo` varchar(100) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo_in_carrello`
--

DROP TABLE IF EXISTS `Articolo_in_carrello`;
CREATE TABLE `Articolo_in_carrello` (
  `Id` int(11) NOT NULL,
  `Quantità` int(11) NOT NULL,
  `Carrello_id` int(11) NOT NULL,
  `Articolo_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Articolo_in_magazzino`
--

DROP TABLE IF EXISTS `Articolo_in_magazzino`;
CREATE TABLE `Articolo_in_magazzino` (
  `Id` int(11) NOT NULL,
  `Tassa` decimal(10,0) NOT NULL,
  `Data_inizio` date NOT NULL,
  `Data_fine` date NOT NULL,
  `Articolo_id` int(11) NOT NULL,
  `Magazzino_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Carrello`
--

DROP TABLE IF EXISTS `Carrello`;
CREATE TABLE `Carrello` (
  `Id` int(11) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Status` int(4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
CREATE TABLE `Categoria` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(300) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Claim`
--

DROP TABLE IF EXISTS `Claim`;
CREATE TABLE `Claim` (
  `Id` int(11) NOT NULL,
  `Descrizione` varchar(50) NOT NULL,
  `Conto` decimal(10,0) NOT NULL,
  `Status` int(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Claim`
--

INSERT INTO `Claim` (`Id`, `Descrizione`, `Conto`, `Status`, `Timestamp`) VALUES
(59, 'user', '0', 0, '2023-02-09 18:12:41'),
(60, 'user', '0', 0, '2023-02-09 18:13:44');

-- --------------------------------------------------------

--
-- Struttura della tabella `Configurazione_variazione`
--

DROP TABLE IF EXISTS `Configurazione_variazione`;
CREATE TABLE `Configurazione_variazione` (
  `Id` int(11) NOT NULL,
  `Articolo_id` int(11) NOT NULL,
  `Opzio_variazione_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Dettaglio_ordine`
--

DROP TABLE IF EXISTS `Dettaglio_ordine`;
CREATE TABLE `Dettaglio_ordine` (
  `Id` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Articolo_in_carr_id` int(11) NOT NULL,
  `Ordine_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Dimensione`
--

DROP TABLE IF EXISTS `Dimensione`;
CREATE TABLE `Dimensione` (
  `Id` int(11) NOT NULL,
  `Dim_X` varchar(100) NOT NULL,
  `Dim_Y` varchar(100) NOT NULL,
  `Dim_Z` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Dimensione`
--

INSERT INTO `Dimensione` (`Id`, `Dim_X`, `Dim_Y`, `Dim_Z`, `Timestamp`) VALUES
(2, 'dimX_unset', 'dimY_unset', 'dimZ_unset', '2023-02-04 09:43:18'),
(3, '1', '1', '1', '2023-02-05 07:33:15');

-- --------------------------------------------------------

--
-- Struttura della tabella `Forma_di_pagamento`
--

DROP TABLE IF EXISTS `Forma_di_pagamento`;
CREATE TABLE `Forma_di_pagamento` (
  `Id` int(11) NOT NULL,
  `Circuito` varchar(20) NOT NULL,
  `Numero_carta` varchar(20) NOT NULL,
  `Data_scadenza` varchar(20) NOT NULL,
  `CVV` int(3) NOT NULL,
  `Tipo_di_pagamento` int(10) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Indirizzo`
--

DROP TABLE IF EXISTS `Indirizzo`;
CREATE TABLE `Indirizzo` (
  `Id` int(11) NOT NULL,
  `Via` varchar(100) NOT NULL,
  `Numero_civico` int(5) NOT NULL,
  `Citta` varchar(50) NOT NULL,
  `CAP` int(5) NOT NULL,
  `Status` int(4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Magazzino`
--

DROP TABLE IF EXISTS `Magazzino`;
CREATE TABLE `Magazzino` (
  `Id` int(11) NOT NULL,
  `Metri_cubi` double NOT NULL,
  `Indirizzo_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Opzione_variazione`
--

DROP TABLE IF EXISTS `Opzione_variazione`;
CREATE TABLE `Opzione_variazione` (
  `Id` int(11) NOT NULL,
  `Valore` varchar(300) NOT NULL,
  `Variazione_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Ordine`
--

DROP TABLE IF EXISTS `Ordine`;
CREATE TABLE `Ordine` (
  `Id` int(11) NOT NULL,
  `Data_ordine` date NOT NULL,
  `Tot_ordine` decimal(10,0) NOT NULL,
  `Status` int(11) NOT NULL,
  `Metodo_di_spedizione` int(11) NOT NULL,
  `Forma_di_pag_id` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto`
--

DROP TABLE IF EXISTS `Prodotto`;
CREATE TABLE `Prodotto` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(50) NOT NULL,
  `Immagine` varchar(300) NOT NULL,
  `Dim_id` int(11) NOT NULL,
  `Categoria_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto_in_raccolta`
--

DROP TABLE IF EXISTS `Prodotto_in_raccolta`;
CREATE TABLE `Prodotto_in_raccolta` (
  `Id` int(11) NOT NULL,
  `Raccolta_id` int(11) NOT NULL,
  `Prodotto_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Raccolta`
--

DROP TABLE IF EXISTS `Raccolta`;
CREATE TABLE `Raccolta` (
  `Id` int(11) NOT NULL,
  `Tipo_raccolta` int(5) NOT NULL,
  `Titolo` varchar(50) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Status` int(4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Recensione`
--

DROP TABLE IF EXISTS `Recensione`;
CREATE TABLE `Recensione` (
  `Id` int(11) NOT NULL,
  `Valutazione` int(5) NOT NULL,
  `Commento` varchar(300) NOT NULL,
  `Dettaglio_ordine_id` int(11) NOT NULL,
  `Utente_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--

DROP TABLE IF EXISTS `Utente`;
CREATE TABLE `Utente` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Claim_id` int(11) NOT NULL,
  `Indirizzo_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Variazione`
--

DROP TABLE IF EXISTS `Variazione`;
CREATE TABLE `Variazione` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(300) NOT NULL,
  `Categoria_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Articolo`
--
ALTER TABLE `Articolo`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Prodotto_id` (`Prodotto_id`),
  ADD KEY `Utente_id` (`Utente_id`);

--
-- Indici per le tabelle `Articolo_in_carrello`
--
ALTER TABLE `Articolo_in_carrello`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Carrello_id` (`Carrello_id`),
  ADD KEY `Articolo_id` (`Articolo_id`);

--
-- Indici per le tabelle `Articolo_in_magazzino`
--
ALTER TABLE `Articolo_in_magazzino`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Articolo_id` (`Articolo_id`),
  ADD KEY `Magazzino_id` (`Magazzino_id`);

--
-- Indici per le tabelle `Carrello`
--
ALTER TABLE `Carrello`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Utente_id` (`Utente_id`);

--
-- Indici per le tabelle `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `Claim`
--
ALTER TABLE `Claim`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `Configurazione_variazione`
--
ALTER TABLE `Configurazione_variazione`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Opzio_variazione_id` (`Opzio_variazione_id`),
  ADD KEY `Articolo_id` (`Articolo_id`);

--
-- Indici per le tabelle `Dettaglio_ordine`
--
ALTER TABLE `Dettaglio_ordine`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Articolo_in_carr_id` (`Articolo_in_carr_id`),
  ADD KEY `Ordine_id` (`Ordine_id`);

--
-- Indici per le tabelle `Dimensione`
--
ALTER TABLE `Dimensione`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `Forma_di_pagamento`
--
ALTER TABLE `Forma_di_pagamento`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Utente_id` (`Utente_id`);

--
-- Indici per le tabelle `Indirizzo`
--
ALTER TABLE `Indirizzo`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `Magazzino`
--
ALTER TABLE `Magazzino`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Indirizzo_id` (`Indirizzo_id`);

--
-- Indici per le tabelle `Opzione_variazione`
--
ALTER TABLE `Opzione_variazione`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Variazione_id` (`Variazione_id`);

--
-- Indici per le tabelle `Ordine`
--
ALTER TABLE `Ordine`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Forma_di_pag_id` (`Forma_di_pag_id`);

--
-- Indici per le tabelle `Prodotto`
--
ALTER TABLE `Prodotto`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Dim_id` (`Dim_id`),
  ADD KEY `Categoria_id` (`Categoria_id`);

--
-- Indici per le tabelle `Prodotto_in_raccolta`
--
ALTER TABLE `Prodotto_in_raccolta`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Prodotto_id` (`Prodotto_id`),
  ADD KEY `Raccolta_id` (`Raccolta_id`);

--
-- Indici per le tabelle `Raccolta`
--
ALTER TABLE `Raccolta`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Utente_id` (`Utente_id`);

--
-- Indici per le tabelle `Recensione`
--
ALTER TABLE `Recensione`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Dettaglio_ordine_id` (`Dettaglio_ordine_id`),
  ADD KEY `Utente_id` (`Utente_id`);

--
-- Indici per le tabelle `Utente`
--
ALTER TABLE `Utente`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Indirizzo_id` (`Indirizzo_id`),
  ADD KEY `Claim_id` (`Claim_id`);

--
-- Indici per le tabelle `Variazione`
--
ALTER TABLE `Variazione`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Categoria_id` (`Categoria_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Articolo`
--
ALTER TABLE `Articolo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT per la tabella `Articolo_in_carrello`
--
ALTER TABLE `Articolo_in_carrello`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Articolo_in_magazzino`
--
ALTER TABLE `Articolo_in_magazzino`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `Carrello`
--
ALTER TABLE `Carrello`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT per la tabella `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `Claim`
--
ALTER TABLE `Claim`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT per la tabella `Configurazione_variazione`
--
ALTER TABLE `Configurazione_variazione`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT per la tabella `Dettaglio_ordine`
--
ALTER TABLE `Dettaglio_ordine`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Dimensione`
--
ALTER TABLE `Dimensione`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `Forma_di_pagamento`
--
ALTER TABLE `Forma_di_pagamento`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `Indirizzo`
--
ALTER TABLE `Indirizzo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `Magazzino`
--
ALTER TABLE `Magazzino`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `Opzione_variazione`
--
ALTER TABLE `Opzione_variazione`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `Ordine`
--
ALTER TABLE `Ordine`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Prodotto`
--
ALTER TABLE `Prodotto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `Prodotto_in_raccolta`
--
ALTER TABLE `Prodotto_in_raccolta`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Raccolta`
--
ALTER TABLE `Raccolta`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Recensione`
--
ALTER TABLE `Recensione`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Utente`
--
ALTER TABLE `Utente`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `Variazione`
--
ALTER TABLE `Variazione`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
