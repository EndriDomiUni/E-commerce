<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./config/AppConstants.php";
require_once "./src/classes/Dbh.php";

$dbh = new Dbh();

if (isset($_POST['personal-btn-register']) || isset($_POST['business-btn-register'])) {
    try {
        $params = [
            "Nome" => filter_var($_POST['personal-name-register'], FILTER_SANITIZE_SPECIAL_CHARS),
            "Cognome" => filter_var($_POST['personal-surname-register'], FILTER_SANITIZE_SPECIAL_CHARS),
            "Email" => filter_var($_POST['personal-mail-register'], FILTER_SANITIZE_EMAIL),
            "Password" => $_POST['personal-password-register'],
            "claimType" => CLAIM_USER
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

        $response = $dbh->register($params);
        $error_register = $response["Status"] === ERROR ? $response["msg"] : null;
        $response["Status"] === SUCCESS ? header("Location: index.php") : null;
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
