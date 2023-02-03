<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "./src/classes/Dbh.php";

$dbh = new Dbh();

if (isset($_POST["btn-login"])) {
    try {
        $params = [
            EMAIL => filter_var($_POST["email"], FILTER_SANITIZE_EMAIL),
            PASSWORD => filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS)
        ];
        $response = $dbh->logIn($params);
        if (is_int($response)) {
            $session = new Session($response);
            $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);

            if ($claimType !== null) {
                switch ($claimType) {
                    case CLAIM_USER_PRO_DESC:
                    case CLAIM_USER_DESC:
                        header("Location: index.php");
                        break;

                    case CLAIM_SELLER_PR0_DESC:
                    case CLAIM_SELLER_DESC:
                        header("Location: dashboard.php");
                        break;
                }
            } else {
                echo "error sono qui";
            }
        } else {
            // alert
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
