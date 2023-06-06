<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

/**
 * @param Session $session
 * @param $articleId
 * @return void
 */

if (isset($_SESSION[ID])) {
    $session = new Session($_SESSION[ID]);
    $products = $session->getAllProductsBySeller($session->getCurrentUser()[ID]);

    foreach ($products as $product) {

        $articles = $session->getArticlesByProductId($product[0][ID]);

        foreach ($articles as $article) {

            $mapConfigurations = getMapArticleConfigurations($session, $article[ID]);
            $buttonName = "";
            for ($i = 0; $i < count($mapConfigurations); $i++) {
                if ($i > 0) {
                    $buttonName = $buttonName . "-";
                }
                $buttonName = $buttonName . array_values($mapConfigurations[$i])[0];
            }

        }

        $buttonName = 'edit-quantity-' . $product[0][ID];
        if (isset($_POST[$buttonName])) {

            $quantityToEdit = filter_var($_POST['quantity-input2-' . $product[0][ID]], FILTER_SANITIZE_SPECIAL_CHARS);
            $articleId = filter_var($_POST['article-configurations-select2-' . $product[0][ID]], FILTER_SANITIZE_SPECIAL_CHARS);
            if (isset($quantityToEdit) && isset($articleId)) {
                $articleInStockId = $session->getWarehouseArticle($articleId, $_SESSION[MAGAZZINO_ID]);
                $quantityToUpdate = $quantityToEdit + $session->selectSpecificField(ARTICOLO_IN_MAGAZZINO,
                        QUANTITA, 'ID = ' . $articleInStockId[ID]);
                $session->addArticleInStockQuantity($articleInStockId, $quantityToUpdate);
                header('Location: articlesInStockManager.php');

            }
        } elseif ((isset($_POST['move-' . $product[0][ID]]))) {
            $quantityToEdit = filter_var($_POST['quantity-input1-' . $product[0][ID]], FILTER_SANITIZE_SPECIAL_CHARS);
            $articleId = filter_var($_POST['article-configurations-select1-' . $product[0][ID]], FILTER_SANITIZE_SPECIAL_CHARS);
            $warehouseId = filter_var($_POST['warehouse-select1-' . $product[0][ID]]);
            if (isset($quantityToEdit) && isset($articleId) && isset($warehouseId)) {
                //se esiste articolo in magazzino aggiorna quantità
                //altrimenti inserire nuovo record
                $articleInStock = $session->getWarehouseArticle($articleId, $warehouseId);
                $articleInStockOrigin = $session->getRecord(ARTICOLO_IN_MAGAZZINO, ARTICOLO_ID . ' = ' . $articleId
                    . ' AND ' . MAGAZZINO_ID . ' = ' . $_SESSION[MAGAZZINO_ID]);
                if ($session->checkArticleInStockQuantity((int)$articleInStockOrigin[QUANTITA], (int)$quantityToEdit)) {
                    $originArticleInStockQuantityToUpdate = (int)$articleInStockOrigin[QUANTITA] - (int)$quantityToEdit;

                    if (!empty($articleInStock)) {
                        //update origin article in stock quantity
                        $session->updateQuantityArticleInStock($originArticleInStockQuantityToUpdate, $articleInStockOrigin[ID]);

                        //update destination article in stock quantity
                        $session->updateQuantityArticleInStock($quantityToEdit, $articleInStock[ID]);
                        header ("Location: warehousesManager.php");
                    }
                    else {
                        //TODO: togliere tassa e data fine dal db
                        $res = $session->insertArticleInStock($quantityToEdit, $articleId, $warehouseId);
                        $result = $session->isInsertSuccessful(ARTICOLO_IN_MAGAZZINO, $res);
                        if ($result) {
                            //update origin article in stock quantity
                            $session->updateQuantityArticleInStock($quantityToEdit, $articleInStockOrigin[ID]);
                            header ("Location: articlesInStockManager.php");
                        } else {
                            var_dump("Errore nello spostamento dell'articolo in magazzino");
                        }
                    }
                }
                else
                {
                    //Error quantity: impossible operation
                    header("Location: warehousesManager.php");
                }

            }
        } elseif ((isset($_POST['remove-' . $product[0][ID]]))) {
            //TODO: completare delete
            $articleId = filter_var($_POST['article-configurations-select3-' . $product[0][ID]], FILTER_SANITIZE_SPECIAL_CHARS);
            $articleInStock = $session->getWarehouseArticle($articleId, $_SESSION[MAGAZZINO_ID]);
            $session->deleteArticleInStock($articleInStock[ID]);
            header ("Location: warehousesManager.php");

            //TODO: remove articles in stock
        }
    }
}

/**
 * Get map of article configurations
 * @param Session $session
 * @param $articleId
 * @return array
 */
function getMapArticleConfigurations(Session $session, $articleId): array
{
    $mapConfigurations = [];
    $articleConfigurations = $session->getArticleConfigurations($articleId);
    foreach ($articleConfigurations as $articleConfiguration) {
        $option = $session->getOptionById($articleConfiguration[OPZIONE_ID]);
        $variation = $session->getVariationById($option[VARIAZIONE_ID]);
        $configuration = [$option[ID] => $option[VALORE]];
        $mapConfigurations[] = $configuration;
    }
    return $mapConfigurations;
}

function generateWarehouseOptions(Session $session) : void
{

    //$warehouses = $session->getWarehousesExpectParam($_SESSION[MAGAZZINO_ID]);
    $warehouses = $session->getRecord(MAGAZZINO, 'Id != ' . $_SESSION[MAGAZZINO_ID]);
    if (!empty($warehouses)) {
        if (isset($warehouses[ID]))
        {
            $warehouseAddress = $session->getAddress(addressId: $warehouses[INDIRIZZO_ID]);
            echo '<option value="' . $warehouses[ID] . '">';
            echo $warehouseAddress[CITTA] . ': ' . $warehouseAddress[VIA] . ' - ' . $warehouseAddress[NUMERO_CIVICO];
            echo '</option>';
        }
        else {
            foreach ($warehouses as $warehouse)
            {
                $warehouseAddress = $session->getAddress(addressId: $warehouse);
                echo '<option value="' . $warehouses[0]. '">';
                echo $warehouseAddress[CITTA] . ': ' . $warehouseAddress[VIA] . ' - ' . $warehouseAddress[NUMERO_CIVICO];
                echo '</option>';
            }
        }

    }

}
