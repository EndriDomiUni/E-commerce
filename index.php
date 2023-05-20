<?php
// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("./src/classes/Dbh.php");
require_once("./script/productManager.script.php");
require_once("./script/sort.script.php");
require_once("./script/productSearchResult.script.php");

ob_start();

require_once("./templates/views/user/index.php");

$mainContent = ob_get_clean();
$title = "Homepage";
require_once("./templates/base.php");
$_GET['id'] = "";