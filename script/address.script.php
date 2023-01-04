<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\Utils;

require_once("./config/AppConstants.php");
require_once "./src/classes/Session.php";

if (Utils::issetSessionid()) {
    if (isset($_POST["btn-address"])) {
        $session = new Session($_SESSION["Id"]);
        try {
            $params = [
                VIA => filter_var($_POST["via"], FILTER_SANITIZE_SPECIAL_CHARS),
                NUMERO_CIVICO => filter_var($_POST["Numero_civico"], FILTER_SANITIZE_SPECIAL_CHARS),
                CITTA => filter_var($_POST["Citta"], FILTER_SANITIZE_SPECIAL_CHARS),
                CAP => filter_var($_POST["CAP"], FILTER_SANITIZE_SPECIAL_CHARS),
                STATUS => STATUS_INTACT_DATA
            ];

            $response = $session->insertAddressInformation($params);
            Utils::checkResponse($response) ? header("Location: index.php") : null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
