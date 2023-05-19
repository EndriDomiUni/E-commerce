<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

if (isset($_SESSION[ID])) {
    $session = new Session($_SESSION[ID]);
    $articlesInCarts = $session->loadArticlesInCart($session->getCurrentUser()[CARRELLO_ID]);
    foreach ($articlesInCarts as $article) {

        // on click
        if (isset($_POST['btn-remove-'. $article[ID] . '-from-cart'])) {

            // start remove
            $session->removeArticleInCart($article[ID]);
            // header("Location: index.php");
        } else {
           echo  $article[ID];
        }
    }
}