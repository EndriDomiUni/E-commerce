<?php

$scripts = [
    ROOT . '/index.php' => [
        JS . '/productSlider.js'
    ],
    ROOT . '/account.php' => [
        JS . '/loginSlide.js',
    ],
    ROOT . '/checkout.php' => [
        JS . '/checkout.js',
    ],
    ROOT . '/contatti.php' => [
        JS . '/contatti.js',
    ],
    ROOT . '/dashboard.php' => [
        JS . '/dashboardScript.js'
    ],
    ROOT . '/ordini.php' => [
        JS . '/dashboardScript.js'
    ],
    ROOT . '/impostazioni-account.php' => [
        JS . '/dashboardScript.js',
        JS . 'regioni.js'
    ],
    ROOT . '/notifiche.php' => [
        JS . '/dashboardScript.js'
    ],
    ROOT . '/prodotti.php' => [
        JS . '/prodotti.js'
    ],
    ROOT . '/prodotto.php' => [
        JS . '/3dModel.js',
        JS . '/productSlider.js',
        'plugins/owl_carousel/owl.carousel.js'
    ],
    ROOT . '/admin/nuovo-prodotto.php' => [],
    ROOT . '/admin/ordine.php' => [
        JS . "/ordineAdmin.js",

    ]
    // and so on
];