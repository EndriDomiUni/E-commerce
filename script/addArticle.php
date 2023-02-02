<?php

require_once("./config/AppConstants.php");
include("Dbh.php");
use utility\Utils;

$dbh = null;
$session = new Session($_SESSION["Id"]);

if (isset($_POST['article-btn-insert']))
{
$params = array(
    PREZZO => filter_var($_POST['articlePrice'], FILTER_SANITIZE_SPECIAL_CHARS),
    // TODO: completare
    UTENTE_ID => $session->getCurrentUser()[ID];

);
}
