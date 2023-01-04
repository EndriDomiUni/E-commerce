<?php

use utility\Utils;

require_once("./config/AppConstants.php");
include "./src/classes/Dbh.php";

if (isset($_POST["btn-login"])) {
    try {
        $params = [
            EMAIL => filter_var($_POST["email"], FILTER_SANITIZE_EMAIL),
            PASSWORD => $_POST['password'],
        ];
        $dbh = new Dbh();
        $response = $dbh->logIn($params);
        Utils::checkResponse($response) ? header("Location: index.php") : null;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
