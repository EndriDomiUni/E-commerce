<?php

session_start();
require_once("DatabaseHelper.php");
$dbh = new DatabaseHelper("localhost", "root", "", "e-commerce", "3306");
