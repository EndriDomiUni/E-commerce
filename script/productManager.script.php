<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";

$session = new Session($_SESSION[ID]);


if (isset($_POST['add-article-in-cart']) || isset($_POST['buy-now'])){

    $productId = $_POST["product-id"];
    $quantity = $_POST["article-quantity"];

    $cartId = $session->getUserCartIdFromDb();
    $optionsVariations = array();
    $variations = $session->getVariations();
    $optionsSelected = array();
    foreach ($variations as $variation) {
        //debug
        //echo "variationId: ".$variation[ID]."</br>";
        $variationTagName = 'product-variation-' . $variation[ID];
        if (isset($_POST[$variationTagName])) {
            $variationIdSelect = $_POST[$variationTagName];
            $optionsSelected[] = $variationIdSelect;
            //debug
            //echo "variationIdSelect: ".$variationIdSelect."</br>";
        }
    }

    $rightArticle = [];
    $articles = $session->getArticlesByProductId($productId);
    foreach ($articles as $article){
        $articleConfigurations = $session->getArticleConfigurations($article[ID]);
        $checkConfigurations = [];
        foreach ($articleConfigurations as $articleConfiguration){
            foreach ($optionsSelected as $option){
                if ($articleConfiguration[OPZIONE_ID] === $option[ID]){
                    $checkConfigurations[] = $articleConfiguration;
                    break;
                }
            }
        }
        if (sizeof($checkConfigurations) === sizeof($optionsSelected)){
            $rightArticle = $article;
            break;
        }
    }
    if (sizeof($rightArticle) === 0){
        // nessun articolo presente con le opzioni selezionate
        //TODO: alert
    } else {
        $params = array(
            QUANTITA => $quantity,
            CARRELLO_ID => $cartId,
            ARTICOLO_ID => $rightArticle[ID]
        );
        $response = $session->addArticleInCart($params);
        if($response){
            if (isset($_POST['buy-now'])){
                header("Location: checkout.php");
            } else {
                //toast
            }
        }
    }
} else if(isset($_POST['add-product-in-wishlist'])) {

    $productId = $_POST["product-id"];
    $res = $session->addProductInWishlist($productId);
    if (!$res){
        // error add product in wishlist
    } else {
        //toast
    }
}
