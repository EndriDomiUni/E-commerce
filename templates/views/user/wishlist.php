<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "UIHelper.php";
?>


<div class="container text-center px-4">
    <h1>Wishlist</h1>

    <div class="box-no-product" id="box-no-product">
        <div class="row">

            <?php
            showAllArticlesInWishlist();
            ?>
            <a class="btn btn-outline-secondary" href="./cart.php">Vai all Carrello</a>
        </div>
    </div>
</div>