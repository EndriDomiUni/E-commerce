<?php
session_start();
require_once("./config/AppConstans.php");
ob_start();
require("./templates/views/user/index.php");
$mainContent = ob_get_clean();
$title = "Homepage";
require_once("./templates/base.php");
