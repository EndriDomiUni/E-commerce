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

// INTERNAL USE --------------------------------------------------------

/**
 * OK value = 0;
 */
const OK = 0;

/**
 * ERROR value = 1;
 */
const ERROR = 1;

/**
 * COSTUMER = cliente
 */
const COSTUMER = "cliente";

/**
 * SELLER = "venditore";
 */
const SELLER = "venditore";

const INACTIVE = 0;
const ACTIVE = 1;

const SUCCESS = "success";
const DANGER = "danger";
