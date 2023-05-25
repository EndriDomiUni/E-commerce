<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "UIHelper.php";
?>

<!-- Shopping Cart Section -->
<div class="container my-5">
    <h2 class="text-center" style="color: white;">Shopping Cart</h2>
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

                        echo ' <div class="container">
                                <div class="card">
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
                            <div class="row">
                                <div class="col">
                                    <h4>' . $variation[NOME] . '</h4>
                                </div>                             
                                <div class="col">
                                    <p>' . $optionVariation[VALORE] . '</p>
                                </div>
                            </div>
                            ';
                        }
                        echo '
                        </div>
                        <div class="col-md-2">
                            <h4>Quantità:  </h4>
                            <select class="form-select" aria-label="Default select example">                             
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                          
                        <div class="col-md-2">
                            <h4>Prezzo:</h4>
                            <h4>' . EURO . ' ' . $article[PREZZO] . '</h4>
                        </div>
                    </div>
                    </div>
                    
                    <!-- divider -->
                    <div class="row mt-2">
                        <hr style="color: white;">
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
                                    <h4 style="color: white;">Cart Total: ' . EURO . ' ' . $finalAmount . ' </h4>
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
            echo '<div class="container rounded my-3" style="background-color: white;">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" height="96" viewBox="0 96 960 960" width="96">
                        <path d="M640 604h-35l-59-60h85l126-228H316l-60-60h529q26 0 38 21.5t-2 46.5L680 
                        580q-6 11-15 17.5t-25 6.5ZM286.788 975Q257 975 236 953.788q-21-21.213-21-51Q215 
                        873 236.212 852q21.213-21 51-21Q317 831 338 852.212q21 21.213 21 51Q359 933 337.788 
                        954q-21.213 21-51 21ZM851 1021 595 767H277q-38 0-56-27.5t1-59.5l70-117-86-187L46 
                        216l43-43 805 805-43 43ZM535 707 434 603h-95l-63 104h259Zm96-163h-85 
                        85Zm57 431q-29 0-50.5-21.212-21.5-21.213-21.5-51Q616 873 637.5 852q21.5-21 50.5-21t50.5 
                        21.212q21.5 21.213 21.5 51Q760 933 738.5 954 717 975 688 975Z"/>
                    </svg>

                    Non ci sono articoli in carrello! 
                        <a class="btn btn-outline-secondary" href="./index.php">Aggiungine uno!</a>
                  </div>';
        }

    } else {
        header("Location: login.php");
    }
    ?>
</div>
