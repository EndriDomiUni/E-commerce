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

// DATABASE -------------------------------------------------------------
const SERVER = "127.0.0.1";
const USERNAME = "root";
const PASSWORD = "";
const DBNAME = "e-commerce";
const PORT = "3306";
const CHARSET = "utf8";

// FOLDERS -------------------------------------------------------------
const CONFIG = ROOT . "/config";
const TEMPLATES = ROOT . "/templates";

// SPECIAL CHARACTERS --------------------------------------------------
const EURO = "€";

// CLAIM ---------------------------------------------------------------
const CLAIM_GUEST = 0;
const CLAIM_USER = 1;
const CLAIM_SELLER = 2;

const CLAIM_USER_PRO = 3;
const CLAIM_SELLER_PR0 = 4;

// STATUS --------------------------------------------------------------
const INACTIVE = 0;
const ACTIVE = 1;

const STATUS_INTACT_DATA = 0;
const STATUS_INTACT_DATA = 0;
const STATUS_DELETED_DATA = 0;

const ADDRESS_UNSET = 1;



const OK = "Ok";
const ERROR = "Error";

const COSTUMER = "cliente";
const SELLER = "venditore";



const SUCCESS = "success";
const DANGER = "danger";
