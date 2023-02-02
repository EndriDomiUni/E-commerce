<?php

use utility\UtilsFunctions;

if (isset($_POST["btn-base"]) || isset($_POST["btn-user-pro"]) || isset($_POST["btn-seller-pro"])) {
    try {
        $session = new Session($_SESSION["Id"]);
        $claimType = null;
        switch (true) {
            case isset($_POST["btn-base"]):
                $claimType = CLAIM_USER_DESC;
                break;
            case isset($_POST["btn-user-pro"]):
                $claimType = CLAIM_USER_PRO_DESC;
                break;
            case isset($_POST["btn-seller-pro"]):
                $claimType = CLAIM_SELLER_PR0_DESC;
                break;
        }
        $claimType = filter_var($claimType, FILTER_SANITIZE_SPECIAL_CHARS);
        $params = [
            STATUS => STATUS_MODIFIED_DATA,
            CLAIM_ID => $claimType
        ];

        $response = $session->changeClaim($params);
        if (UtilsFunctions::checkResponse($response)) {
            header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

