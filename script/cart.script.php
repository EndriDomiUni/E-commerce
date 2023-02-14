<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";

if (UtilsFunctions::issetSessionid()) {
    if (isset($_POST["btn-go-checkout"])) {
        header("Location: checkout.php");
    }
}