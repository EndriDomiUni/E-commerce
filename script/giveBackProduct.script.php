<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

if (isset($_SESSION[ID])) {
    // if isset order details id
    if (isset($_GET['orderDetailId'])) {

        // on btn click
        if (isset($_POST['btn-send-give-back'])) {

            $session = new Session($_SESSION[ID]);
            try {
                // get params
                $params = [
                    MOTIVO => filter_var($_POST['reason'], FILTER_SANITIZE_SPECIAL_CHARS),
                    DESCRIZIONE => filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS),
                ];

                $res = $session->addArticleGiveBack($_GET['orderDetailId'], $params);

                if ($res > 0) {
                    $session->updateDateWithWhere(DETTAGLIO_ORDINE,
                        STATUS,
                        ORDER_STATUS_GIVE_BACK,
                        "Id = " . $_GET['orderDetailId']);

                    header("Location: giveBackProductSuccess.php");
                }

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    }
}