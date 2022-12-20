<?php 
include(dirname(__FILE__) . "");
require(dirname(__FILE__) . "");

if ((isset($_POST['submit']))) {
    // Queste sono da mettere come constante globale
    $sellerNameTable = "venditore";
    $clientNameTable = "cliente";
    $parameters = array($_POST['email'], $_POST['password'])
    $customerHelper = new CustomerHelper();
    $sellertHelper = new SellerHelper();
    if($customerHelper->checkemail(CUSTOMER), $_POST['email'])
    {
        $user = $customerHelper->signin($parameters)
    }
    elseif ($sellertHelper->checkemail(SELLER), $_POST['email'])
    {
        $parameters = $sellertHelper->signin($parameters);
    }
}