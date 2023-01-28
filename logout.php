<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);
// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_unset();
session_destroy();
header("Location: index.php");