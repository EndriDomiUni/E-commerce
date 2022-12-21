<?php

require("Dbh.php");

try {
    $dbh = new Dbh();
} catch (Exception $e) {
    echo $e->getMessage();
}

if (isset($_POST['personal-btn-register'])) {

    $params = array(
        "Nome" => filter_var($_POST['personal-name-register'], FILTER_SANITIZE_STRING),
        "Cognome" => filter_var($_POST['personal-surname-register'], FILTER_SANITIZE_STRING),
        "Email" => filter_var($_POST['personal-mail-register'], FILTER_SANITIZE_EMAIL),
        "Password" => $_POST['personal-password-register']
    );

    try {
        $response = $dbh->signin(COSTUMER, $params);
        if (is_array($response) && $response["Status"] == ERROR) {
            $error_register = $response["msg"];
        } else {
            header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (isset($_POST['business-btn-register'])) {

    $params = array(
        "Nome" => filter_var($_POST['business-name-register'], FILTER_SANITIZE_STRING),
        "Cognome" => filter_var($_POST['business-name-register'], FILTER_SANITIZE_STRING),
        "Ragione Sociale" => filter_var($_POST["business-businessname-register"], FILTER_SANITIZE_STRING),
        "P. IVA" => filter_var($_POST["business-businessname-register"], FILTER_SANITIZE_STRING),
        "Email" => filter_var($_POST['business-mail-register'], FILTER_SANITIZE_EMAIL),
        "Password" => $_POST['business-password-register']
    );
    $response = $dbh->signin(SELLER, $params);
    if (is_array($response) && $response["Status"] == ERROR) {
        $error_register = $response["msg"];
    } else {
        header("Location: dashboard.php"); // TODO: @fede metti il link della dashboard che hai creato
    }
}
