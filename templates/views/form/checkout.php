<div class="container">
    <div class="py-5 text-center">
        <img src="<?php echo IMG; ?>/logo.svg" width="100" height="100" alt="Logo">
        <h2 style="color: white;">Checkout</h2>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span style="color: white;">Il tuo carrello</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <?php
                if (isset($_SESSION["Id"])) {
                    $session = new Session($_SESSION["Id"]);
                    $finalAmount = 0.00;
                    $articlesInCart = $session->loadArticlesInCart($session->getCurrentUser()[CARRELLO_ID]);
                    if ($articlesInCart !== CARRELLO_UNSET) {
                        if (is_array($articlesInCart) && !empty($articlesInCart)) {
                            foreach ($articlesInCart as $value) {
                                $whereArticleId = "Id = " . $value[ARTICOLO_ID];
                                $article = $session->getRecord(ARTICOLO, $whereArticleId);
                                if ($article !== null) {
                                    $finalAmount = $finalAmount + floatval($article[PREZZO]);
                                    $whereProductId = "Id = " . $article[PRODOTTO_ID];
                                    $product = $session->getRecord(PRODOTTO, $whereProductId);
                                    if ($product !== null) {
                                        echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
                                                    <div>
                                                        <h6 class="my-0">' . $product[NOME] . '</h6>
                                                        <small class="text-muted">' . $product[DESCRIZIONE] . '</small>
                                                    </div>
                                                    <span class="text-muted">' . EURO . ' ' . $article[PREZZO] . '</span>
                                                </li>';
                                    }
                                }
                            }
                        }
                    }
                    echo '<li class="list-group-item d-flex justify-content-between">
                                <span>Totale (EUR)</span>
                                <strong>' . EURO . ' ' . $finalAmount . '</strong>
                         </li>';
                } else {
                    echo '<div>Non sembri essere registrato? <a class="btn btn-outline-secondary" href="./login.php">Accedi</a></div>';
                }
                ?>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <div class="container rounded" style="background: white;">
                <h4 class="mb-3">Informazioni spedizone</h4>
                <form method="post">
                    <?php
                    if (isset($_SESSION[ID])) {
                        $session = new Session($_SESSION[ID]);
                        $where = "Id = " . $session->getCurrentUser()[INDIRIZZO_ID] . " AND Id != 1";
                        $addressObj = $session->getRecord(INDIRIZZO, $where);
                        if ($addressObj !== null) {
                            echo
                                '<h3 class="mb-3">Dati indirizzo</h3>
                                <p class="mb-0">Via: ' . $addressObj[VIA] . '</p>
                                <p class="mb-0">Città: ' . $addressObj[CITTA] . '</p>
                                <p class="mb-0">Civico: ' . $addressObj[NUMERO_CIVICO] . ' </p>
                                <p class="mb-0">CAP: ' . $addressObj[CAP] . ' </p>';
                        } else {
                            echo '<div>Inserisci dati indirizzo: <a class="btn btn-outline-secondary" href="./address.php">Dati indirizzo</a></div>';
                        }
                    } else {
                        echo '<div>Non sembri essere registrato: <a class="btn btn-outline-secondary" href="./login.php">Accedi</a></div>';
                    }
                    ?>

                    <hr class="mb-4">

                    <h4 class="mb-3">Pagamento</h4>
                    <div class="d-block my-3">
                        <?php
                        if (isset($_SESSION[ID])) {
                            $session = new Session($_SESSION[ID]);
                            $where = "Utente_id = " . $session->getCurrentUser()[ID];
                            $cardPayObj = $session->getRecord(FORMA_DI_PAGAMENTO, $where);
                            if ($cardPayObj !== null) {
                                echo
                                    '<h3 class="mb-3">Dati pagamento</h3>
                                    <p class="mb-0">Circuito: ' . $cardPayObj[CIRCUITO] . '</p>
                                    <p class="mb-0">Numero Carta: ' . $cardPayObj[NUMERO_CARTA] . '</p>
                                    <p class="mb-0">Data scadenza: ' . $cardPayObj[DATA_SCADENZA] . ' </p>
                                    <p class="mb-0">CVV: ' . $cardPayObj[CVV] . ' </p>';
                            } else {
                                echo '<div>Inserisci dati pagamento: <a class="btn btn-outline-secondary" href="./cardPayForm.php">Forma di pagamento</a></div>';
                            }
                        } else {
                            echo '<div class="d-flex justify-content-end">
                                <div>Non sembri essere registrato: <a class="btn btn-outline-secondary" href="./login.php">Accedi</a>
                                </div>
                                </div>';
                        }
                        ?>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block ml-auto float-end" type="submit" name="checkout">Continua</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2022-2023 Take-it</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>