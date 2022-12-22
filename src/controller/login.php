<?php 
include(dirname(__FILE__) . "");
require(dirname(__FILE__) . "");

if ((isset($_POST['submit']))) {
    $parameters = array($_POST['email'], $_POST['password'])
    $customerHelper = new CustomerHelper();
    $sellertHelper = new SellerHelper();
    if($customerHelper->checkemail(CUSTOMER), $_POST['email'])
    {
        $response = $customerHelper->signin($parameters)
        if (is_array($response) && $response["Status"] == ERROR){
            $error_register = $response["msg"];
        } else {
            // da settare l'ultima pagina visualizzatas
            header("Location: index.php");
        }
    }
    elseif ($sellertHelper->checkemail(SELLER), $_POST['email'])
    {
        $response = $sellertHelper->signin($parameters);
    }
}