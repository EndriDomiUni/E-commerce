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

                        $finalAmount = $finalAmount + floatval($article[PREZZO]) * $articleInCart[QUANTITA];

                        echo '
                <div class="container py-5 ">
                    <div class="row mt-2 mb-2">
                        <div class="col-md-2">
                            <img
                                    src="' . UPLOADS . '/' . $product[IMMAGINE] . '"
                                    alt="Product Image"
                                    class="img-fluid"
                            />
                        </div>
                        <div class="col-md-4">
                            <h3>' . $product[NOME] . '</h3>
                            <p>' . $product[DESCRIZIONE] . '</p>';

                        $articleConfigurations = $session->getArticleConfigurations($article[ID]);

                        foreach ($articleConfigurations as $articleConfiguration) {
                            $whereOptionId = '`Id` = ' . $articleConfiguration[OPZIONE_ID];
                            $optionVariation = $session->getRecord(OPZIONE_VARIAZIONE, $whereOptionId);
                            $whereVariationId = '`Id` = ' . $optionVariation[VARIAZIONE_ID];
                            $variation = $session->getRecord(VARIAZIONE, $whereVariationId);
                            echo '
                            <h5>' . $variation[NOME] . '</h5>
                            <p>' . $optionVariation[VALORE] . '</p>';
                        }
                        echo '
                        </div>
                        <div class="col-md-2">
                            <h4>Quantity</h4>
                            <p>' . $articleInCart[QUANTITA] . '</p>
                        </div>
                        <div class="col-md-2">
                            <h4>' . EURO . ' ' . $article[PREZZO] . '</h4>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col"></div>
                        <div class="col">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Seleziona tipologia ordine</option>
                                <option value="1">Standard</option>
                                <option value="2">Mensile</option>
                                <option value="3">Trimestrale</option>
                                <option value="4">Annuale</option>
                                <option value="5">Pagamento a rate</option>
                            </select>
                        </div>
                        <div class="col"></div>
                    </div>    
                    <div class="row mt-2">
                        <hr>
                    </div>
                </div>        
            ';

                    }
                }
            }
            echo '<!-- Cart Total -->
                            <div class="row mt-3">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <h4>Cart Total: ' . EURO . ' ' . $finalAmount . ' </h4>
                                </div>
                            </div>';
            echo '
                            <div class="row mt-3">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">                                   
                                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="btn-go-checkout"">Checkout</button>
                                </div>
                            </div>';
            echo '</form>';
        } else {
            echo '<div>Non ci sono articoli in carrello! <a class="btn btn-outline-secondary" href="./index.php">Aggiungine uno!</a></div>';
        }

    } else {
        header("Location: login.php");
    }
    ?>
</div>
