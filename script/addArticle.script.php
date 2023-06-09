<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

$session = new Session($_SESSION[ID]);

if (isset($_POST['article-btn-insert']))
{
    //TODO: aggiungere quantità(giò inserito nel template), modificare addArticle($params)
    $params = array(
        PREZZO => filter_var($_POST['article-price'], FILTER_SANITIZE_SPECIAL_CHARS),
        UTENTE_ID => $session->getCurrentUser()[ID],
        PRODOTTO_ID => $_SESSION[PRODOTTO_ID],
        );
    //debug
    //echo "prezzo article: ".$params[PREZZO]."</br>";
    //echo "utente id article: ".$params[UTENTE_ID]."</br>";
    //echo "prodotto id article: ".$params[PRODOTTO_ID]."</br>";
    try
    {
        $articleIdResponse = $session->addArticle($params);
        if($articleIdResponse > 0)
        {
            $parameters = array(
                ARTICOLO_ID => $articleIdResponse,
            );

            $variations = $session->getVariations();
            foreach ($variations as $variation) {
                $variationTagName = 'variation-id-' . $variation[ID];
                if (isset($_POST[$variationTagName])) {
                    $variationIdSelect = $_POST[$variationTagName];
                    $parameters = [ARTICOLO_ID => $articleIdResponse, OPZIONE_ID => $variationIdSelect];
                    $result = $session->addConfigurationArticle($parameters);

                    if ($result > 0) {
                        //echo "configuration variation: ".$result."</br>";
                    } else {
                        echo "Errore inserimento configuration variation</br>";
                    }
                }
            }
        $claimId = $session->getCurrentUser()[CLAIM_ID];
        $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);
        if ($claimType == CLAIM_SELLER_PR0_DESC){
            $tax = 0;
        }

        $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_SPECIAL_CHARS);
        $warehouseId = filter_var($_POST['warehouse-id'], FILTER_SANITIZE_SPECIAL_CHARS);


            $warehouseArticleResponse = $session->insertArticleInStock($quantity, $articleIdResponse, $warehouseId);
            if ($warehouseArticleResponse) {
                header("Location: dashboard.php");
            } else {
                echo "Errore inserimento articolo in magazzino </br>";
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
