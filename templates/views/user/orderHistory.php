
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
            echo '<tr>
                <td>' . $orders[ID] . '</td>
                <td>' . $orders[DATA_ORDINE] . '</td>
                <td>' . $orders[TOTALE_ORDINE] . '</td>
                <td>Pagato</td>
                <td>
                  <a href="#" class="btn btn-primary">Visualizza Dettagli</a>
                </td>
              </tr>';
        }
    } else {
        header("Location: login.php");
    }
    ?>
    </tbody>
  </table>
</div>
