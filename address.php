<?php

session_start();
require_once("./config/AppConstants.php");
require_once("./script/address.script.php");

ob_start();
require './templates/views/form/address.php';
$mainContent = ob_get_clean();
$title = "Sign up";
require_once("./templates/base.php");