<style>
    h2 {
        margin-bottom: 30px;
        color: #333;
    }
</style>

<div class="container  rounded mt-5">
    <h2 class="text-center" style="color: white;">Fatture</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="color: white;">N° Fattura</th>
            <th style="color: white;">Data</th>
            <th style="color: white;">Imponibile</th>
            <th style="color: white;">Totale</th>
            <th style="color: white;">Dettagli</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // per ogni ordine ottieni dati
        if (isset($_SESSION[ID])) {

            $session = new Session($_SESSION[ID]);
            $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);

            switch ($claimType) {
                default:
                case CLAIM_USER_DESC:
                case CLAIM_USER_PRO_DESC:
                    break;

                case CLAIM_SELLER_DESC:
                case CLAIM_SELLER_PR0_DESC:
                    $invoices = $session->loadInvoices();
                    if (!empty($invoices)) {
                        $index = 1;
                        foreach ($invoices as $invoice) {
                            echo '<tr>
                                <td style="color: white;">' . $index++ . '</td>
                                <td style="color: white;">' . $invoice['Timestamp'] . '</td>
                                <td style="color: white;">' . $invoice['Imponibile'] . ' ' . EURO . '</td>
                                <td style="color: white;">' . $invoice['Totale'] . ' ' . EURO . '</td>                            
                                <td>
                                  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' . $invoice["Dettaglio_ordine_id"] . '">
                                      Visualizza dettagli
                                    </button>';
                            echo '</td>';
                            echo '<!-- Modal -->
                                <div class="modal fade" id="exampleModal' . $invoice["Dettaglio_ordine_id"] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Dettaglio ordine</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">';
                            $orderDetail = $session->getOrderDetail($invoice["Dettaglio_ordine_id"]);
                            if (!empty($orderDetail)) {
                                $whereArticleId = "Id = " . $orderDetail[0][ARTICOLO_ID];
                                $article = $session->getRecord(ARTICOLO, $whereArticleId);
                                if ($article !== null) {
                                    $whereProductId = "Id = " . $article[PRODOTTO_ID];
                                    $product = $session->getRecord(PRODOTTO, $whereProductId);
                                    if ($product !== null) {
                                        echo '<div class="card my-2">
                                          <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" class="card-img-top" alt="Product Image" height="200px" width="200px">
                                          <div class="card-body">
                                            <h5 class="card-title">' . $product[NOME] . '</h5>
                                            <p class="card-text">' . $product[DESCRIZIONE] . '</p>
                                            <p class="card-text"> Prezzo:' . $article[PREZZO] . ' ' . EURO . '</p>
                                            <p class="card-text"> Status: ' . $session->getDescriptionOrderDetailStatus($orderDetail[0][STATUS]) . '</p> 
                                          </div>                                           
                                    </div>';
                                    }
                                }
                            } else {
                                echo '<div>Errore nel caricamento dei dettagli ordine.</div>';
                            }
                            echo '            
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                            </div>';
                        }
                    }
                    else {
                        // echo '<div>Non ci sono fatture.</div>';
                    }
                    break;
            }
        } else {
            header("Location: login.php");
        }
        ?>
        </tbody>
    </table>
</div>

