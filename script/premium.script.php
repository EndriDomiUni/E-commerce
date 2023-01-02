<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./config/AppConstants.php";
require_once "./src/classes/Dbh.php";

$dbh = new Dbh();

if (isset($_POST["btn-base"]) || isset($_POST["btn-user-pro"]) || isset($_POST["btn-seller-pro"])) {
    try {
        $params = [];
        switch (true) {
            case isset($_POST["btn-base"]):
                $params = [
                    "Status" => STATUS_MODIFIED_DATA,
                    "claimType" => CLAIM_USER
                ];
                break;
            case isset($_POST["btn-user-pro"]):
                $params = [
                    "Status" => STATUS_MODIFIED_DATA,
                    "claimType" => CLAIM_USER_PRO
                ];
                break;
            case isset($_POST["btn-seller-pro"]):
                $params = [
                    "Status" => STATUS_MODIFIED_DATA,
                    "claimType" => CLAIM_SELLER_PR0
                ];
                break;
        }

        $response = $dbh->changeClaim($params);
        $error_register = $response["Status"] === ERROR ? $response["msg"] : null;
        $response["Status"] === SUCCESS ? header("Location: index.php") : null;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
