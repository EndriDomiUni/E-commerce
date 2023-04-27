<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

if (isset($_POST["checkout"])) {
    if (isset($_SESSION[ID])) {

        $session = new Session($_SESSION[ID]);

        // create params for order
        $params = [
            TOTALE_ORDINE => ($session->getTotalOfArticlesInCart()),
            DATA_ORDINE => date("Y/m/d"),
        ];

        // create order
        $resp = $session->addOrder($params);

        // on success
        if ($resp > 0) {

            // add order details
            $session->addSingleItemInOrder($resp);

            // clear cart
            $session->removeArticlesInCart();

            // redirect
            header("Location: orderHistory.php");
        }
    } else {
        header("Location: login.php");
    }
}