<?php

session_start();
require_once("./config/AppConstants.php");

ob_start();
require './templates/views/user/cart.php';
$mainContent = ob_get_clean();
$title = "Carrello";
require_once("./templates/base.php");