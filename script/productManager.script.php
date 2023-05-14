<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";

$dbh = new Dbh();

$products = $dbh->getProducts();
foreach ($products as $product) {

    if (
        isset($_POST['add-article-' . $product[ID] . '-in-cart']) ||
        isset($_POST['buy-now-' . $product[ID]]) ||
        isset($_POST['add-product-' . $product[ID] . '-in-wishlist'])||
        isset($_POST['btn-remove-'. $product[ID] . '-from-cart'])
    ) {
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

            // by default = 1
            $quantity = 1;
            if (isset($_POST["article-quantity"])) {
                $quantity = $_POST["article-quantity"];
            }

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
                            $checkConfigurations[] = $articleConfiguration;
                            break;
                        }
                    }
                }
                if (sizeof($checkConfigurations) === sizeof($optionsSelected)) {
                    $rightArticle = $article;
                    $whereArticleId = "Id = " . $article[ID];
                    if ($session->getRecord(ARTICOLO, $whereArticleId) !== null) {
                        switch (true) {
                            case isset($_POST['buy-now-' . $product[ID]]):
                                if ($quantity > 0 && $session->getCurrentUser()[CARRELLO_ID] > 0 && $article[ID] > 0){
                                    $res = $session->addArticleInCart($quantity, $session->getCurrentUser()[CARRELLO_ID], $article[ID]);
                                    if (UtilsFunctions::checkResponse($res)){
                                        header("Location: cart.php");
                                    }
                                }
                                break;
                            case isset($_POST['add-article-' . $product[ID] . '-in-cart']):
                                if ($quantity > 0 && $session->getCurrentUser()[CARRELLO_ID] > 0 && $article[ID] > 0){
                                    $res = $session->addArticleInCart($quantity, $session->getCurrentUser()[CARRELLO_ID], $article[ID]);
                                    if (UtilsFunctions::checkResponse($res)){
                                        echo '<div class="alert alert-success" role="alert">
                                                <h4 class="alert-heading">Articolo inserito con successo</h4>
                                              </div>';
                                    }
                                }
                                break;
                            case isset($_POST['btn-remove-'. $product[ID] . '-from-cart']):
                                if ($quantity > 0 && $session->getCurrentUser()[CARRELLO_ID] > 0 && $article[ID] > 0){
                                    $res = $session->removeArticleInCart($quantity, $session->getCurrentUser()[CARRELLO_ID], $article[ID]);
                                    if (UtilsFunctions::checkResponse($res)){
                                        echo '<div class="alert alert-success" role="alert">
                                                <h4 class="alert-heading">Articolo inserito con successo</h4>
                                              </div>';
                                    }
                                }
                                break;
                        }
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