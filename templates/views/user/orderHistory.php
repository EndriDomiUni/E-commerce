<style>
    body {
        background-color: #f2f2f2;
    }

    h2 {
        margin-bottom: 30px;
        color: #333;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center">Storico ordini</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Ordine ID</th>
            <th>Data</th>
            <th>Totale</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        // per ogni ordine ottieni dati
        if (isset($_SESSION[ID])) {
            $session = new Session($_SESSION[ID]);
            $orders = $session->loadOrders();
            if (!empty($orders)) {
                foreach ($orders as $order) {
                    echo '<tr>
                            <td>' . $order[ID] . '</td>
                            <td>' . $order[DATA_ORDINE] . '</td>
                            <td>' . $order[TOTALE_ORDINE] . '</td>
                            <td>Pagato</td>
                            <td>
                              <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                  Visualizza dettagli
                                </button>';

                    showOrderDetails($session, $order[ID]);
                    echo '</td>
                      </tr>';
                }
            }
        } else {
            header("Location: login.php");
        }
        ?>
        </tbody>
    </table>
</div>

<?php
    function showOrderDetails($session, $orderId): void
    {
        echo '<!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">';

        $orderDetails = $session->loadOrderDetails($orderId);
        if (!empty($orderDetails)) {
            foreach ($orderDetails as $orderDetail) {
                $whereArticleId = "Id = " . $orderDetail[ARTICOLO_ID];
                $article = $session->getRecord(ARTICOLO, $whereArticleId);
                // var_dump($article);
                if ($article !== null) {
                    $whereProductId = "Id = " . $article[PRODOTTO_ID];
                    $product = $session->getRecord(PRODOTTO, $whereProductId);
                    if ($product !== null) {
                        echo '<div class="card">
                                          <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" class="card-img-top" alt="Product Image">
                                          <div class="card-body">
                                            <h5 class="card-title">' . $product[NOME] . '</h5>
                                            <p class="card-text">' . $product[DESCRIZIONE] . '</p>
                                            <p class="card-text"> Prezzo:' . $article[PREZZO] . '</p>
                                            <a href="#" class="btn btn-primary">Redirect singolo</a>
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
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>';
    }
?>
