<?php

// ROOT ------------------------------------------------------------------

/**
 * /app
 */
const ROOT = "/app";
define("URL_ROOT", isset($_SERVER['HTTPS'])
    ? "https"
    : "http"
    . "://" . $_SERVER['SERVER_NAME'] . ROOT);

// ASSETS ----------------------------------------------------------------

/**
 * /app/assets/css
 */
const CSS = ROOT . "/assets/css";

/**
 * /app/assets/js
 */
const JS = ROOT . "/assets/js";

/**
 * /app/assets/img
 */
const IMG = ROOT . "/assets/img";
const UPLOADS = ROOT . "/uploads";

// VIEWS ----------------------------------------------------------------
const VIEW_ROOT = URL_ROOT . '/templates/views';
const VIEW_USER = VIEW_ROOT . "/user";
const VIEW_SELLER = VIEW_ROOT . "/seller";

const EURO = "€";

// CLAIM ---------------------------------------------------------------
const CLAIM_GUEST_DESC = "guest";
const CLAIM_USER_DESC = "user";
const CLAIM_SELLER_DESC = "seller";

const CLAIM_USER_PRO_DESC = "user_pro";
const CLAIM_SELLER_PR0_DESC = "seller_pro";

// STATUS --------------------------------------------------------------
const INACTIVE = 0;
const ACTIVE = 1;

const STATUS_INTACT_DATA = 0;
const STATUS_MODIFIED_DATA = 1;
const STATUS_DELETED_DATA = 2;

// UNSET ---------------------------------------------------------------
const ADDRESS_UNSET = 1;
const CLAIM_UNSET = 1;
const DIMENSION_UNSET = 2;
const CATEGORY_UNSET = 1;
const VARIATION_UNSET = 1;
const CONFIGURATION_VARIATION_UNSET = 1;
const CARRELLO_UNSET = 1;

// TABLE NAME ----------------------------------------------------------
const UTENTE = "Utente";
const CARRELLO = "Carrello";
const CATEGORIA = "Categoria";
const CLAIM = "Claim";
const PRODOTTO = "Prodotto";
const ARTICOLO = "Articolo";
const INDIRIZZO = "Indirizzo";

// TABLE COLUMN NAME ---------------------------------------------------
// ID
const ID = "Id";
const CARRELLO_ID = "Carrello_id";
const INDIRIZZO_ID = "Indirizzo_id";
const UTENTE_ID = "Utente_id";
const PRODOTTO_ID = "Prodotto_id";
const ARTICOLO_ID = "Articolo_id";
const OPZIONE_ID = "Opzio_variazione_id";
const CLAIM_ID = "Claim_id";
const CATEGORIA_ID = "Categoria_id";
const MAGAZZINO_ID = "Magazzino_id";

// FIELD
const NOME = "Nome";
const COGNOME = "Cognome";
const EMAIL = "Email";
const PASSWORD = "Password";
const STATUS = "Status";
const CLAIM_TYPE = "Claim_type";
const VIA = "Via";
const NUMERO_CIVICO = "Numero_civico";
const CITTA = "Citta";
const CAP = "CAP";
const CIRCUITO = "Circuito";
const NUMERO_CARTA = "Numero_carta";
const DATA_SCADENZA = "Data_scadenza";
const CVV = "CVV";
const TIPO_DI_PAGAMENTO = "Tipo_di_pagamento";
const DESCRIZIONE = "Descrizione";
const IMMAGINE = "Immagine";
const DIMENSIONE_X_PRODOTTO = "Dimensione_x";
const DIMENSIONE_Y_PRODOTTO = "Dimensione_y";
const DIMENSIONE_Z_PRODOTTO = "Dimensione_z";
const PREZZO = "Prezzo";
const DATA_INIZIO = "Data_inizio";
const DATA_FINE = "Data_fine";
const TAX = "Tassa";
const QUANTITA = "Quantità";