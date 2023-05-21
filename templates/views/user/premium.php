<section>
    <div class="container">
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal" style="color: white;">Premium</h1>
            <p class="fs-5" style="color: #E8E9F0;">Sbloccate offerte e sconti esclusivi con l'abbonamento Premium di Take-it.
                Approfittate della spedizione gratuita e più veloce e del servizio clienti prioritario per ogni acquisto.
                Migliora la tua esperienza di acquisto e unisciti alla comunità VIP di Take-it oggi stesso!
            </p>
        </div>

        <form method="post">
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">Free</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">0 <?php echo EURO?> <small class="text-muted fw-light">/mo</small>
                            </h1>

                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Supporto email</li>
                                <li>Assistenza 9:00-13:00 & 14:00-18:00</li>
                            </ul>
                            <button type="submit" class="w-100 btn btn-lg btn-outline-primary" name="btn-base">Piano default
                            </button>
                        </div>
                    </div>
                </div>
            <?php
                if (isset($_SESSION[ID])) {
                    $session = new Session($_SESSION[ID]);
                    $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);
                    switch ($claimType) {
                        case CLAIM_USER_DESC:
                        case CLAIM_USER_PRO_DESC:
                            // for user
                            echo ' 
                                <div class="col">
                                    <div class="card mb-4 rounded-3 shadow-sm">
                                        <div class="card-header py-3">
                                            <h4 class="my-0 fw-normal">Pro</h4>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="card-title pricing-card-title">15 <?php echo EURO?> <small class="text-muted fw-light">/mo</small>
                                            </h1>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li>Spedizioni Gratuite</li>
                                                <li>Supporto prioritario email</li>
                                                <li>Assistenza h24</li>
                                            </ul>
                                            <button type="submit" class="w-100 btn btn-lg btn-primary" name="btn-user-pro">Vai
                                            </button>
                                        </div>
                                    </div>
                                </div>';
                            break;

                        case CLAIM_SELLER_DESC:
                        case CLAIM_SELLER_PR0_DESC:
                            // for seller
                            echo '
                            <div class="col">
                                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                                    <div class="card-header py-3 text-bg-primary border-primary">
                                        <h4 class="my-0 fw-normal">Azienda</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title pricing-card-title">29 <?php echo EURO?> <small class="text-muted fw-light">/mo</small>
                                        </h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>Spedizioni Gratuite</li>
                                            <li>Priorità supporto email</li>
                                            <li>Articoli in magazzino gratuiti</li>
                                            <li>Assistenza 24h</li>
                                        </ul>
                                        <button type="submit" class="w-100 btn btn-lg btn-primary" name="btn-seller-pro">Contattaci
                                        </button>
                                    </div>
                                </div>
                            </div>
                            ';
                            break;
                    }
                } else {

                    // if user not logged
                    echo '                  
                        <div class="col">
                            <div class="card mb-4 rounded-3 shadow-sm">
                                <div class="card-header py-3">
                                    <h4 class="my-0 fw-normal">Pro</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">15 <?php echo EURO?> <small class="text-muted fw-light">/mo</small>
                                    </h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>Spedizioni Gratuite</li>
                                        <li>Supporto prioritario email</li>
                                        <li>Assistenza h24</li>
                                    </ul>
                                    <button type="submit" class="w-100 btn btn-lg btn-primary" name="btn-user-pro">Vai
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-4 rounded-3 shadow-sm border-primary">
                                <div class="card-header py-3 text-bg-primary border-primary">
                                    <h4 class="my-0 fw-normal">Azienda</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">29 <?php echo EURO?> <small class="text-muted fw-light">/mo</small>
                                    </h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>Spedizioni Gratuite</li>
                                        <li>Priorità supporto email</li>
                                        <li>Articoli in magazzino gratuiti</li>
                                        <li>Assistenza 24h</li>
                                    </ul>
                                    <button type="submit" class="w-100 btn btn-lg btn-primary" name="btn-seller-pro">Contattaci
                                    </button>
                                </div>
                            </div>
                        </div>';
                }
            ?>
            </div>
        </form>
    </div>
</section>
