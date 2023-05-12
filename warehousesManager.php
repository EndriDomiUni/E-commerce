<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "./src/classes/Dbh.php";
require_once("./script/warehouseManager.script.php");

ob_start();
require './templates/views/components/warehouseCard.php';
$mainContent = ob_get_clean();
$title = "Warehouses Manager";
require_once("./templates/base.php");