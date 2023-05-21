<style>
    h2 {
        margin-bottom: 30px;
        color: #333;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center" style="color: white;">Storico ordini</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="color: white;">Ordine ID</th>
            <th style="color: white;">Data</th>
            <th style="color: white;">Totale</th>
            <th style="color: white;">Status</th>
            <th style="color: white;">Dettagli</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // per ogni ordine ottieni dati
        if (isset($_SESSION[ID])) {
            $session = new Session($_SESSION[ID]);
            $orders = $session->loadOrders();

            if (!empty($orders)) {
                $index = 1;
                foreach ($orders as $order) {
                    $orderId = $order[ID];
                    echo '<tr>
                                <td style="color: white;">' . $index++ . '</td>
                                <td style="color: white;">' . $order[DATA_ORDINE] . '</td>
                                <td style="color: white;">' . $order[TOTALE_ORDINE] . '</td>
                                <td style="color: white;">Pagato</td>
                                <td>
                                  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' . $orderId . '">
                                      Visualizza dettagli
                                    </button>';
                    echo '</td>';
                    echo '</tr>';
                    echo '<!-- Modal -->
                                <div class="modal fade" id="exampleModal' . $orderId . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Dettaglio ordine</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">';
                    $orderDetails = $session->loadOrderDetails($orderId);
                    if (!empty($orderDetails)) {
                        foreach ($orderDetails as $orderDetail) {
                            $whereArticleId = "Id = " . $orderDetail[ARTICOLO_ID];
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
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <!-- redirect to preduct page -->
                                                        <a href="./productPage.php?id=' . $product[ID] . '" target="_self" 
                                                             class="btn btn-primary text-end">Portami al prodotto</a>
                                                    </div>
                                                    <div class="col">
                                                        <!-- give back -->
                                                        <a href="./giveBackProduct.php?orderDetailId=' . $orderDetail[ID] . '" target="_self" 
                                                             class="btn btn-primary text-end">Effettua il reso</a> 
                                                    </div>
                                                    <div class="col">
                                                        <!-- reviews -->     
                                                        <a href="./addProductReview.php?id=' . $product[ID] . '&orderDetailId=' . $orderDetail[ID] . '" target="_self" 
                                                             class="btn btn-primary text-end">Aggiungi recensione</a>
                                                    </div>
                                                </div>    
                                              </div>
                                        </div>';
                                }
                            }
                        }
                    } else {
                        echo '<div>Fail to load</div>';
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
        } else {
            header("Location: login.php");
        }
        ?>
        </tbody>
    </table>
</div>

