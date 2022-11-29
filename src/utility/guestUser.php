<?php
session_start();

/*
 * if user not have id, go to index
 */
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}
