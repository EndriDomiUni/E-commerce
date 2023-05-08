<section class="container my-5">
    <?php

    // queste due linee fungono da debugger
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once "./src/classes/Session.php";

    $session = new Session($_SESSION[ID]);

    $warehouses = $session->getWarehouses();
    foreach ($warehouses as $warehouse){
        $whereAddressId = "Id = " . $warehouse[INDIRIZZO_ID];
        $address = $session->getRecord(INDIRIZZO, $whereAddressId);

        $articlesQuantity = $session->getArticlesInStockQuantity($warehouse[ID]);

        echo '<div class="row">
            <form method="post">
                <div class="card mb-3 center-block d-flex justify-content-center" style="max-width: 540px;">
                    <!--<div class="row no-gutters">-->
                        <div class="card-body">
                            <h5 class="card-title">' . $address[CITTA] . '</h5>
                            <h6 class="card-subtitle">' . $address[VIA] . ', ' . $address[NUMERO_CIVICO] . '</h6>
                            <p class="card-text">Dimensione metri cubi: ' . $warehouse[METRI_CUBI] . '</p>
                            <p class="card-text">Numero articoli: ' . $articlesQuantity . '</p>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <style>
                               .btn-primary{
                                    margin: 1px;
                               }
                            </style>
                            <button class="btn btn-primary ml-auto" type="submit" name="manage-articles-'.$warehouse[ID].'-configuration">
                                <!--<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                                </svg>-->
                                Gestisci articoli
                            </button>
                            <!--
                            <button class="btn btn-primary ml-auto" type="submit" name="edit-product-'.$warehouse[ID].'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                </svg>
                                Edit Product
                            </button>
                            <button class="btn btn-red ml-auto" type="submit" name="delete-product-'.$warehouse[ID].'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                                </svg>
                                Delete product
                            </button>
                            -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
                ';
    }
    ?>
</section>
