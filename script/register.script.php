<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./config/AppConstants.php";
require_once "./src/classes/Dbh.php";

$dbh = new Dbh();

if (isset($_POST['personal-btn-register']) || isset($_POST['business-btn-register'])) {
    try {
        $params = [];
        switch (true) {
            case isset($_POST['personal-btn-register']):
                $params = [
                    "Nome" => filter_var($_POST['personal-name-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    "Cognome" => filter_var($_POST['personal-surname-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    "Email" => filter_var($_POST['personal-mail-register'], FILTER_SANITIZE_EMAIL),
                    "Password" => filter_var($_POST['personal-password-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    "claimType" => filter_var(CLAIM_USER, FILTER_SANITIZE_SPECIAL_CHARS)
                ];
                break;
            case isset($_POST['business-btn-register']):
                $params = [
                    "Nome" => filter_var($_POST['business-name-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    "Cognome" => filter_var($_POST['business-surname-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    "Email" => filter_var($_POST['business-mail-register'], FILTER_SANITIZE_EMAIL),
                    "Password" => filter_var($_POST['business-password-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    "claimType" => filter_var(CLAIM_SELLER, FILTER_SANITIZE_SPECIAL_CHARS)
                ];
                break;
        }

        $response = $dbh->register($params);
        $error_register = $response["Status"] === ERROR ? $response["msg"] : null;
        $response["Status"] === SUCCESS ? header("Location: index.php") : null;
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
