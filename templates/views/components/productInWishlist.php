<section>
    <?php

    // These two lines are used for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (isset($_SESSION["Id"])) {
        $session = new Session($_SESSION["Id"]);
        echo "raccolda id: " . $session->getCurrentUser()[RACCOLTA_ID] . '</br>';
        if ($session->getCurrentUser()[RACCOLTA_ID] !== null && $session->getCurrentUser()[RACCOLTA_ID] !== RACCOLTA_UNSET) {
            $articlesInCollection = $session->loadProductInWishlist();
            if (is_array($articlesInCollection) && !empty($articlesInCollection)) {
                foreach ($articlesInCollection as $value) {
                    $whereProductId = "Id = " . $value[PRODOTTO_ID];
                    $product = $session->getRecord(PRODOTTO, $whereProductId);
                    if ($product !== null) {
                        echo '<div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">' . $product[NOME] . '</h5>
                                                <p class="card-text">' . $product[DESCRIZIONE] . '</p>
                                            </div>
                                        </div>';
                    }
                }
            }
        }
    }

    ?>
</section>
