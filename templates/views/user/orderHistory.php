
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

    echo '<tr>
        <td>#101</td>
        <td>01/01/2021</td>
        <td>$100</td>
        <td>Delivered</td>
        <td>
          <a href="#" class="btn btn-primary">Visualizza Dettagli</a>
        </td>
      </tr>';
    ?>
    </tbody>
  </table>
</div>
