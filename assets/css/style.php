<?php

require_once "./config/AppConstants.php";

$stylesheets = [
    ROOT . '/index.php' => [
        CSS . '/productInCart.css',
        CSS . '/productCard.css'
    ],
    ROOT . '/account.php' => [
        CSS . '/loginStyle.css'
    ],
    ROOT . '/cart.php' => [
        CSS . '/cart.css',
        CSS . 'productInCart.css'
    ],
    ROOT . '/dashboard.php' => [
        CSS . '/dashboardStyle.css'
    ],
    ROOT . '/premium.php' => [
        CSS . '/productCard.css'
    ]
];
