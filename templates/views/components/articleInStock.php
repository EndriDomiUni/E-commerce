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
            if ($articleInStock[ARTICOLO_ID] == $article[ID])
            {
                var_dump($articleInStock);

                $articlesQuantity += $articleInStock[QUANTITA];
            }
        }
    }
    if ($articlesQuantity > 0)
    {
        echo '
  <div class="container">
    <div class="card">
      <div class="row">
        <div class="col-md-6">
          <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col">
              <h5>' . $product[NOME] . '</h5>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p>' . $product[NOME] . '</p>
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
          <button class="btn btn-primary">Move</button>
          <button class="btn btn-primary">Change Quantity</button>
          <button class="btn btn-danger">Remove Article</button>
        </div>
      </div>
    </div>
  </div>
';
    }
}
