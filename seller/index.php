<?php
session_start();
require_once("../config/AppConstans.php");
ob_start();
require '../templates/views/seller/index.php';
$main_Content = ob_get_clean();
require_once("../templates/baseSeller.php");
