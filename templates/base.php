<?php

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
            if ($title === "Dashboard" || $title === "Insert product" || $title === "Edit product" ||
                $title === "Warehouse") {
                $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);
                if ($claimType == CLAIM_SELLER_DESC || $claimType === CLAIM_SELLER_PR0_DESC) {

                    echo '<div class="row">
                                <div id="sidebar" class="col">
                                </div>
                                
                                <div class="col-9">';
                                    echo $mainContent;
                    echo '      </div>
                        </div>';

                    echo '<script src="/app/assets/js/generateSidebar.js" type="text/javascript">',
                    '</script>';
                }
            } else {
                echo $mainContent;
            }
        } else {
            echo $mainContent;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
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