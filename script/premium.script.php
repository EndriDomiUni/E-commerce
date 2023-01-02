<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./config/AppConstants.php";
include "./src/classes/Dbh.php";

$dbh = null;

