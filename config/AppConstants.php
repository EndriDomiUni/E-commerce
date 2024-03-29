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

const ERROR_STR = "error";

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
/**
 * Ogni dettaglio ordine, viene generato con questo stato
 */
const ORDER_DETAIL_STATUS_PENDING_DATA = 3;



// UNSET ---------------------------------------------------------------
const ADDRESS_UNSET = 1;
const CLAIM_UNSET = 1;
const DIMENSION_UNSET = 2;
const CATEGORY_UNSET = 1;
const VARIATION_UNSET = 1;
const CONFIGURATION_VARIATION_UNSET = 1;
const CARRELLO_UNSET = 1;
const RACCOLTA_UNSET = 0;
const ID_UNSET = 1;


// TABLE NAME ----------------------------------------------------------
const UTENTE = "Utente";
const RECENSIONE = "Recensione";
const CARRELLO = "Carrello";
const CATEGORIA = "Categoria";
const CLAIM = "Claim";
const MAGAZZINO = "Magazzino";

const PRODOTTO = "Prodotto";
const ARTICOLO = "Articolo";
const INDIRIZZO = "Indirizzo";
const OPZIONE_VARIAZIONE = "Opzione_variazione";
const DIMENSIONE = "Dimensione";
const CONFIGURAZIONE_VARIAZIONE = "Configurazione_variazione";
const RACCOLTA = "Raccolta";
const VARIAZIONE = "Variazione";
const ARTICOLO_IN_CARRELLO = "Articolo_in_carrello";
const FORMA_DI_PAGAMENTO = "Forma_di_pagamento";
const ARTICOLO_IN_MAGAZZINO = "Articolo_in_magazzino";
const ORDINE = "Ordine";
const DETTAGLIO_ORDINE = "Dettaglio_ordine";
// TABLE COLUMN NAME ---------------------------------------------------
// ID
const ID = "Id";
const CARRELLO_ID = "Carrello_id";
const INDIRIZZO_ID = "Indirizzo_id";
const UTENTE_ID = "Utente_id";
const PRODOTTO_ID = "Prodotto_id";
const ARTICOLO_ID = "Articolo_id";
const ORDINE_ID = "Ordine_id";
const OPZIONE_ID = "Opzio_variazione_id";
const CLAIM_ID = "Claim_id";
const CATEGORIA_ID = "Categoria_id";
const VARIAZIONE_ID = "Variazione_id";
const MAGAZZINO_ID = "Magazzino_id";
const RACCOLTA_ID = "Raccolta_id";
const DETTAGLIO_ORDINE_ID = "Dettaglio_ordine_id";
const FORMA_DI_PAG_ID = "Forma_di_pag_id";


// ORDER DETAILS
const ORDER_DETAILS_TYPE_STANDARD = 1; // default
const ORDER_DETAILS_TYPE_MONTHLY = 2;
const ORDER_DETAILS_TYPE_QUARTERLY = 3; // trimestrale
const ORDER_DETAILS_TYPE_YEARLY = 4;
const ORDER_DETAILS_TYPE_INSTALLMENT_PAYMENT = 5; // rate



// FIELD
const NOME = "Nome";
const COGNOME = "Cognome";
const EMAIL = "Email";
const PASSWORD = "Password";
const STATUS = "Status";
const CLAIM_TYPE = "Descrizione";
const VIA = "Via";
const NUMERO_CIVICO = "Numero_civico";
const CITTA = "Citta";
const CAP = "CAP";
const CIRCUITO = "Circuito";
const NUMERO_CARTA = "Numero_carta";
const DATA_SCADENZA = "Data_scadenza";
const CVV = "CVV";
const TASSA = "Tassa";
const TIPO_DI_PAGAMENTO = "Tipo_di_pagamento";
const DESCRIZIONE = "Descrizione";
const MOTIVO = "Motivo";
const IMMAGINE = "Immagine";
const DIMENSIONE_X_PRODOTTO = "Dimensione_x";
const DIMENSIONE_Y_PRODOTTO = "Dimensione_y";
const DIMENSIONE_Z_PRODOTTO = "Dimensione_z";
const PREZZO = "Prezzo";
const DATA_INIZIO = "Data_inizio";
const DATA_FINE = "Data_fine";
const SCADENZA = "2024-12-31"; //Y-m-d
const TAX = "Tassa";
const VALORE = "Valore";
const QUANTITA = "Quantità";
const WHISLIST = 1;
const WHISLIST_STRING = "whislist";
const TOTALE_ORDINE = "Tot_ordine";
const DATA_ORDINE = "Data_ordine";
const METRI_CUBI = "Metri_cubi";
const VALUTAZIONE = "Valutazione";
const COMMENTO = "Commento";
const TIPO = "Tipo";
const CONTO = "Conto";

// SORT MODE
const SORT_MODE_DEFAULT = 0;
const SORT_MODE_PRICE_ASC = 1;
const SORT_MODE_PRICE_DESC = 2;
const SORT_MODE_NAME_ASC = 3;
const SORT_MODE_NAME_DESC = 4;


// ORDER STATUS
const ORDER_STATUS_PAID = 0;
const ORDER_STATUS_PENDING = 1;
const ORDER_STATUS_GIVE_BACK = 4;

// STANDARD VALUES
const STANDARD_TAX = 3;

// INVOICE STATUS
const INVOICE_STATUS_PAID = 0;
const INVOICE_STATUS_PENDING = 0;
const INVOICE_STATUS_GIVE_BACK = 0;