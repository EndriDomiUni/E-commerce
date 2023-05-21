<style>
    /* Stili personalizzati */
    .form-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
    }
</style>


<?php
    if (isset($_SESSION[ID])) {
        if (isset($_GET['orderDetailId'])) {
            $session = new Session($_SESSION[ID]);
            $orderDetail = $session->getRecord(DETTAGLIO_ORDINE, "Id = ". $_GET['orderDetailId']);
            $article = $session->getRecord(ARTICOLO, "Id = " . $orderDetail[ARTICOLO_ID]);
            $product = $session->getRecord(PRODOTTO, "Id = " . $article[PRODOTTO_ID]);

            echo '<div class="container rounded my-3" style="background-color: white;">
                <div class="row">
                    <div class="col my-3">
                        <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" class="img-fluid rounded" alt="Product Image">
                    </div>
                    <div class="col">
                        <div class="form-container">
                        
                            <div class="card">                        
                              <div class="card-body">
                                <h5 class="card-title">' . $product[NOME] . '</h5>
                                <p class="card-text">' . $product[DESCRIZIONE] . '</p>
                              </div>
                            </div>
                        
                            <div class="container rounded" style="background-color: white;">
                                <h2 class="my-4 text-center">Modulo di reso</h2>
                                <form method="post">
                                    <div class="form-group">
                                        <label for="reason">Motivo del reso:</label>
                                        <select class="form-control" id="reason" required name="reason">
                                            <option value="">Seleziona un motivo</option>
                                            <option value="difettoso">Prodotto difettoso</option>
                                            <option value="errato">Prodotto errato</option>
                                            <option value="insoddisfatto">Soddisfazione insoddisfacente</option>
                                            <option value="altro">Altro motivo</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Descrizione:</label>
                                        <textarea class="form-control" id="description" rows="4" required name="comment"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end my-2 py-1">
                                        <button type="submit" class="btn btn-primary" name="btn-send-give-back">Invia reso</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>';
        } else {
            echo '<div>Errore nel caricamento della pagina. Ritorna alla <a href="../user/index.php">Home Page</a>!</div>';
        }
    } else {
        echo '<div>Non sembri essere loggato. <a href="./login.php">Accedi</a> o <a href="./register.php">Registrati</a>!</div>';
    }

?>





