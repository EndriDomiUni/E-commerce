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
          <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal1-' . $product[0][ID] . '">Move</button>
          <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal2-' . $product[0][ID] . '">Edit Quantity</button>
          <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal3-' . $product[0][ID] . '">Remove Article</button>
        </div>
      </div>
      
        <!-- Modal Move Article in stock -->
        
        <div class="modal fade" name="myModal1-' . $product[0][ID] . '" id="myModal1-' . $product[0][ID] . '" tabindex="-1"
            aria-labelledby="myModal1Title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModal1Title">' . $product[0][NOME] . '</h5>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-group">
              OPZIONE_VARIAZIONE                  <label for="selectOptionVariation1">Opzione</label>    
                                <select class="form-control" id="selectOptionVariation1" name="article-configurations-select1-' . $product[0][ID] .'">';
        generateOptionsVariation($session, $articles);
        echo ' 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="selectWarehouse">Opzione</label>    
                                <select class="form-control" id="selectWarehouse" name="warehouse-select1-' . $product[0][ID] .'">';
        generateWarehouseOptions($session);
        echo ' 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantityInput1">Quantità</label>
                                <input type="number" class="form-control" id="quantityInput1" name="quantity-input1-' . $product[0][ID] . '">
                            </div>
                         </div>  
                         <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <button type="submit"  class="btn btn-primary" id="move-' . $product[0][ID] . '"
                                name="move-' . $product[0][ID] . '">Conferma</button>
                        </div>      
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Move Article in stock -->
        
        <!-- Modal Edit quantity -->

        <div class="modal fade" name="myModal2-' . $product[0][ID] . '" id="myModal2-' . $product[0][ID] . '" tabindex="-1"
            aria-labelledby="myModal2Title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModal2Title">' . $product[0][NOME] . '</h5>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="selectOption2">Opzione</label>
                                <select class="form-control" id="selectOption2" name="article-configurations-select2-' . $product[0][ID] .'">';
        generateOptionsVariation($session, $articles);

        echo '
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantityInput2">Quantità</label>
                                <input type="number" class="form-control" id="quantityInput2" name="quantity-input2-' . $product[0][ID] . '">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <button type="submit"  class="btn btn-primary" id="edit-quantity-' . $product[0][ID] . '"
                                name="edit-quantity-' . $product[0][ID] . '">Conferma</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal edit -->
        
        <!-- Modal remove -->
        <div class="modal fade" name="myModal23-' . $product[0][ID] . '" id="myModal3-' . $product[0][ID] . '" tabindex="-1"
            aria-labelledby="myModal2Title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModal3Title">' . $product[0][NOME] . '</h5>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="selectOption3">Opzione</label>
                                <select class="form-control" id="selectOption3" name="article-configurations-select3-' . $product[0][ID] .'">';
        generateOptionsVariation($session, $articles);

        echo '
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <button type="submit"  class="btn btn-primary" id="remove-' . $product[0][ID] . '"
                                name="remove-' . $product[0][ID] . '">Conferma</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
';
    }
    echo '</div>';

}


function generateOptionsVariation(Session $session, $articles) : void
{
    foreach ($articles as $article)
    {
        $mapConfigurations = getMapArticleConfigurations($session, $article[ID]);
        echo '<option value="' . $article[ID] . '">';
        for ($i = 0; $i < count($mapConfigurations); $i++) {

            if ($i > 0) {
                echo ' ';
            }

            //$variationName = array_keys($mapConfigurations[$i])[0];
            $optionValue = array_values($mapConfigurations[$i])[0];
            echo   $optionValue;
        }
        echo '</option>';
    }
}

