<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "UIHelper.php";
//require_once "./src/classes/Dbh.php";

?>

<nav class="navbar navbar-expand-lg bg-light bd-navbar sticky-top" id="navbar-main">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo ROOT; ?>">
            <img src="<?php echo IMG; ?>/logo.svg" width="64" height="64" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="toogle-hamburger">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- start menu left -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-row justify-content-between">

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo ROOT; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-house-door-fill nav-icon-item" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
                        </svg>
                        <div class="nav-caption-item">
                            <p>Home</p>
                        </div>
                    </a>
                </li>

                <?php
                    if (isset($_SESSION[ID])) {
                        $session = new Session($_SESSION[ID]);
                            $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);

                        switch ($claimType) {
                            case CLAIM_SELLER_DESC:
                            case CLAIM_SELLER_PR0_DESC:
                                echo
                                '<li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="./dashboard.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-inbox-fill nav-icon-item" viewBox="0 0 16 16">
                                            <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z" />
                                        </svg>
                                    <div class="nav-caption-item">
                                        <p>Dashboard</p>
                                    </div>
                                    </a>
                                </li>';

                            echo
                            '<li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="./invoiceSection.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-receipt nav-icon-item" viewBox="0 0 16 16">
                                              <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
                                              <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    <div class="nav-caption-item">
                                        <p>Fatture</p>
                                    </div>
                                    </a>
                                </li>';

                                break;
                        }
                    }
                ?>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./premium.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-stars nav-icon-item" viewBox="0 0 16 16">
                            <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z" />
                        </svg>
                        <div class="nav-caption-item">
                            <p>Premium</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- end menu left -->

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorie
                </button>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    <?php
                        $dbh = new Dbh();
                        $categories = $dbh->getCategories();
                        // all
                        echo '<li><a class="dropdown-item" href="./index.php">Tutto</a></li>';

                        foreach ($categories as $category) {
                            echo '<li><a class="dropdown-item" href="./index.php?byCategoryId= '.$category[ID] .'">' . $category[NOME] . '</a></li>';
                        }
                    ?>
                </ul>
            </div>

            <div class="ms-2"></div>

            <!-- start search -->
            <form class="d-flex" role="search" method="post">
                <input class="form-control me-2" type="search" placeholder="Ricerca prodotto" aria-label="Search" name="search">
                <button class="btn btn-outline-primary" type="submit" name="btn-search">Cerca</button>
            </form>
            <!-- end search -->

            <!-- menu right start -->
            <ul class="navbar-nav flex-row flex-wrap ms-md-auto justify-content-between" id="btn-toogle-navbar">

                <?php
                if (isset($_SESSION[ID])) {
                $session = new Session($_SESSION[ID]);
                        $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);

                switch ($claimType) {

                    case CLAIM_USER_DESC:
                    case CLAIM_USER_PRO_DESC:
                        // order history
                        echo
                        '<li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./orderHistory.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list-ul nav-icon-item" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>
                                <div class="nav-caption-item">
                                    <p>Storico Ordini</p>
                                </div>
                            </a>
                         </li>';
                        // wishlist
                        echo
                        '<li class="nav-item">
                            <a class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart-fill nav-icon-item" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                </svg>
                                <div class="nav-caption-item">
                                    <p>Wishlist</p>
                                </div>
                            </a>
                        </li>';
                        // cart
                        echo
                        '<li class="nav-item">
                            <a class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart-fill nav-icon-item" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <div class="nav-caption-item">
                                    <p>Carrello</p>
                                </div>
                            </a>
                        </li>
                        ';

                        break;
                }
                } else {
                    // wishlist guest
                    echo
                    '<li class="nav-item">
                        <a class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart-fill nav-icon-item" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                            <div class="nav-caption-item">
                                <p>Wishlist</p>
                            </div>
                        </a>
                     </li>';
                    // cart guest
                    echo
                    '<li class="nav-item">
                        <a class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart-fill nav-icon-item" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <div class="nav-caption-item">
                                <p>Carrello</p>
                            </div>
                        </a>
                     </li>';
                }
                ?>

                <!-- start user -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle nav-icon-item" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <div class="nav-caption-item">
                            <?php
                                if(isset($_SESSION["Id"])) {
                                    try {
                                        $session = new Session($_SESSION["Id"]);
                                        $user = $session->getCurrentUser();
                                        if ($user[ID] !== ID_UNSET) {
                                            echo 'Ciao ' . $user[NOME];
                                        } else {
                                            echo '<p>Utente</p>';
                                        }
                                    } catch (Exception $e) {
                                        echo $e->getMessage();
                                    }
                                } else {
                                    echo '<p>Utente</p>';
                                }
                            ?>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end ">
                        <?php
                            if (isset($_SESSION[ID])) {
                               echo '<li><a class="dropdown-item" href="./account.php">Account</a></li>';
                               echo '<li><a class="dropdown-item" href="./cardPayForm.php">Forma di pagamento</a></li>';
                               echo '<li><a class="dropdown-item" href="./address.php">Indirizzo</a></li>';
                            } else {
                                echo '<li><a class="dropdown-item" href="./login.php">Accedi</a></li>';
                                echo '<li><a class="dropdown-item" href="./register.php">Registrati</a></li>';
                            }
                        ?>
                        <li><a class="dropdown-item" href="./logout.php">Esci</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="btn-dark-mode" onclick="checkForDarkMode(event)">
                                    <label class="form-check-label" for="btn-dark-mode">Dark Mode</label>
                                </div>
                            </a>
                            <a class="dropdown-item" href="settings.php">
                                <div class="settings-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-gear-wide-connected nav-icon-item" viewBox="0 0 16 16">
                                        <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z" />
                                    </svg>
                                    <label class="form-check-label">Settings</label>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end user -->
            </ul>
            <!-- menu right end -->
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="overflow-y: auto">
    <div class="offcanvas-header text-center">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrello</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body"  style="overflow-y:auto">

        <?php showArticlesInCart(); ?>

        <!-- divider -->
        <div class="row mt-2 my-2">
            <hr>
        </div>

        <div class="d-flex justify-content-end">
            <a class="btn btn-outline-secondary text-end" href="./cart.php">Vai al carello</a>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Wishlist</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <?php showAllArticlesInWishlist(); ?>

        <!-- divider -->
        <div class="row mt-2 my-2">
            <hr>
        </div>

        <div class="d-flex justify-content-end py-8">
            <a class="btn btn-outline-secondary text-end" href="./wishlist.php">Vai alla Wishlist</a>
        </div>
    </div>
</div>