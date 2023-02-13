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


        if (!isset($_SESSION[ID])) {
            header("Location: login.php");
        } else {



            $session = new Session($_SESSION[ID]);

            if (isset($_POST['add-product-' . $product[ID] . '-in-wishlist'])){
                $res = $session->addProductInWishlist($session->getCurrentUser()[RACCOLTA_ID],
                    $product[ID]);
                if (UtilsFunctions::checkResponse($res)){
                    echo '<div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Prodotto aggiunto in raccolta</h4>
                        </div>';
                    break;
                }
            }

            $quantity = $_POST["article-quantity"];


            //debug
            //echo 'add-article' . $product[ID] . '-in-cart';

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

                        if ("" . $articleConfiguration[OPZIONE_ID] === $option) {
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
                    //echo "articolo id: " . $article[ID] . "</br>";

                    $whereArticleId = "Id = " . $article[ID];
                    if ($session->getRecord(ARTICOLO, $whereArticleId) !== null) {

                        controller($session, $quantity, $session->getCurrentUser()[CARRELLO_ID], $article[ID], $product[ID]);

                    } else {
                        echo '<div class="alert alert-warning" role="alert">
                                          <h4 class="alert-heading">Articolo selezionato non esistente</h4>
                                          <hr>
                                          <p class="mb-0">Seleziona una configurazione diversa</p>
                                        </div>';
                    }
                    break;
                }
            }
        }
    }
}

function controller($session, $quantity, $cartId, $articleId, $productId): void
{
    switch (true){
        case isset($_POST['buy-now-' . $productId]):
            if ($quantity > 0 && $cartId > 0 && $articleId > 0){
                $res = $session->addArticleInCart($quantity, $cartId, $articleId);
                if (UtilsFunctions::checkResponse($res)){
                    header("Location: cart.php");
                }
            }
            break;
        case isset($_POST['add-article-' . $productId . '-in-cart']):
            if ($quantity > 0 && $cartId > 0 && $articleId > 0){
                $res = $session->addArticleInCart($quantity, $cartId, $articleId);
                if (UtilsFunctions::checkResponse($res)){
                    echo '<div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Articolo inserito con successo</h4>
                        </div>';
                }
            }
            break;
    }
}



/*
private function getArticle($session, $product)
{
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

                if ("" . $articleConfiguration[OPZIONE_ID] === $option) {
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

            $whereArticleId = "Id = " . $article[ID];
            if ($session->getRecord(ARTICOLO, $whereArticleId) !== null) {
                return $article;
            } else {
                return null;
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