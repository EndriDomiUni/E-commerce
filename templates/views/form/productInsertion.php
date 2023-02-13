<!-- Questa sarà la pagina Dashboard del seller 

Funzionalità richieste:
    .1 : inserimento prodotti
    .2 : modifica dati 
    .3 : elimina account
    .4 : info sulle vendite
    .5 : ...
 -->

<!-- Inserimento prodotti -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<section class="form-addProduct w-100 m-auto">
    <div class="container">
        <?php if (isset($error)){
            //echo "<div class='alert alert-warning' role='alert'>";
            // echo  $error;
            // echo "</div> ";
            echo notifyAlert($error, 'danger');
        } ?>
        <form method="post" enctype="multipart/form-data">
            <!-- Nome prodotto -->
            <div class="mb-4">
                <label for="productName" class="form-label">Nome del prodotto</label>
                <input type="text" class="form-control" id="product-name" required name="product-name" aria-describedby="productNameHelp" />
                <div id="productNameHelp" class="form-text">Verrà visualizzato come titolo del prodotto.</div>
            </div>
            <!-- Descrizione prodotto -->
            <div class="mb-4">
                <label for="product-description" class="form-label">Descrizione</label>
                <input type="text" class="form-control" id="product-description" required name="product-description" />
            </div>
            <!-- Immagine prodotto -->
            <div>
                <div class="mb-4 d-flex justify-content-center">
                    <!-- TODO: usare javascript per caricare l'immagine inserita da input -->
                    <img alt="" style="width: 200px;" src="<?php
                    /*
                    echo $_SESSION[IMMAGINE];
                    if($_SESSION[IMMAGINE]!=null)
                    {
                        echo $_SESSION[IMMAGINE];
                    }
                    else
                    {
                        echo "";
                    }
                    */
                    ?>" />
                </div>
                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary btn-rounded">
                        <label class="form-label text-white m-1" for="product-image">Scegli file</label>
                        <input type="file" class="form-control d-none" id="product-image" required name="product-image" />
                    </div>
                </div>
            </div>
            <!-- Inserimento dimensioni -->
            <div>
                <div class="form-group">
                    <label for="product-dimensionX">Dimensione X:</label>
                    <input type="text" class="form-control" id="product-dimensionX" required name="product-dimensionX" />
                </div>
                <div class="form-group">
                    <label for="product-dimensionY">Dimensione Y:</label>
                    <input type="text" class="form-control" id="product-dimensionY" required name="product-dimensionY" />
                </div>
                <div class="form-group">
                    <label for="product-dimensionZ">Dimensione Z:</label>
                    <input type="text" class="form-control" id="product-dimensionZ" required name="product-dimensionZ" />
                </div>
            </div>
            <!-- Categoria prodotto -->
            <div class="mb-3">
                <label for="product-category">Categoria</label>
                <select class="form-select" id="product-category" required name="product-category">
                    <option value="">--Seleziona categoria prodotto--</option>
                        <?php
                            $dbh = new Dbh();
                            $categories = $dbh->getCategories();
                            foreach ($categories as $category) {
                                $nome = $category[NOME];
                                $categoryId = $category[ID];
                                echo "<option value='$categoryId'>$nome</option>";
                            }
                        ?>
                </select>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="product-btn-insert">Inserisci Prodotto</button>

        </form>
    </div>
</section>