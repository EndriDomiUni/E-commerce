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


    <!-- ======================= Main content START -->
    <?php echo $mainContent; ?>
    <!-- ======================= Main content END -->


    <!-- ======================= Footer START -->
    <?php require("./templates/views/utils/footer.php"); ?>
    <!-- ======================= Footer END -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>