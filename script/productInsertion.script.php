<?php

// queste due linee fungono da debbuger
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

require_once "./src/classes/Session.php";


$session = new Session($_SESSION[ID]);

if (isset($_POST['product-btn-insert']))
{

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["product-image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["product-image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".</br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.</br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.</br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["product-image"]["size"] > 500000) {
        echo "Sorry, your file is too large.</br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.</br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.</br>";
        // if everything is ok, try to upload file
    } else {
        /*
        echo $_FILES["product-image"]["tmp_name"]."</br>";
        echo $target_file."</br>";
        $dirpath = realpath(dirname(getcwd()));
        echo $dirpath."</br>";

        //$destination_path = getcwd().DIRECTORY_SEPARATOR;
        //$target_path = $destination_path .$target_dir . basename( $_FILES["product-image"]["name"]);
        //$imageFile = fopen(basename( $_FILES["product-image"]["name"]), "a") or die("Unable to open file!");
        $txt = "";
        $imageFile = file_put_contents(basename( $_FILES["product-image"]["name"]), $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        $target_path = $target_dir . basename( $_FILES["product-image"]["name"]);
        //echo $destination_path."</br>";
        echo $target_path."</br>";
        chmod($target_path,0755);
        //mkdir('/Trade/upload/'.$imageFile, 0755, true);
        if (move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_path)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["product-image"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        //fclose($imageFile);
        */
    }

    $params = array(
        NOME => filter_var($_POST['product-name'], FILTER_SANITIZE_SPECIAL_CHARS),
        DESCRIZIONE => filter_var($_POST['product-description'], FILTER_SANITIZE_SPECIAL_CHARS),
        IMMAGINE => $target_file,
        DIMENSIONE_X_PRODOTTO => filter_var($_POST['product-dimensionX'], FILTER_SANITIZE_SPECIAL_CHARS),
        DIMENSIONE_Y_PRODOTTO => filter_var($_POST['product-dimensionY'], FILTER_SANITIZE_SPECIAL_CHARS),
        DIMENSIONE_Z_PRODOTTO => filter_var($_POST['product-dimensionZ'], FILTER_SANITIZE_SPECIAL_CHARS),
        CATEGORIA_ID => filter_var($_POST['product-category'], FILTER_SANITIZE_SPECIAL_CHARS)
    );
    try {
        $response = $session->insertProduct($params);
        echo "response: ".$response."</br>";
        if($response)
        {
            echo "[DEBUG:productInsertion.script.php->29]".$response."</br>";
            $_SESSION[PRODOTTO_ID] = $response;
            $_SESSION[CATEGORIA_ID] = $params[CATEGORIA_ID];
            //header("Location: selectVariations.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}