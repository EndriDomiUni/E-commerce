<?php

// queste due linee fungono da debugger
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./src/classes/Session.php";

$session = new Session($_SESSION[ID]);
$articlesInStock = $session->getArticlesInStockByWarehouse($_SESSION[MAGAZZINO_ID]);

$products = $session->getAllProductsBySeller($session->getCurrentUser()[ID]);

foreach ($products as $product)
{
    //TODO: controllare da qui
    $articles = $session->getArticlesByProductId($product[0][ID]);
    $articlesQuantity = 0;
    foreach ($articles as $article)
    {
        foreach ($articlesInStock as $articleInStock)
        {
            if ($articleInStock[ARTICOLO_ID] === $article[ID])
            {
                $articlesQuantity += $articleInStock[QUANTITA];
            }
        }

    }
    if ($articlesQuantity > 0)
    {
        echo '<div class="container my-5 ">';

        echo '
    <div class="card">
      <div class="row">
        <div class="col-md-6">
          <img src="' . UPLOADS . '/' . $product[0][IMMAGINE] . '" height="200" width="200" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col">
              <h5>' . $product[0][NOME] . '</h5>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p>' . $product[0][NOME] . '</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p>Quantity: ' . $articlesQuantity . '</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <button type="submit" class="btn btn-primary" name="move-button">Move</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal' . $product[0][ID] . '">Edit Quantity</button>
          <button type="submit" class="btn btn-danger">Remove Article</button>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="myModal' . $product[0][ID] . '" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="myModalTitle">' . $product[0][NOME] . '</h5>
             </div>
             <div class="modal-body">
               <div class="form-group">
                 <label for="selectOption">Opzione</label>
                 <select class="form-control" id="selectOption">';
        foreach ($articles as $article)
        {
            $mapConfigurations = [];
            $articleConfigurations = $session->getArticleConfigurations($article[ID]);
            foreach ($articleConfigurations as $articleConfiguration) {
                $option = $session->getOptionById($articleConfiguration[OPZIONE_ID]);
                $variation = $session->getVariationById($option[VARIAZIONE_ID]);
                $configuration = [ $variation[NOME] => $option[VALORE] ];
                $mapConfigurations[] = $configuration;
            }
            echo '<option value="';
            for ($i = 0; $i < count($mapConfigurations); $i++) {

                if ($i > 0) {
                    echo '-';
                }

                $variationName = array_keys($mapConfigurations[$i])[0];
                $optionValue = array_values($mapConfigurations[$i])[0];
                echo $optionValue;
            }
            echo '">';
            for ($i = 0; $i < count($mapConfigurations); $i++) {
                /*
                if ($i > 0) {
                    echo ' - ';
                }
                */
                $variationName = array_keys($mapConfigurations[$i])[0];
                $optionValue = array_values($mapConfigurations[$i])[0];
                echo $variationName . ' ' . $optionValue;
            }
            echo '</option>';
        }
        echo ' 
               </select>
               </div>
               <div class="form-group">
                 <label for="quantityInput">Quantità</label>
                 <input type="number" class="form-control" id="quantityInput">
               </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
               <button type="submit" class="btn btn-primary">Conferma</button>
             </div>
           </div>
        </div>
      <div>
    </div>
';
    }
    echo '</div>';

}
