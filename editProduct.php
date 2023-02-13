<?php
session_start();
include("./src/classes/Dbh.php");
require_once("./script/editProduct.script.php");

ob_start();
require './templates/views/components/productCardSeller.php';
$mainContent = ob_get_clean();
$title = "Edit product";
require_once("./templates/base.php");