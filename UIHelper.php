<?php

/**
 * Draw product card foreach article in cart
 *
 * @return void
 */
function showArticlesInCart(): void
{
    if (isset($_SESSION["Id"])) {
        $session = new Session($_SESSION["Id"]);
        if ($session->checkSessionId($_SESSION["Id"])) {
            $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);
            if ($claimType === CLAIM_USER_DESC || $claimType === CLAIM_USER_PRO_DESC) {
                require './templates/views/components/productInCart.php';
            }
        }
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