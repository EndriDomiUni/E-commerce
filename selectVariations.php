<?php

session_start();
require_once("./config/AppConstants.php");
require_once("./script/selectVariations.script.php");

ob_start();
require './templates/views/form/selectVariations.php';
$mainContent = ob_get_clean();
$title = "Configurazione articolo";
require_once("./templates/base.php");

