<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\Utils;


require_once "./src/classes/Session.php";

if (Utils::issetSessionid()) {
    if (isset($_POST["btn-card-pay"])) {
        try {
            $session = new Session($_SESSION["Id"]);
            $params = [
                CIRCUITO => getBankingCircuit($_POST["Circuito"]),
                NUMERO_CARTA => filter_var($_POST["Numero_carta"], FILTER_SANITIZE_SPECIAL_CHARS),
                DATA_SCADENZA => filter_var($_POST["Data_scadenza"], FILTER_SANITIZE_SPECIAL_CHARS),
                CVV => filter_var($_POST["CVV"], FILTER_SANITIZE_SPECIAL_CHARS),
                TIPO_DI_PAGAMENTO => "", // TODO: fare la form corrispettiva
                STATUS => STATUS_INTACT_DATA,
                UTENTE_ID => $_SESSION["Id"]
            ];

            $response = $session->insertCardPayModInformation($params);
            Utils::checkResponse($response) ? header("Location: index.php") : null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
function getBankingCircuit($cardNumber): string
{
    $firstTwoDigits = substr($cardNumber, 0, 2);
    return match ($firstTwoDigits) {
        '34', '37' => 'American Express',
        '51', '52', '53', '54', '55' => 'Mastercard',
        '4' => 'Visa',
        default => 'Unknown',
    };
}



