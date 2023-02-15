<?php
// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("./src/classes/Dbh.php");
require_once("./script/editProduct.script.php");

ob_start();
require './templates/views/form/editProduct.php';
$mainContent = ob_get_clean();
$title = "Edit product";
require_once("./templates/base.php");