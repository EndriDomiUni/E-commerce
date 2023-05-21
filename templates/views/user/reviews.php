<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>


<style>
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #f2f2f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>

<div class="container my-5">
    <h1>Recensioni del Prodotto</h1>

    <?php
        if (isset($_GET['id'])) {
            $dbh = new Dbh();
            $reviewsFromProduct = $dbh->getReviewsFromProductId($_GET['id']);

            if (!empty($reviewsFromProduct)) {
                foreach ($reviewsFromProduct as $review) {
                    $user = $dbh->getRecord(UTENTE, "Id = " . $review[UTENTE_ID]);
                    echo '
                <div class="row">
                    <div class="col-md-6">
                        <div class="card py-1">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar">'. substr($user[NOME], 0, 1) .'</div>
                                    <h5 class="card-title ml-2 mx-1">' . $user[NOME] . '</h5>
                                </div>
                                <div class="card-text">
                                      <span class="star-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                      </span>
                                    <p class="mb-0">' . $review[COMMENTO] . '</p>
                                    <small class="text-muted">Scritta il: ' . $review['Timestamp'] . '</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                }
            } else {
                echo '<div>Non esiste ancora nessuna recensione per questo prodotto.</div>';
            }

        } else {
            echo '<div>Non esiste ancora nessuna recensione per questo prodotto.</div>';
        }
    ?>
</div>