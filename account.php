<?php
session_start();
require_once("./config/AppConstants.php");

ob_start();
require './templates/views/user/account.php';
$mainContent = ob_get_clean();
$title = "Account";
require_once("./templates/base.php");
