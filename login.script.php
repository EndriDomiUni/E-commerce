<?php

require_once("./config/AppConstants.php");
include("Dbh.php");

if (isset($_POST["btn-login"])) {
    $params = array(
        "Email" => filter_var($_POST["email"], FILTER_SANITIZE_EMAIL),
        "Password" => $_POST['password']
    );
    try {
        $dbh = new Dbh();
        $response = $dbh->logIn($params);
        if ($response["Status"] == ERROR) {
            $error_register = $response["msg"];
        } else {
            // redirect to dashboard
            //header("Location: index.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}