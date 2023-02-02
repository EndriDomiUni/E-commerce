<?php

require_once("./config/AppConstants.php");
include("Dbh.php");
use utility\Utils;

$dbh = null;
$session = new Session($_SESSION["Id"]);


if (isset($_POST['product-btn-insert']))
{
    $params = array(
        NOME => filter_var($_POST['productName'], FILTER_SANITIZE_SPECIAL_CHARS),
        DESCRIZIONE => filter_var($_POST['productDescription'], FILTER_SANITIZE_SPECIAL_CHARS),
        IMMAGINE => $_POST['productImage'],
        DIMENSIONE_X_PRODOTTO => filter_var($_POST['productDimensionX'], FILTER_SANITIZE_SPECIAL_CHARS),
        DIMENSIONE_Y_PRODOTTO => filter_var($_POST['productDimensionY'], FILTER_SANITIZE_SPECIAL_CHARS),
        DIMENSIONE_Z_PRODOTTO => filter_var($_POST['productDimensionZ'], FILTER_SANITIZE_SPECIAL_CHARS),
        CATEGORIA_ID => filter_var($_POST['productCategory'], FILTER_SANITIZE_SPECIAL_CHARS)
    );
    try {
        $dbh = new Dbh();
        $response = $dbh->insertProduct($params);
        if($response)
        {
            $session[CATEGORIA_ID] = $params[CATEGORIA_ID];
            header("Location: selectVariations.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}