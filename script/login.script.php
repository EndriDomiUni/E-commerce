<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "./src/utility/Utils.php";

$dbh = new Dbh();

if (isset($_POST["btn-login"])) {
    try {
        $params = [
            EMAIL => filter_var($_POST["email"], FILTER_SANITIZE_EMAIL),
            PASSWORD => filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS)
        ];
        $response = $dbh->logIn($params);
        if (is_int($response)) {
            header("Location: index.php");
        } else {
            // alert
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
