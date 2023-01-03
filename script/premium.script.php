<?php

use utility\Utils;

require_once "./config/AppConstants.php";
require_once "./src/classes/Session.php";

if (Utils::issetSessionid()) {
    if (isset($_POST["btn-base"]) || isset($_POST["btn-user-pro"]) || isset($_POST["btn-seller-pro"])) {
        $session = new Session($_SESSION["Id"]);
        try {
            $claimType = null;
            switch (true) {
                case isset($_POST["btn-base"]):
                    $claimType = CLAIM_USER_ID;
                    break;
                case isset($_POST["btn-user-pro"]):
                    $claimType = CLAIM_USER_PRO_ID;
                    break;
                case isset($_POST["btn-seller-pro"]):
                    $claimType = CLAIM_SELLER_PR0_ID;
                    break;
            }
            $claimType = filter_var($claimType, FILTER_SANITIZE_SPECIAL_CHARS);
            $params = [
                STATUS => STATUS_MODIFIED_DATA,
                CLAIM_ID => $claimType
            ];

            $response = $session->changeClaim($params);
            if (Utils::checkResponse($response)) {
                header("Location: index.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
