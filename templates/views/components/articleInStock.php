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
        echo '
  <div class="container my-5 ">
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
          <button class="btn btn-primary" name="move-button">Move</button>
          <button class="btn btn-primary" name="edit-quantity-button" data-toggle="modal" data-target="#myModal' . $product[0][ID] . '">Edit Quantity</button>
          <button class="btn btn-danger">Remove Article</button>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="myModal' . $product[0][ID] . '" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="myModalTitle">' . $product[0][NOME] . '</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <div class="form-group">
                 <label for="selectOption">Opzione</label>
                 <select class="form-control" id="selectOption">';
        foreach ($articles as $article)
        {
            $articleConfigurations = $session->getArticleConfigurations($article[ID]);
            foreach ($articleConfigurations as $articleConfiguration)
            {
                $option = $session->getOptionById($articleConfiguration[OPZIONE_ID]);
                $variation = $session->getVariationById($option[VARIAZIONE_ID]);
            }
        }
        echo '               
                   <option value="opzione1">Opzione 1</option>
                   <option value="opzione2">Opzione 2</option>
                   <option value="opzione3">Opzione 3</option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="quantityInput">Quantità</label>
                 <input type="number" class="form-control" id="quantityInput">
               </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
               <button type="button" class="btn btn-primary">Conferma</button>
             </div>
           </div>
        </div>
      <div>
        
        <!-- Trigger del Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Apri Modal
        </button>
      
    </div>
  </div>
';
    }


}
