<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";

if (isset($_SESSION[ID])) {
    $session = new Session($_SESSION[ID]);

    // delete account
    if (isset($_POST["btn-delete"])) {
        $session->deleteCurrentUser();
    }
} else {
    echo "Non sei loggato";
}

