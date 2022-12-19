<?php

include(dirname(__FILE__) . "/../classes/DatabaseHelper.php");

if ((isset($_POST["submit"]))) {

    if (isset($_POST['personal-btn-register'])) {
        $costumer = new CostumerHelper();

        $params = array(
            "Nome" => filter_var($_POST['personal-name-register'], FILTER_SANITIZE_STRING),
            "Cognome" => filter_var($_POST['personal-cognome-register'], FILTER_SANITIZE_STRING),
            "Email" => filter_var($_POST['personal-email-register'], FILTER_SANITIZE_EMAIL),
            "Password" => $_POST['personal-password-register']
        );
        $response = $costumer->signin(COSTUMER, $params);
        if (is_array($response) && $response["Status"] == ERROR) {
            $error_register = $response["msg"];
        } else {
            header("Location: index.php");
        }
    }

    if (isset($_POST['business-btn-register'])) {
        $bussiness = new SellerHelper();

        $params = array(
            "Nome" => filter_var($_POST['business-name-register'], FILTER_SANITIZE_STRING),
            "Cognome" => filter_var($_POST['business-name-register'], FILTER_SANITIZE_STRING),
            "Ragione Sociale" => filter_var($_POST["business-businessname-register"], FILTER_SANITIZE_STRING),
            "P. IVA" => filter_var($_POST["business-businessname-register"], FILTER_SANITIZE_STRING),
            "Email" => filter_var($_POST['business-mail-register'], FILTER_SANITIZE_EMAIL),
            "Password" => $_POST['business-password-register']
        );
        $response = $bussiness->signin(SELLER, $params);
        if (is_array($response) && $response["Status"] == ERROR) {
            $error_register = $response["msg"];
        } else {
            header("Location: dashboard.php"); // TODO: @fede metti il link della dashboard che hai creato
        }
    }
}
