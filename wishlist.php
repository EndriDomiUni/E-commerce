<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("./src/classes/Dbh.php");

ob_start();
require './templates/views/user/wishlist.php';
$mainContent = ob_get_clean();
$title = "Wishlist";
require_once("./templates/base.php");