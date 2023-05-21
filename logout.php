<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ("mandatory.php");

session_start();
setcookie(session_name(), '', 100);
session_unset();
session_destroy();
$_SESSION = array();
header("Location: index.php");