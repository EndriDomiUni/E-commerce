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
            if ($title === "Dashboard") {
                $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);
                if ($claimType == CLAIM_SELLER_DESC || $claimType === CLAIM_SELLER_PR0_DESC) {
                    $sidebar = '<div class="sidebar hide">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">Take it</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="#" class="nav-link link-white active showContent" >
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Inserisci prodotto
                        </a>
                    </li>
                    <li>
                        <a href="#b1" class="nav-link link-dark showContent">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                            Modifica prodotto
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark showContent">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                            Elimina prodotto
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark showContent">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                            Magazzino
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark showContent">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                            Articoli in Magazzino
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark showContent">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                            Finanze
                        </a>
                    </li>
                </ul>
                <hr>
                 </div>
            </div>';
                    echo $sidebar;
                }
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();

    }
}
?>


<!-- ======================= Main content START -->
<?php echo $mainContent; ?>
<!-- ======================= Main content END -->

<!-- ======================= Footer START -->
<?php require("./templates/views/utils/footer.php"); ?>
<!-- ======================= Footer END -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>