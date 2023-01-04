<?php

require_once("./config/AppConstants.php");
include("Dbh.php");

$dbh = null;

if (isset($_POST['product-btn-insert'])) {
    $params = array(
        "Nome" => filter_var($_POST['productName'], FILTER_SANITIZE_STRING),
        "Descrizione" => filter_var($_POST['productDescriprion'], FILTER_SANITIZE_STRING),
        "Prezzo" => filter_var($_POST['productPrice'], FILTER_SANITIZE_STRING)
    );
    try {
        $dbh = new Dbh();
        $response = $dbh->signIn(COSTUMER, $params);
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