<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "UIHelper.php";
?>


<!--<div class="container text-center px-4">
    <h1>Carrello</h1>

    <div class="box-no-product" id="box-no-product">
        <div class="row">
            <div class="col">
                <div class="col">
                    <img src="./assets/img/logo.svg" class="img-fluid" alt="Carrello Vuoto">
                </div>
            </div>

            <?php
/*                showArticlesInCart();
            */?>

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
</div>-->

<!-- Shopping Cart Section -->
<div class="container my-5">
    <h2 class="text-center">Shopping Cart</h2>
    <!-- Cart Item -->
    <div class="row">
        <div class="col-md-2">
            <img
                    src="https://via.placeholder.com/150x150"
                    alt="Product Image"
                    class="img-fluid"
            />
        </div>
        <div class="col-md-4">
            <h4>Product Name</h4>
            <p>Description</p>
        </div>
        <div class="col-md-2">
            <h4>Price</h4>
        </div>
        <div class="col-md-2">
            <h4>Quantity</h4>
            <input type="number" class="form-control" value="1" />
        </div>
        <div class="col-md-2">
            <h4>Total</h4>
        </div>
    </div>
    <!-- Cart Item -->
    <div class="row">
        <div class="col-md-2">
            <img
                    src="https://via.placeholder.com/150x150"
                    alt="Product Image"
                    class="img-fluid"
            />
        </div>
        <div class="col-md-4">
            <h4>Product Name</h4>
            <p>Description</p>
        </div>
        <div class="col-md-2">
            <h4>Price</h4>
        </div>
        <div class="col-md-2">
            <h4>Quantity</h4>
            <input type="number" class="form-control" value="1" />
        </div>
        <div class="col-md-2">
            <h4>Total</h4>
        </div>
    </div>
    <!-- Cart Total -->
    <div class="row mt-3">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <h4>Cart Total</h4>
        </div>
    </div>
    <!-- Checkout Button -->
    <div class="row mt-3">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <a href="#" class="btn btn-primary btn-block">Checkout</a>
        </div>
    </div>
</div>