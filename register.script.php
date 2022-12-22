<?php


require_once("./config/AppConstans.php");
include("Dbh.php");


$dbh = null;
if (isset($_POST['personal-btn-register'])) {
    $params = array(
        "Nome" => filter_var($_POST['personal-name-register'], FILTER_SANITIZE_STRING),
        "Cognome" => filter_var($_POST['personal-surname-register'], FILTER_SANITIZE_STRING),
        "Email" => filter_var($_POST['personal-mail-register'], FILTER_SANITIZE_EMAIL),
        "Password" => $_POST['personal-password-register']
    );
    try {
        $dbh = new Dbh();
        $response = $dbh->signIn('cliente', $params);
        if ($response["Status"] == ERROR) {
            $error_register = $response["msg"];
        } else {
            // redirect to index
            //header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (isset($_POST['business-btn-register'])) {
    $params = array(
        "Nome" => filter_var($_POST['business-name-register'], FILTER_SANITIZE_STRING),
        "Cognome" => filter_var($_POST['business-name-register'], FILTER_SANITIZE_STRING),
        "Ragione_Sociale" => filter_var($_POST["business-businessname-register"], FILTER_SANITIZE_STRING),
        "P._IVA" => filter_var($_POST["business-businessname-register"], FILTER_SANITIZE_STRING),
        "Email" => filter_var($_POST['business-mail-register'], FILTER_SANITIZE_EMAIL),
        "Password" => $_POST['business-password-register']
    );
    try {
        $dbh = new Dbh();
        $response = $dbh->signIn('venditore', $params);
        if ($response["Status"] == ERROR) {
            $error_register = $response["msg"];
        } else {
            // redirect to dashboard // TODO: @fede inserisci la dashboard
            //header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
