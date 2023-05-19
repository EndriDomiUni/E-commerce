<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


/**
 * Draw product card foreach article in cart
 *
 * @return void
 */
function showArticlesInCart(): void
{
    if (isset($_SESSION["Id"])) {
        $session = new Session($_SESSION["Id"]);
        require("./script/productCartManager.script.php");
        require './templates/views/components/productInCart.php';
    } else {
        echo '<div class="col">
                        <h2>Il carrello è vuoto</h2>
                        <p>
                            Vai all <a href="index.php">home page<a/>.
                        </p>
                    </div>';
    }
}

/**
 * Draw product card foreach article
 *
 * @return void
 */
function showAllArticles(): void
{
    echo ' <div class="row">
        <div class="col">' . require './templates/views/components/productCard.php'; '</div>
     </div>';
}

function showAllArticlesInWishlist(): void
{
    if (isset($_SESSION["Id"])) {
        $session = new Session($_SESSION["Id"]);
        require './templates/views/components/productInWishlist.php';
    } else {
        echo '<div class="col">
                        <h2>La raccolta è vuota</h2>
                        <p>
                            Vai all <a href="index.php">home page<a/>.
                        </p>
                    </div>';
    }
}