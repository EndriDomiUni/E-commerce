<?php

if (isset($_GET['selectedValue'])) {
    $_SESSION['sortingMode'] = $_GET['selectedValue'];
}