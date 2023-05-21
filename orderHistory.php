<?php

session_start();
require_once ("mandatory.php");


ob_start();
require './templates/views/user/orderHistory.php';
$mainContent = ob_get_clean();
$title = "Order History";
require_once("./templates/base.php");