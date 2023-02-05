<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";

$session = new Session($_SESSION[ID]);

if (isset($_POST['article-btn-insert']))
{
    $params = array(
        PREZZO => filter_var($_POST['article-price'], FILTER_SANITIZE_SPECIAL_CHARS),
        // TODO: completare
        UTENTE_ID => $session->getCurrentUser()[ID],
        PRODOTTO_ID => $session->getCurrentProduct()[ID],
        );
    try
    {
        $response = $session->addArticle($params);
        if($response)
        {
            $session[ARTICOLO_ID] = $response;
            //header("Location: productInsertion.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
