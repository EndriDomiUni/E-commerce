<?php
session_start();
include("./src/classes/Dbh.php");
require_once("./script/productInsertion.script.php");

ob_start();
require './templates/views/form/editProduct.php';
$mainContent = ob_get_clean();
$title = "Insert product";
require_once("./templates/base.php");