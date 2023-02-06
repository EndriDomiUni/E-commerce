<section>

    <?php

    // These two lines are used for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

        if (isset($_SESSION["Id"])) {
            $session = new Session($_SESSION["Id"]);
            $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);

            if ($claimType === CLAIM_USER_DESC || $claimType === CLAIM_SELLER_PR0_DESC) {
                $articlesInCart = $session->loadArticlesInCart($session->getCurrentUser()[CARRELLO_ID]);

                if ($articlesInCart !== CARRELLO_UNSET) {
                    if (is_array($articlesInCart) && !empty($articlesInCart)) {

                        foreach ($articlesInCart as $value) {
                            $whereArticleId = "Id = " . $value[ARTICOLO_ID];
                            $article = $session->getRecord(ARTICOLO, $whereArticleId);

                            $whereProductId = "Id = " . $article[PRODOTTO_ID];
                            $product = $session->getRecord(PRODOTTO, $whereProductId);
                                if ($product !== null) {

                                    // da aggiungere immagine, pulsanti quantità

                                    echo '<div class="card">
                                           <div class="card-body">
                                               <h5 class="card-title">' . $product[NOME] . '</h5>
                                               <p class="card-text">' . $product[DESCRIZIONE] . '</p>
                                               <p class="card-text">' . $value[QUANTITA] . '</p> <!-- da aggiungere due pulsanti -->
                                               <p class="card-text"> Prezzo:' . $article[PREZZO] . '</p>
                                           </div>
                                         </div>';
                                }
                        }
                    }
                } else {
                    echo "è vuoto.";
                }
            }
        }
    ?>
</section>


