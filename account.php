<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("./src/classes/Dbh.php");
require_once("./script/cardPayForm.script.php");
require_once("./script/address.script.php");
require_once("./script/account.script.php");

ob_start();
require './templates/views/user/account.php';
$mainContent = ob_get_clean();
$title = "Account";
require_once("./templates/base.php");
