<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";


if(isset($_SESSION[ID])) {

    $session = new Session($_SESSION[ID]);
    $products = $session->getAllProductsBySeller($session->getCurrentUser()[ID]);
    foreach ($products as $product) {

        //debug
        //echo "product id: " . $product[0][ID] . "</br>";

        if (isset($_POST['add-product-' . $product[0][ID] . '-configuration']) ||
            isset($_POST['edit-product-' . $product[0][ID]]) ||
            isset($_POST['delete-product-' . $product[0][ID]])) {
        }


        switch (true){
            case isset($_POST['add-product-' . $product[0][ID] . '-configuration']):
                $_SESSION[PRODOTTO_ID] = $product[0][ID];
                header("Location: selectVariations.php");
                break;
            case isset($_POST['edit-product-' . $product[0][ID]]):
                $_SESSION[PRODOTTO_ID] = $product[0][ID];
                header("Location: editProduct.php");
                break;
            case isset($_POST['delete-product-' . $product[0][ID]]):
                break;

        }
    }
}
else{
    header("Location: index.php");
}
