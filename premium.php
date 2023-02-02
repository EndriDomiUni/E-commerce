<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("./src/classes/Dbh.php");
require_once("./script/premium.script.php");

ob_start();
require './templates/views/user/premium.php';
$mainContent = ob_get_clean();
$title = "Premium";
require_once("./templates/base.php");