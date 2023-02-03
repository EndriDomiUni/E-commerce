<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";


$session = new Session($_SESSION["Id"]);

if (isset($_POST['product-btn-insert']))
{
    $params = array(
        NOME => filter_var($_POST['product-name'], FILTER_SANITIZE_SPECIAL_CHARS),
        DESCRIZIONE => filter_var($_POST['product-description'], FILTER_SANITIZE_SPECIAL_CHARS),
        IMMAGINE => $_POST['product-image'],
        DIMENSIONE_X_PRODOTTO => filter_var($_POST['product-dimensionX'], FILTER_SANITIZE_SPECIAL_CHARS),
        DIMENSIONE_Y_PRODOTTO => filter_var($_POST['product-dimensionY'], FILTER_SANITIZE_SPECIAL_CHARS),
        DIMENSIONE_Z_PRODOTTO => filter_var($_POST['product-dimensionZ'], FILTER_SANITIZE_SPECIAL_CHARS),
        CATEGORIA_ID => filter_var($_POST['product-category'], FILTER_SANITIZE_SPECIAL_CHARS)
    );
    try {
        $response = $session->insertProduct($params);
        if($response)
        {
            $session[PRODOTTO_ID] = $response;
            $session[CATEGORIA_ID] = $params[CATEGORIA_ID];
            header("Location: selectVariations.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}