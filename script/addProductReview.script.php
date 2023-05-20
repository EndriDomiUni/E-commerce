<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

if (isset($_SESSION[ID])) {

    // if isset order details id
    if (isset($_GET['orderDetailId']) && isset($_GET['id'])) {

        // on btn click
        if (isset($_POST['btn-send-reviews'])) {
            $session = new Session($_SESSION[ID]);
            try {
                // get params
                $params = [
                    VALUTAZIONE => filter_var($_POST['evaluation'], FILTER_SANITIZE_SPECIAL_CHARS),
                    COMMENTO => filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS)
                ];

                $session->addReview($_GET['orderDetailId'], $params);
                header("Location: ./productPage.php?id=" . $_GET['id']);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    } else {
        echo "non settati";
    }
}