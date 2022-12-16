<?php
require_once("./assets/css/style.php");
require_once("./assets/js/script.php");
?>


<!DOCTYPE html>
<html lang="it">
<?php require_once("./templates/views/utils/head.php"); ?>


<body id="body">

    <!-- ======================= Header START -->
    <header class="header-base">
        <?php require("./templates/views/utils/navbar.php"); ?>
    </header>
    <!-- ======================= Header END -->


    <!-- ======================= Main content START -->
    <main>
        <?php echo $mainContent; ?>
    </main>
    <!-- ======================= Main content END -->


    <!-- ======================= Footer START -->
    <?php require("./templates/views/utils/footer.php"); ?>
    <!-- ======================= Footer END -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>