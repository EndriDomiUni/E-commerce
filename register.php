<?php

session_start();
require_once("./config/AppConstans.php");
require_once("register.script.php");

ob_start();
require './templates/views/utils/register.php';
$mainContent = ob_get_clean();
$title = "Sign up";
require_once("./templates/base.php");
