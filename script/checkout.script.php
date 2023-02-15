<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

if (isset($_POST["checkout"])) {
    if (isset($_SESSION[ID])) {
        $session = new Session($_SESSION[ID]);
        $params = [
            TOTALE_ORDINE => ($session->getTotalOfArticlesInCart()),
            DATA_ORDINE => date("Y/m/d"),
        ];
        $resp = $session->addOrder($params);
        if ($resp > 0) {
            $session->removeArticlesInCart();
            header("Location: orderHistory.php");
        }
    } else {
        header("Location: login.php");
    }
}