<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("./assets/css/style.php");
require_once("./assets/js/script.php");

?>

<!DOCTYPE html>
<html lang="it">
<?php require_once("./templates/views/utils/head.php"); ?>


<body>

<!-- ======================= Header START -->
<header class="">
    <?php require("./templates/views/utils/navbar.php"); ?>
</header>
<!-- ======================= Header END -->


 <?php
if (isset($_SESSION["Id"])) {
    try {
        $session = new Session($_SESSION["Id"]);
        if ($session->checkSessionId($_SESSION["Id"])) {
            $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);
                if ($claimType === CLAIM_SELLER_DESC || $claimType === CLAIM_SELLER_PR0_DESC) {
                    if ($title === "Dashboard" || $title === "Insert product" || $title === "Edit product" ||
                        $title === "Warehouse") {
                        echo '<div class="row">
                                <div id="sidebar" class="col">
                                </div>

                                <div class="col-9">';
                        echo $mainContent;
                        echo '      </div>
                        </div>';

                        echo '<script src="/app/assets/js/generateSidebar.js" type="text/javascript">',
                        '</script>';

                    } else { // se non è una pagina da seller
                        echo $mainContent;
                    }
                } else { // se non è seller o seller pro
                    echo $mainContent;
                }
        } else { // se non ha accesso alla sessione
            echo "sono qui";
            //echo $mainContent;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else { // se è un guest
    echo $mainContent;
}
?>


<!-- ======================= Footer START -->
<?php require("./templates/views/utils/footer.php"); ?>
<!-- ======================= Footer END -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>