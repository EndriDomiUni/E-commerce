<?php
// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once ("mandatory.php");
require_once("./script/productManagerSeller.php");

ob_start();
require './templates/views/components/productCardSeller.php';
$mainContent = ob_get_clean();
$title = "Manage products";
require_once("./templates/base.php");