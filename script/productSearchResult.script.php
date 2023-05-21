<?php

if (isset($_POST['btn-search'])) {
    if (isset($_POST["search"]) && !empty($_POST["search"])) {
        $_SESSION['search'] = $_POST["search"];
        header("Location: productSearchResult.php");
    }
}
