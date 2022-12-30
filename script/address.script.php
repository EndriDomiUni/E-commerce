<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("./config/AppConstants.php");
include "./src/classes/Dbh.php";

if (isset($_POST["btn-address"])) {
    try {
        $params = [
            "Via" => filter_var($_POST["via"], FILTER_SANITIZE_SPECIAL_CHARS),
            "Numero_civico" => filter_var($_POST["Numero_civico"], FILTER_SANITIZE_SPECIAL_CHARS),
            "Citta" => filter_var($_POST["Citta"], FILTER_SANITIZE_SPECIAL_CHARS),
            "CAP" => filter_var($_POST["CAP"], FILTER_SANITIZE_SPECIAL_CHARS),
            "Status" => STATUS_INTACT_DATA
        ];
        $dbh = new Dbh();
        $response = $dbh->insertAddressInformation($params);
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