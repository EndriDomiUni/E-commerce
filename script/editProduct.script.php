<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";

$session = new Session($_SESSION[ID]);

$productId = $_SESSION[PRODOTTO_ID];
echo "product id: " .$productId."</br>";
if (isset($_POST['btn-edit-product'])){


    $target_dir = "/uploads/";
    echo "target dir: ".$target_dir."</br>";
    list($result, $msg) = $session->uploadImage($target_dir, $_FILES["product-image"]);

    try {
        $response = $session->editProduct(
            $productId,
            filter_var($_POST['product-name'], FILTER_SANITIZE_SPECIAL_CHARS),
            filter_var($_POST['product-description'], FILTER_SANITIZE_SPECIAL_CHARS),
            $msg
        );
        echo "response: ".$response."</br>";
        if($response !== null)
        {
            //debug
            //echo "[DEBUG:productInsertion.script.php->29]".$response."</br>";
            echo '<div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Prodotto modificato con successo</h4>
                        </div>';

            header("Location: manageProducts.php");
        } else{
            echo '<div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Prodotto modificato con successo</h4>
                        </div>';
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }


}
