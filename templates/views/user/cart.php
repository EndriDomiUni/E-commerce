<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "UIHelper.php";
?>


<div class="container text-center px-4">
    <h1>Carrello</h1>

    <div class="box-no-product" id="box-no-product">
        <div class="row">
            <div class="col">
                <div class="col">
                    <img src="./assets/img/logo.svg" class="img-fluid" alt="Carrello Vuoto">
                </div>
            </div>

            <?php
                showArticlesInCart();
            ?>

            <div class="col">
                <div class="row rounded">
                    <h3>Dati utenti</h3>
                </div>
                <div class="row rounded">
                    <h3>Dati economici</h3>
                </div>
            </div>
        </div>
    </div>
</div>