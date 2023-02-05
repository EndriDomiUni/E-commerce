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
        UTENTE_ID => $session->getCurrentUser()[ID],
        PRODOTTO_ID => $_SESSION[PRODOTTO_ID],
        );
    //echo "prezzo article: ".$params[PREZZO]."</br>";
    //echo "utente id article: ".$params[UTENTE_ID]."</br>";
    //echo "prodotto id article: ".$params[PRODOTTO_ID]."</br>";
    try
    {
        $articleIdResponse = $session->addArticle($params);
        if($articleIdResponse)
        {
            //echo "articolo id: ".$response."</br>";
            //$session[ARTICOLO_ID] = $response;

            //TODO: aggiungere configurazione articolo
            $parameters = array(
                ARTICOLO_ID => $articleIdResponse,
            );

            $variations = $session->getVariations();

            foreach ($variations as $variation){
                //echo "variationId: ".$variation[ID]."</br>";
                $variationTagName = 'variation-id-'.$variation[ID];
                if (isset($_POST[$variationTagName])){
                    $variationIdSelect = $_POST[$variationTagName];
                    //echo "variationIdSelect: ".$variationIdSelect."</br>";
                    $parameters = [ARTICOLO_ID => $articleIdResponse, OPZIONE_ID => $variationIdSelect];
                    $result = $session->addConfigurationArticle($parameters);
                    if ($result){
                        //echo "configuration variation: ".$result."</br>";
                    }
                    else{
                        echo "Errore inserimento configuration variation</br>";
                    }
                }
            }


            //TODO: aggiungere articolo_magazzino
            $claimId = $session->getCurrentUser()[CLAIM_ID];
            $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);
            $tax = 3;
            if ($claimType == CLAIM_SELLER_PR0_DESC){
                $tax = 0;
            }
            $warehouseArticleParams = [
                TAX => $tax,
                DATA_INIZIO => date("yy-mm-dd/m/y H:i"),
                DATA_FINE => date("yy-mm-dd/m/y H:i",2024),
                ARTICOLO_ID => $articleIdResponse,
                MAGAZZINO_ID => filter_var($_POST['warehouse-id'], FILTER_SANITIZE_SPECIAL_CHARS)
                ];

            $warehouseArticleResponse = $session->addWarehouseArticle($warehouseArticleParams);
            if ($warehouseArticleResponse){
                echo "Articolo in magazzino: ".$warehouseArticleResponse."</br>";
                //header("Location: dashboard.php");
            }
            else{
                echo "Errore inserimento articolo in magazzino </br>";
            }

        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
