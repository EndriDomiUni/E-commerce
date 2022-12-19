<?php

include(dirname(__FILE__) . "");
require(dirname(__FILE__) . "");

$target = $_POST[''];

if ((isset($_POST["submit"])) || isset($target)) {

    if ($target == $_POST['']) {
    } else if ($target == $_POST['']) {
    } else {
        echo "Error";
    }
}
