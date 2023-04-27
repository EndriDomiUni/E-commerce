<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./src/classes/Dbh.php");


session_unset();
session_destroy();


$session = new Session(0);
header("Location: index.php");