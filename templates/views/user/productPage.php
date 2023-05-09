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
                echo '<div class="container">
                    <div class="row">
                            <div class="col-md-6">
                                <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" alt="Product Image" class="img-fluid">
                            </div>
                        <div class="col-md-6">
                            <h2>' . $product[NOME] . '</h2>
                            <p>' . $product[DESCRIZIONE] . '</p>
                            <ul>
                                <li><strong>Price:</strong> $10.99</li>
                                <li><strong>Color:</strong> Red</li>
                                <li><strong>Size:</strong> Small</li>
                                <li><strong>Weight:</strong> 1 lb</li>
                            </ul>
                            <button class="btn btn-primary">Add to Cart</button>
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






