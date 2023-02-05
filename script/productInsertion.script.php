<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";

$session = new Session($_SESSION[ID]);

if (isset($_POST['product-btn-insert']))
{

    $target_dir = "/uploads/";
    echo "target dir: ".$target_dir."</br>";
    list($result, $msg) = $session->uploadImage($target_dir, $_FILES["product-image"]);
    if($result != 0){
        $params = array(
            NOME => filter_var($_POST['product-name'], FILTER_SANITIZE_SPECIAL_CHARS),
            DESCRIZIONE => filter_var($_POST['product-description'], FILTER_SANITIZE_SPECIAL_CHARS),
            IMMAGINE => $msg,
            DIMENSIONE_X_PRODOTTO => filter_var($_POST['product-dimensionX'], FILTER_SANITIZE_SPECIAL_CHARS),
            DIMENSIONE_Y_PRODOTTO => filter_var($_POST['product-dimensionY'], FILTER_SANITIZE_SPECIAL_CHARS),
            DIMENSIONE_Z_PRODOTTO => filter_var($_POST['product-dimensionZ'], FILTER_SANITIZE_SPECIAL_CHARS),
            CATEGORIA_ID => filter_var($_POST['product-category'], FILTER_SANITIZE_SPECIAL_CHARS)
        );
        try {
            $response = $session->insertProduct($params);
            echo "response: ".$response."</br>";
            if($response)
            {
                echo "[DEBUG:productInsertion.script.php->29]".$response."</br>";
                $_SESSION[PRODOTTO_ID] = $response;
                $_SESSION[CATEGORIA_ID] = $params[CATEGORIA_ID];
                header("Location: selectVariations.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    else {
        echo "Errore caricamento immagine</br>";
    }

}