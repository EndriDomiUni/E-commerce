<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./config/AppConstants.php";
require_once "./src/classes/Dbh.php";

$dbh = new Dbh();

if (isset($_POST["btn-base"]) || isset($_POST["btn-user-pro"]) || isset($_POST["btn-seller-pro"])) {
    echo "sono qui";
    try {
        $params = [];
        switch (true) {
            case isset($_POST["btn-base"]):
                $params = [
                    "Status" => STATUS_MODIFIED_DATA,
                    "claimType" => filter_var(CLAIM_USER, FILTER_SANITIZE_SPECIAL_CHARS)
                ];
                break;
            case isset($_POST["btn-user-pro"]):
                $params = [
                    "Status" => STATUS_MODIFIED_DATA,
                    "claimType" => filter_var(CLAIM_USER_PRO, FILTER_SANITIZE_SPECIAL_CHARS)
                ];
                break;
            case isset($_POST["btn-seller-pro"]):
                $params = [
                    "Status" => STATUS_MODIFIED_DATA,
                    "claimType" => filter_var(CLAIM_SELLER_PR0, FILTER_SANITIZE_SPECIAL_CHARS)
                ];
                break;
        }

        $response = $dbh->changeClaim($params);
        $dbh->checkResponse($response) ? header("Location: index.php") : null;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
