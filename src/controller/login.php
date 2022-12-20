<?php 
include(dirname(__FILE__) . "");
require(dirname(__FILE__) . "");

if ((isset($_POST['submit']))) {
    // Queste sono da mettere come constante globale
    $sellerNameTable = "venditore";
    $clientNameTable = "cliente";
    $customerHelper = new CustomerHelper();
    $sellertHelper = new SellerHelper();
    if($this->dbHelper->checkemail($clientNameTable), $_POST['email'])
    {
        $parameters = array($_POST['email'], $_POST['password'])
        $user = $this->dbHelper->signin()
    }
    $user = new 
    if ($target)
}