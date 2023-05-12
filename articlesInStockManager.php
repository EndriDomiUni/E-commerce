<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "./src/classes/Dbh.php";

ob_start();
require './templates/views/components/articleInStock.php';
$mainContent = ob_get_clean();
$title = "Articles in stock";
require_once("./templates/base.php");
