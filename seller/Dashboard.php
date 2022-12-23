<?php
require_once("../src/utility/guestUser.php");
require_once("../config/AppCostants.php");
require '../templates/views/seller/dashboard.php';
$main_Content = ob_get_clean();
$title = "Dashboard";
require_once("../templates/baseSeller.php");
