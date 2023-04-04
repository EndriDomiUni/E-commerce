<section>

    <?php

    // These two lines are used for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    if (isset($_SESSION["Id"])) {

        $session = new Session($_SESSION["Id"]);
        $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);

        switch ($claimType) {
            case CLAIM_USER_DESC:
            case CLAIM_USER_PRO_DESC:
                $cartId = $session->getCurrentUser()[CARRELLO_ID];
                if ($cartId !== CARRELLO_UNSET) {
                    $articlesInCart = $session->loadArticlesInCart($cartId);
                    if ($articlesInCart !== CARRELLO_UNSET) {
                        if (is_array($articlesInCart) && !empty($articlesInCart)) {
                            foreach ($articlesInCart as $value) {
                                $whereArticleId = "Id = " . $value[ARTICOLO_ID];
                                $article = $session->getRecord(ARTICOLO, $whereArticleId);
                                if ($article !== null) {
                                    $whereProductId = "Id = " . $article[PRODOTTO_ID];
                                    $product = $session->getRecord(PRODOTTO, $whereProductId);
                                    if ($product !== null) {
                                        echo '<div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">' . $product[NOME] . '</h5>
                                                    <p class="card-text">' . $product[DESCRIZIONE] . '</p>
                                                    <p class="card-text">' . $value[QUANTITA] . '</p> <!-- da aggiungere due pulsanti -->
                                                    ';

                                        $articleConfigurations = $session->getArticleConfigurations($article[ID]);

                                        foreach ($articleConfigurations as $articleConfiguration){

                                            $whereOptionId = '`Id` = ' . $articleConfiguration[OPZIONE_ID];
                                            $optionVariation = $session->getRecord(OPZIONE_VARIAZIONE, $whereOptionId);
                                            $whereVariationId = '`Id` = ' . $optionVariation[VARIAZIONE_ID];
                                            $variation = $session->getRecord(VARIAZIONE, $whereVariationId);
                                            echo '<p class="card-text">' . $variation[NOME] . '</p>';
                                            echo '<p class="card-text">' . $optionVariation[VALORE] . '</p>';
                                        }
                                        echo '
                                                    <p class="card-text"> Prezzo:' . $article[PREZZO] . '</p>
                                                </div>
                                            </div>';
                                    }
                                }
                            }
                        }
                    }
                }
                break;

            case CLAIM_SELLER_DESC:
            case CLAIM_SELLER_PR0_DESC:
                break;
        }
    } else {
        echo "sono qui";
    }
    ?>
</section>