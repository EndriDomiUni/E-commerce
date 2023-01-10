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

// VIEWS ----------------------------------------------------------------
const VIEW_ROOT = URL_ROOT . '/templates/views';
const VIEW_USER = VIEW_ROOT . "/user";
const VIEW_SELLER = VIEW_ROOT . "/seller";

const EURO = "€";

// CLAIM ---------------------------------------------------------------
const CLAIM_GUEST_ID = 1;
const CLAIM_USER_ID = 2;
const CLAIM_SELLER_ID = 3;

const CLAIM_USER_PRO_ID = 4;
const CLAIM_SELLER_PR0_ID = 5;

// STATUS --------------------------------------------------------------
const INACTIVE = 0;
const ACTIVE = 1;

const STATUS_INTACT_DATA = 0;
const STATUS_MODIFIED_DATA = 1;
const STATUS_DELETED_DATA = 2;

const ADDRESS_UNSET = 1;



const OK = "Ok";
const ERROR = "Error";

const COSTUMER = "cliente";
const SELLER = "venditore";



const SUCCESS = "success";
const DANGER = "danger";


// TABLE NAME
const UTENTE = "Utente";
const CARRELLO = "carrello";
const CATEGORIA = "categoria";


// TABLE COLUMN NAME
const ID = "Id";
const NOME = "Nome";
const COGNOME = "Cognome";
const EMAIL = "Email";
const PASSWORD = "Password";
const STATUS = "Status";
const CLAIM_ID = "Claim_id";
const INDIRIZZO_ID = "Indirizzo_id";
const VIA = "Via";
const NUMERO_CIVICO = "Numero_civico";
const CITTA = "Citta";
const CAP = "CAP";
const CIRCUITO = "Circuito";
const NUMERO_CARTA = "Numero_carta";
const DATA_SCADENZA = "Data_scadenza";
const CV2 = "CV2";
const UTENTE_ID = "Utente_id";
const DESCRIZIONE = "Descrizione";
const IMMAGINE = "Immagine";
const DIMENSIONE_ID = "Dimensione_id";
const CATEGORIA_ID = "Categoria_id";