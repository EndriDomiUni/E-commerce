<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./config/AppConstants.php";
include "./src/classes/Dbh.php";

$dbh = null;

if (isset($_POST['personal-btn-register'])) {
    try {
        $params = [
            "Nome" => filter_var($_POST['personal-name-register'], FILTER_SANITIZE_SPECIAL_CHARS),
            "Cognome" => filter_var($_POST['personal-surname-register'], FILTER_SANITIZE_SPECIAL_CHARS),
            "Email" => filter_var($_POST['personal-mail-register'], FILTER_SANITIZE_EMAIL),
            "Password" => $_POST['personal-password-register'],
            "claimType" => filter_var(CLAIM_USER, FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        $dbh = new Dbh();
        $response = $dbh->register($params);
        if ($response["Status"] === ERROR) {
            $error_register = $response["msg"];
        } else {
            header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (isset($_POST['business-btn-register'])) {
    try {
        $params = [
            "Nome" => filter_var($_POST['business-name-register'], FILTER_SANITIZE_SPECIAL_CHARS),
            "Cognome" => filter_var($_POST['business-surname-register'], FILTER_SANITIZE_SPECIAL_CHARS),
            "Email" => filter_var($_POST['business-mail-register'], FILTER_SANITIZE_EMAIL),
            "Password" => $_POST['business-password-register'],
            "claimType" => CLAIM_SELLER
        ];

        $dbh = new Dbh();
        $response = $dbh->register($params);
        var_dump($response);
        if ($response["Status"] === ERROR) {
            $error_register = $response["msg"];
        } else {
            echo "Sono qui";
            //header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
