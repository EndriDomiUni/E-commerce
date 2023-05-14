<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "UIHelper.php";
?>

<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        max-height: 150px;
        object-fit: cover;
        border-radius: 5px;
    }

    .product-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .product-details {
        font-size: 18px;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .quantity-label {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .quantity-select {
        width: 100%;
        font-size: 16px;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ddd;
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .price-label {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 5px;
    }

</style>

<!-- Shopping Cart Section -->
<div class="container">
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
                        $articleConfigurations = $session->getArticleConfigurations($article[ID]);

                        echo '
                              <div class="container py-2">
                                <div class="card">
                                  <div class="row">
                                    <div class="col-md-2">
                                      <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" alt="Product Image" class="img-fluid product-image">
                                    </div>
                                    <div class="col-md-4">
                                      <h3 class="product-name">' . $product[NOME] . '</h3>
                                      <p class="product-details">' . $product[DESCRIZIONE] . '</p>
                                       <div class="col-md-2">';

                                            foreach ($articleConfigurations as $articleConfiguration) {
                                                $whereOptionId = '`Id` = ' . $articleConfiguration[OPZIONE_ID];
                                                $optionVariation = $session->getRecord(OPZIONE_VARIAZIONE, $whereOptionId);
                                                $whereVariationId = '`Id` = ' . $optionVariation[VARIAZIONE_ID];
                                                $variation = $session->getRecord(VARIAZIONE, $whereVariationId);
                                                echo '
                                                <h5>' . $variation[NOME] . '</h5>
                                                <p>' . $optionVariation[VALORE] . '</p>';
                                            }

                        echo          '</div>
                                    </div>
                                    <div class="col-md-2">
                                      <h4 class="quantity-label">Quantità: ' . $articleInCart[QUANTITA] . '</h4>
                                      <select class="form-select quantity-select" aria-label="Default select example">
                                        <option selected="">2</option>
                                        <option value="1">1</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Seleziona tipologia ordine</option>
                                            <option value="1">Standard</option>
                                            <option value="2">Mensile</option>
                                            <option value="3">Trimestrale</option>
                                            <option value="4">Annuale</option>
                                            <option value="5">Pagamento a rate</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                      <h4 class="price-label">€ ' . $article[PREZZO] . '</h4>
                                    </div>
                                  </div>
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
