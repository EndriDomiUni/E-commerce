<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";



$dbh = new Dbh();

$products = $dbh->getProducts();
foreach ($products as $product) {

    if (isset($_POST['add-article-' . $product[ID] . '-in-cart']) ||
        isset($_POST['buy-now-' . $product[ID]]) ||
        isset($_POST['add-product-' . $product[ID] . '-in-wishlist'])) {

        if (!isset($_SESSION[ID])){
            header("Location: login.php");
        }
        else {
            $session = new Session($_SESSION[ID]);

            switch (true) {
                case isset($_POST['add-article-' . $product[ID] . '-in-cart']):
                    //debug
                    echo 'add-article' . $product[ID] . '-in-cart';
                    $quantity = $_POST["article-quantity"];
                    $optionsVariations = array();
                    $variations = $dbh->getVariations();
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
                    $articles = $dbh->getArticlesByProductId($product[ID]);
                    foreach ($articles as $article) {
                        $articleConfigurations = $dbh->getArticleConfigurations($article[ID]);
                        $checkConfigurations = [];
                        foreach ($articleConfigurations as $articleConfiguration) {
                            foreach ($optionsSelected as $option) {
                                //var_dump($option);


                                if ("".$articleConfiguration[OPZIONE_ID] === $option) {
                                    echo "</br>";

                                    var_dump($articleConfiguration[OPZIONE_ID]);
                                    echo "</br>";
                                    $checkConfigurations[] = $articleConfiguration;
                                    break;
                                }
                            }
                        }
                        if (sizeof($checkConfigurations) === sizeof($optionsSelected)) {
                            $rightArticle = $article;
                            //debug
                            echo "articolo id: " . $article[ID] . "</br>";
                            $queryInsertArticleInCart = "INSERT INTO `Articolo_in_carrello` (Quantità, Carrello_id, Articolo_id, Status)
                                VALUES (?, ?, ?, ?) ";
                            $result = $dbh->insertData($queryInsertArticleInCart,
                                $quantity,
                                $session->getCurrentUser()[CARRELLO_ID],
                                $article[ID],
                                STATUS_MODIFIED_DATA);
                            if (UtilsFunctions::checkResponse($result)) {
                                //debug
                                echo "Insert article in cart";
                            }
                            break;
                        }
                    }


                    break;
                case isset($_POST['buy-now-' . $product[ID]]):

                    break;
                case isset($_POST['add-product-' . $product[ID] . '-in-wishlist']):

                    break;
            }
        }
    }
}


/*
if (isset($_POST['add-article-in-cart']) || isset($_POST['buy-now'])){





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

*/