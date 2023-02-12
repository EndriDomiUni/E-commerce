<?php

session_start();
include("./src/classes/Dbh.php");
require_once("./script/address.script.php");

ob_start();
require './templates/views/user/orderHistory.php';
$mainContent = ob_get_clean();
$title = "Order History";
require_once("./templates/base.php");