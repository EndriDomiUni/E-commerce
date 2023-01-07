<?php

require_once("./config/AppConstants.php");
include("Dbh.php");

$dbh = null;

if (isset($_POST['product-btn-insert'])) {
    $params = array(
        NOME => filter_var($_POST['productName'], FILTER_SANITIZE_SPECIAL_CHARS),
        DESCRIZIONE => filter_var($_POST['productDescription'], FILTER_SANITIZE_SPECIAL_CHARS),
        IMMAGINE => $_POST['productImage'],
        DIMENSIONE_ID => filter_var($_POST['productDimension'], FILTER_SANITIZE_SPECIAL_CHARS),
        CATEGORIA_ID => filter_var($_POST['productCategory'], FILTER_SANITIZE_SPECIAL_CHARS)
    );
    try {
        $dbh = new Dbh();
        $response = $dbh->signIn(COSTUMER, $params);
        if ($response["Status"] == ERROR) {
            $error_register = $response["msg"];
        } else {
            // redirect to index
            // header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}