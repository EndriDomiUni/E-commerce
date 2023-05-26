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
            $quantityToEdit = filter_var($_POST['quantity-input-' . $product[0][ID]], FILTER_SANITIZE_SPECIAL_CHARS);
            $articleId = filter_var($_POST['article-configurations-select-' . $product[0][ID]], FILTER_SANITIZE_SPECIAL_CHARS);
            if (isset($quantityToEdit) && isset($articleId)) {
                $articleInStockId = $session->getWarehouseArticle($articleId, $_SESSION[MAGAZZINO_ID]);
                $quantityToUpdate = $quantityToEdit + $session->selectSpecificField(ARTICOLO_IN_MAGAZZINO,
                        QUANTITA, 'ID = ' . $articleInStockId[ID]);
                $session->AddArticleInStockQuantity($articleInStockId, $quantityToUpdate);
                header('Location: articlesInStockManager.php');

            }
        }
        elseif ((isset($_POST['move-button-' . $product[0][ID]]))) {
            //TODO: move articles in stock to another warehouse
        } elseif ((isset($_POST['remove-button-' . $product[0][ID]]))) {
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


function generateOptionsVariation($session, $articles) : void
{
    foreach ($articles as $article)
    {
        $mapConfigurations = getMapArticleConfigurations($session, $article[ID]);
        echo '<option value="' . $article[ID] . '">';
        for ($i = 0; $i < count($mapConfigurations); $i++) {

            if ($i > 0) {
                echo ' ';
            }

            //$variationName = array_keys($mapConfigurations[$i])[0];
            $optionValue = array_values($mapConfigurations[$i])[0];
            echo   $optionValue;
        }
        echo '</option>';
    }
}

function generateWarehouseOptions($session) : void
{
    $warehouses = $session->GetWarehousesExpectParam($_SESSION[MAGAZZINO_ID]);
    foreach ($warehouses as $warehouse)
    {
        echo '<option value="' . $warehouse[ID] . '">';
        echo $warehouse[CITTA] . ' ' . $warehouse[INDIRIZZO];
        echo '</option>';
    }
}