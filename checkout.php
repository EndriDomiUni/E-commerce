<?php

session_start();
include("./src/classes/Dbh.php");
require_once("./script/address.script.php");

ob_start();
require './templates/views/form/checkout.php';
$mainContent = ob_get_clean();
$title = "Checkout";
require_once("./templates/base.php");