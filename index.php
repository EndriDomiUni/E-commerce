<?php
session_start();
require_once("./config/AppConstants.php");
include("Dbh.php");

ob_start();
require("./templates/views/user/index.php");
$mainContent = ob_get_clean();
$title = "Homepage";

// if (isset($_SESSION['Id'])) {
//     if ($_SESSION['Id'] == ) {

//     }
// } else {
require_once("./templates/base.php");
//}