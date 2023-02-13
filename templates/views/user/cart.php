<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "UIHelper.php";
?>

<!-- Shopping Cart Section -->
<div class="container my-5">
    <h2 class="text-center">Shopping Cart</h2>
    <!-- Cart Item -->
    <?php
        if (isset($_SESSION[ID])) {
            $session = new Session($_SESSION[ID]);
            $articlesInCart = $session->loadArticlesInCart($session->getCurrentUser()[CARRELLO_ID]);

            $finalAmount = 0.00;
            if (is_array($articlesInCart) && !empty($articlesInCart)) {
                echo '<form method="post">';
                foreach ($articlesInCart as $articleInCart) {
                    $articleId = $articleInCart[ARTICOLO_ID];
                    $whereArticle = "Id = " . $articleId;
                    $article = $session->getRecord(ARTICOLO, $whereArticle);

                    if ($article !== null) {
                        if (isset($article[PRODOTTO_ID]) && $article[PRODOTTO_ID] > 0) {
                            $whereProduct = "Id = " . $article[PRODOTTO_ID];
                            $product = $session->getRecord(PRODOTTO, $whereProduct);

                            $finalAmount = $finalAmount + floatval($article[PREZZO]);
                            echo '<div class="row">
                        <div class="col-md-2">
                            <img
                                    src="'. UPLOADS. '/' . $product[IMMAGINE] .'"
                                    alt="Product Image"
                                    class="img-fluid"
                            />
                        </div>
                        <div class="col-md-4">
                            <h4>' . $product[NOME] .'</h4>
                            <p>' . $product[DESCRIZIONE] .'</p>
                        </div>
                        <div class="col-md-2">
                            <h4>' . EURO . ' ' . $article[PREZZO] .'</h4>
                        </div>
                        <div class="col-md-2">
                            <h4>Quantity</h4>
                            <input type="number" class="form-control" value="1" />
                        </div>
                        <div class="col-md-2">
                            <h4>' . EURO . ' ' . $article[PREZZO] .'</h4>
                        </div>
                    </div>';

                            echo '<!-- Cart Total -->
                            <div class="row mt-3">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <h4>Cart Total: ' . EURO . ' ' . $finalAmount .' </h4>
                                </div>
                            </div>';
                        }
                        }
                }
                echo '
                            <div class="row mt-3">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <a href="#" class="btn btn-primary btn-block">Checkout</a>
                                </div>
                            </div>';
                echo '</form>';
            } else {
                echo '<div>Non ci sono articoli in carrello</div>';
            }

        } else {
            header("Location: login.php");
        }
    ?>
</div>