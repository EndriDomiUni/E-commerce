<?php

// These two lines are used for debugging
use utility\UtilsFunctions;

error_reporting(E_ALL);
ini_set('display_errors', 1);

// require_once "./src/classes/Dbh.php";

$dbh = new Dbh();

if (isset($_POST['personal-btn-register']) || isset($_POST['business-btn-register'])) {
    try {
        $params = [];
        switch (true) {
            case isset($_POST['personal-btn-register']):
                $params = [
                    NOME => filter_var($_POST['personal-name-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    COGNOME => filter_var($_POST['personal-surname-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    EMAIL => filter_var($_POST['personal-mail-register'], FILTER_SANITIZE_EMAIL),
                    PASSWORD => filter_var($_POST['personal-password-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    STATUS =>  filter_var(STATUS_INTACT_DATA, FILTER_SANITIZE_SPECIAL_CHARS),
                    CLAIM_TYPE => filter_var(CLAIM_USER_DESC, FILTER_SANITIZE_SPECIAL_CHARS),
                    INDIRIZZO_ID => filter_var(ADDRESS_UNSET, FILTER_SANITIZE_SPECIAL_CHARS)
                ];
                break;
            case isset($_POST['business-btn-register']):
                $params = [
                    NOME => filter_var($_POST['business-name-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    COGNOME => filter_var($_POST['business-surname-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    EMAIL => filter_var($_POST['business-mail-register'], FILTER_SANITIZE_EMAIL),
                    PASSWORD => filter_var($_POST['business-password-register'], FILTER_SANITIZE_SPECIAL_CHARS),
                    STATUS =>  filter_var(STATUS_INTACT_DATA, FILTER_SANITIZE_SPECIAL_CHARS),
                    CLAIM_TYPE => filter_var(CLAIM_SELLER_DESC, FILTER_SANITIZE_SPECIAL_CHARS),
                    INDIRIZZO_ID => filter_var(ADDRESS_UNSET, FILTER_SANITIZE_SPECIAL_CHARS)
                ];
                break;
        }
        $response = $dbh->register($params);
        if ($response !== null) {
            if (UtilsFunctions::checkResponse($response)) {
                $session =new Session($response);
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
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
