<?php

session_start();
require_once("./config/AppConstants.php");
require_once("./script/premium.script.php");

ob_start();
require './templates/views/user/premium.php';
$mainContent = ob_get_clean();
$title = "Premium";
require_once("./templates/base.php");