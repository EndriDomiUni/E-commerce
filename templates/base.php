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
        if ($title === "Dashboard" || $title === "Insert product" || $title === "Manage products" ||
            $title === "Warehouse" || $title === "Configure article" || $title === "Edit product" ||
            $title === "Manage warehouse") {
            $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);
            if ($claimType == CLAIM_SELLER_DESC || $claimType === CLAIM_SELLER_PR0_DESC) {
                echo '<div class="row">';
                echo '<div class="sidebar col-3">
                               <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="max-width: 250px;">
                                   <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                                        <span class="fs-4">Take it</span>
                                   </a>
                                    <hr>
                                    <ul class="nav nav-pills flex-column mb-auto">';
                echo '<li>
                                            <a href="./dashboard.php" class="nav-link link-white ';
                if ($title === "Dashboard"){
                    echo 'active';
                }
                echo ' showContent" >';
                echo'
                                                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                                                Dashboard
                                            </a>
                                        </li>';
                echo '<li>
                                            <a href="./productInsertion.php" class="nav-link link-white ';
                if ($title === "Insert product"){
                    echo 'active';
                }
                echo ' showContent" >';
                echo'
                                                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                                                Inserisci prodotto
                                            </a>
                                        </li>';


                echo '<li>
                                            <a href="./manageProducts.php" class="nav-link link-dark ';
                if ($title === "Manage products" || $title === "Edit product"){
                    echo 'active';
                }
                echo ' showContent" >';
                echo'
                                                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                                                Modifica prodotto
                                            </a>
                                        </li>';
                /*
                if ($title === "Manage warehouse" || $title === "Edit product"){
                    echo 'active';
                }
                else {
                }
                echo ' showContent" >';
                echo'
                                                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                                                Modifica prodotto
                                            </a>
                                        </li>';
                */


                echo '                                           
                                    </ul>
                                    <hr>
                                     </div>
                                </div>';

                echo '          <div class="col-9">';
                echo $mainContent;
                echo '      </div>
                        </div>';
            }
        } else {
            echo $mainContent;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo $mainContent;
}
?>


<!-- ======================= Footer START -->
<?php require("./templates/views/utils/footer.php"); ?>
<!-- ======================= Footer END -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>