<?php
// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("./src/classes/Dbh.php");

ob_start();
require("./templates/views/user/index.php");
$mainContent = ob_get_clean();
$title = "Homepage";
require_once("./templates/base.php");
