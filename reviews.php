<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once ("mandatory.php");

ob_start();
require './templates/views/user/reviews.php';
$mainContent = ob_get_clean();
$title = "Recensioni";
require_once("./templates/base.php");