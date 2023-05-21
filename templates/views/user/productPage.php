<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<section>
    <?php
    if (isset($_GET['id'])) {
        $dbh = new Dbh();
        $product = $dbh->getRecord(PRODOTTO, "Id = " . $_GET['id']);
        if (!empty($product)) {
            echo '<div class="container rounded my-3" style="border-radius: 20px;">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6 rounded">
                                    <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" alt="Product Image" class="img-fluid rounded">
                                </div>
                                <div class="col-md-6 rounded" style="background: white;">
                                    <h2>' . $product[NOME] . '</h2>
                                    <p>' . $product[DESCRIZIONE] . '</p>
                                    <ul>
                                        <li><strong>Price:</strong> $10.99</li>
                                        <li><strong>Color:</strong> Red</li>
                                        <li><strong>Size:</strong> Small</li>
                                        <li><strong>Weight:</strong> 1 lb</li>
                                    </ul>
                                    <button class="btn btn-primary ml-auto" type="submit" name="add-product-' . $_GET['id'] . '-in-wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                                    </button>
                                    <button class="btn btn-primary ml-auto" type="submit" name="add-article-' . $_GET['id'] . '-in-cart">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                                    </svg>
                                        Aggiungi al carrello
                                    </button>
                                    <button class="btn btn-primary ml-auto" type="submit" name="buy-now-' . $_GET['id'] . '">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                        </svg>
                                        Compra ora
                                    </button>
                        </form>';
                                    echo '<section>';
                                        require './templates/views/user/reviews.php';
                                    echo '</section>';
                                    echo '<div>
                                </div>
                        </div>
                </div>';
        }
    } else {
        echo '<div class="container">
                        <p>Errore nel caricamento del prodotto, torna all <a href="index.php" id="create-account-link">home page</a></p>
                  </div>';
    }
    ?>
</section>








