<!-- Questa sarà la pagina Dashboard del seller 

Funzionalità richieste:
    .1 : inserimento prodotti
    .2 : modifica dati 
    .3 : elimina account
    .4 : info sulle vendite
    .5 : ...
 -->

<!-- Inserimento prodotti -->
<?php
require_once "./config/AppConstants.php";
require_once "./src/classes/Dbh.php";
?>
<section class="">
    <div class="container">
        <?php if (isset($error)){
            //echo "<div class='alert alert-warning' role='alert'>";
            // echo  $error;
            // echo "</div> ";
            echo notifyAlert($error, 'danger');
        } ?>
        <form>
            <!-- Nome prodotto -->
            <div class="mb-3">
                <label for="productName" class="form-label">Nome del prodotto</label>
                <input type="text" class="form-control" id="productName" aria-describedby="productNameHelp" />
                <div id="productNameHelp" class="form-text">Verrà visualizzato come titolo del prodotto.</div>
            </div>
            <!-- Descrizione prodotto -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Descrizione</label>
                <input type="text" class="form-control" id="descriptionProductId" />
            </div>
            <!-- Immagine prodotto -->
            <div>
                <div class="mb-4 d-flex justify-content-center">
                    <!-- TODO: usare javascript per caricare l'immagine inserita da input -->
                    <img alt="" style="width: 200px;" src="<?php
                    if($_SESSION["Immagine"]!=null)
                    {
                        echo $_SESSION["Immagine"];
                    }
                    else
                    {
                        echo "";
                    }
                    ?>" />
                </div>
                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary btn-rounded">
                        <label class="form-label text-white m-1" for="productImage">Scegli file</label>
                        <input type="file" class="form-control d-none" id="productImage" />
                    </div>
                </div>
            </div>
            <!-- Inserimento dimensioni -->
            <div>
                <div class="form-group">
                    <label for="productDimensionX">Name:</label>
                    <input type="text" class="form-control" id="productDimensionX">
                </div>
                <div class="form-group">
                    <label for="productDimensionY">Name:</label>
                    <input type="text" class="form-control" id="productDimensionY">
                </div>
                <div class="form-group">
                    <label for="productDimensionZ">Name:</label>
                    <input type="text" class="form-control" id="productDimensionZ">
                </div>
            </div>
            <!-- Categoria prodotto -->
            <div class="mb-3">
                <label for="categoriaId">Categoria</label>
                <select class="form-select" d="categoriaId">
                    <option value="">--Seleziona categoria prodotto--</option>
                        <?php
                            $dbh = new Dbh();
                            $categories = $dbh->getCategories();
                            foreach ($categories as $category) {
                                $nome = $category["Nome"];
                                $categoryId = $category["Id"];
                                echo "<option value='$categoryId'>$nome</option>";
                            }
                        ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="product-btn-insert">Inserisci Prodotto</button>
        </form>
    </div>
</section>