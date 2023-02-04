<?php

session_start();
include("./src/classes/Dbh.php");
require_once("./script/cardPayForm.script.php");

ob_start();
require './templates/views/form/cardPayForm.php';
$mainContent = ob_get_clean();
$title = "Address";
require_once("./templates/base.php");