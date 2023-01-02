<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("./config/AppConstants.php");
include "./src/classes/Dbh.php";

if (isset($_POST["btn-card-pay"])) {
    try {
        $params = [
            "Circuito" => getBankingCircuit($_POST["Numero_carta"]),
            "Numero_carta" => filter_var($_POST["Numero_carta"], FILTER_SANITIZE_SPECIAL_CHARS),
            "Data_scadenza" => filter_var($_POST["Data_scadenza"], FILTER_SANITIZE_SPECIAL_CHARS),
            "CV2" => filter_var($_POST["CV2"], FILTER_SANITIZE_SPECIAL_CHARS),
            "Status" => STATUS_INTACT_DATA
        ];
        $dbh = new Dbh();
        $response = $dbh->insertCardPayModInformation($params);
        if ($response["Status"] === ERROR) {
            $error_register = $response["msg"];
        } else {
            echo "sono qui";
            //header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
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



