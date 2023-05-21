<?php

session_start();

require_once ("mandatory.php");
require_once("./script/address.script.php");

ob_start();
require './templates/views/form/address.php';
$mainContent = ob_get_clean();
$title = "Address";
require_once("./templates/base.php");