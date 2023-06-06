<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

if (isset($_POST["btn-base"]) || isset($_POST["btn-user-pro"]) || isset($_POST["btn-seller-pro"])) {
    try {
        $session =  new Session($_SESSION["Id"]);
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
            CLAIM_TYPE => $claimType
        ];

        // get pay card data
        if ($session->hasFormOfPayment($session->getCurrentUser()[ID])) {
            $session->changeClaim($params);
            echo '
                    <div class="alert alert-success mt-4" role="alert">
                      Operazione eseguita con successo!
                    </div>
                  ';

            // sleep(2);
            // header("Location: index.php");
        } else {
            echo '<h3 class="text-center mt-4" style="color: white">I dati della tua carta non sono stati inseriti</h3>';
            echo '<a style="color: white" class="btn btn-outline-secondary btn-lg" href="./cardPayForm.php">Inseriscili per continuare</a>';
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

