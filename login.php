<?php

session_start();
require_once("./config/AppConstants.php");
require_once("./script/login.script.php");

ob_start();
require './templates/views/form/login.php';
$mainContent = ob_get_clean();
$title = "Login";
require_once("./templates/base.php");
