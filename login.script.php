<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("./config/AppConstants.php");
include("Dbh.php");

if (isset($_POST["btn-login"])) {
    $params = array(
        "Email" => filter_var($_POST["email"], FILTER_SANITIZE_EMAIL),
        "Password" => $_POST['password']
    );
    try {
        $dbh = new Dbh();
        $response = $dbh->logIn($params);
        if ($response["Status"] == ERROR) {
            $error = $response["msg"];
        } else {
            header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}