<?php

session_start();
require_once("./config/AppConstants.php");
require_once("./script/productInsertion.script.php");

ob_start();
require './templates/views/form/productInsertion.php';
$mainContent = ob_get_clean();
$title = "Login";
require_once("./templates/base.php");
