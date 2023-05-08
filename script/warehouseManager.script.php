<?php

// queste due linee fungono da debugger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";


if(isset($_SESSION[ID])) {

    $session = new Session($_SESSION[ID]);
    $warehouses = $session->getWarehouses();
    foreach ($warehouses as $warehouse) {
        $warehouseTag = 'manage-articles-' . $warehouse[ID];

        //debug
        //echo "product id: " . $product[0][ID] . "</br>";

        if (isset($_POST[$warehouseTag])) {
            $articlesInStock = $session->getArticlesInStock($warehouse[ID]);
            //TODO: gestire creazione card per ogni configurazione articolo
            $_SESSION[MAGAZZINO_ID] = $warehouse[ID];
            header('Location: articlesInStockManager.php');
        }

    }
}
else{
    header("Location: index.php");
}
