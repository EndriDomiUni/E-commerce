<?php

// ROOT 

/**
 * /app
 */
define("ROOT", "/app");
define("URL_ROOT", isset($_SERVER['HTTPS']) ? "https" : "http" . "://" . $_SERVER['SERVER_NAME'] . ROOT);

// ASSETS

/**
 * /app/assets/css
 */
define("CSS", ROOT . "/assets/css");

/**
 * /app/assets/js
 */
define("JS", ROOT . "/assets/js");

/**
 * /app/assets/img
 */
define("IMG", ROOT . "/assets/img");

// VIEWS
define('VIEW_ROOT', URL_ROOT . '/templates/views');
define("VIEW_USER", VIEW_ROOT . "/user");
define("VIEW_SELLER", VIEW_ROOT . "/seller");

// DATABASE
define("SERVER", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DBNAME", "e-commerce");
define("PORT", "3306");
define("CHARSET", "utf8");

// FOLDERS
define("CONFIG", ROOT . "/config");
define("TEMPLATES", ROOT . "/templates");

// SPECIAL CHARACTERS
define("EURO", "€");