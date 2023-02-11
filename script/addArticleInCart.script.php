<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";

$session = new Session($_SESSION[ID]);

if (isset($_POST['add-article-in-cart'])) {

    $cart = $session->getUserCartIdFromDb();

    //TODO: completare get article by params
    $article = $session->getRecord();

    $params = array(

    );

}