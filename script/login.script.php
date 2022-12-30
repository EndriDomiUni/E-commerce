<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("./config/AppConstants.php");
include "./src/classes/Dbh.php";

if (isset($_POST["btn-login"])) {
    try {
        $params = [
            "Email" => filter_var($_POST["email"], FILTER_SANITIZE_EMAIL),
            "Password" => $_POST['password'],
        ];

        $dbh = new Dbh();
        $response = $dbh->logIn($params);
        if ($response["Status"] === ERROR) {
            $error_register = $response["msg"];
        } else {
            echo "sei dentro!";
            //header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}