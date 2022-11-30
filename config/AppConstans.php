<?php

// ROOT 
define("ROOT", getcwd());
define("URL_ROOT", isset($_SERVER['HTTPS']) ? "https" : "http" . "://" . $_SERVER['SERVER_NAME'] . ROOT);

// INDEX 
define("INDEX", ROOT . "/index.php");


// ASSETS
define("CSS", ROOT . "/assets/css");
define("JS", ROOT . "/assets/js");
define("IMG", ROOT . "/assets/img");

// VIEWS
define('VIEW_ROOT', URL_ROOT . '/templates/views');
define("VIEW_USER", VIEW_ROOT . "/user");
define("VIEW_SELLER", VIEW_ROOT . "/seller");
define("SIGN-IN", VIEW-USER . "/sign-in.php");
define("SIGN-UP", VIEW-USER . "/sign-up.php");
define("INBOX", VIEW-USER . "/inbox.php");
define("SETTINGS", VIEW-USER . "/settings.php");

// DATABASE
define("SERVER", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DBNAME", "e-commerce");
define("PORT", "3306");
define("CHARSET", "utf8");

// SPECIAL CHARACTERS
define("EURO", "€");
