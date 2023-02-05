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
        PRODOTTO_ID => $_SESSION[PRODOTTO_ID],
        );
    echo "prezzo article: ".$params[PREZZO]."</br>";
    echo "utente id article: ".$params[UTENTE_ID]."</br>";
    echo "prodotto id article: ".$params[PRODOTTO_ID]."</br>";
    try
    {
        $response = $session->addArticle($params);
        if($response)
        {
            echo "articolo id: ".$response."</br>";
            //$session[ARTICOLO_ID] = $response;

            //TODO: aggiungere configurazione articolo
            $parameters = array(
                ARTICOLO_ID => $response,
            );

            $variations = $session->getVariations();

            foreach ($variations as $variation){
                $variationIdSelect = $_POST('variation-id-'.$variation[ID]);
                echo $variationIdSelect;
                if (isset($variationIdSelect)){
                    $parameters = [ARTICOLO_ID => $response, OPZIONE_ID => $variationIdSelect];
                    $result = $session->addConfigurationArticle($parameters);
                    if ($result){
                        echo "configuration variation: ".$result."</br>";
                    }
                    else{
                        echo "Errore inserimento configuration variation</br>";
                    }
                }
            }

            //header("Location: dashboard.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
