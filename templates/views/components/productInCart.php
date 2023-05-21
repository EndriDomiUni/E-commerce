
<style>

    .card {
        max-height: 50vh;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }

    .card-img-top {
        object-fit: cover;
    }

    .card-body {
        padding: 10px;
    }

    .card-img-top {
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .card-title {
        font-size: 18px;
        text-align: center;
    }

    .card-text {
        margin-bottom: 5px;
    }
    
    .card-footer {
        background-color: #f8f8f8;
        padding: 5px;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }
</style>


<section>

    <?php

    // These two lines are used for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (isset($_SESSION["Id"])) {

        // get claim
        $session = new Session($_SESSION["Id"]);
        $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);

        switch ($claimType) {
            case CLAIM_USER_DESC:
            case CLAIM_USER_PRO_DESC:

                // get cart id
                $cartId = $session->getCurrentUser()[CARRELLO_ID];
                if ($cartId !== CARRELLO_UNSET) {

                    // get articles in cart
                    $articlesInCart = $session->loadArticlesInCart($cartId);
                        if (is_array($articlesInCart) && !empty($articlesInCart)) {
                            foreach ($articlesInCart as $value) {

                                // get article data
                                $whereArticleId = "Id = " . $value[ARTICOLO_ID];
                                $article = $session->getRecord(ARTICOLO, $whereArticleId);

                                if ($article !== null) {

                                    // get product data
                                    $whereProductId = "Id = " . $article[PRODOTTO_ID];
                                    $product = $session->getRecord(PRODOTTO, $whereProductId);

                                    if ($product !== null) {

                                        // get articles config
                                        $articleConfigurations = $session->getArticleConfigurations($article[ID]);

                                        // draw card
                                        echo '
                                            <form method="post">
                                            <div class="card card-sm py-2">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" class="card-img-top img-fluid" alt="Immagine articolo" style="max-height: 150px;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-center">
                                                                <h5 class="card-title">' . $product[NOME] . '</h5>
                                                            </div>
                                                            <p class="card-text">' . $product[DESCRIZIONE] . '</p> ';


                                        foreach ($articleConfigurations as $articleConfiguration){
                                            // get articles options & variations
                                            $whereOptionId = '`Id` = ' . $articleConfiguration[OPZIONE_ID];
                                            $optionVariation = $session->getRecord(OPZIONE_VARIAZIONE, $whereOptionId);
                                            $whereVariationId = '`Id` = ' . $optionVariation[VARIAZIONE_ID];
                                            $variation = $session->getRecord(VARIAZIONE, $whereVariationId);
                                            echo            '<p class="card-text">' . $variation[NOME] . '</p>
                                                            <p class="card-text">' . $optionVariation[VALORE] . '</p>';
                                        }

                                        echo            '
                                                            <p class="card-text">Quantità: ' . $value[QUANTITA] . '
                                                                <select class="form-select" aria-label="Quantità">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </p>
                                                            <p class="card-text"><strong>Prezzo:</strong> $ ' . $article[PREZZO] . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-primary btn-sm float-end" 
                                                    type="submit" name="btn-remove-'. $value[ID] . '-from-cart">Rimuovi dal carrello</button>
                                                </div>
                                            </div>
                                            </form>';
                                    }
                                }
                        }
                    }
                }
                break;
        }
    } else {
        echo "Errore!";
    }
    ?>
</section>






