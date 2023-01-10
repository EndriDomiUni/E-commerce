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
            <!-- Prezzo prodotto -->
            <div class="mb-3">
                <label for="productPrice" class="form-label">Prezzo del prodotto</label>        
                <input type="Number" class="form-control" id="productPrice" aria-describedby="productPriceHelp" />
                <div id="productPriceHelp" class="form-text">Questo è l'importo visualizzato da tutti gli utenti.</div>
            </div>
            <!-- Categoria prodotto -->
            <div class="mb-3">
                <select class="form-select">
                    <option value="">--Seleziona categoria prodotto--</option>
                        <?php
                        // TODO: Stampare il nome di ogni categoria
                        $dbh = new Dbh();
                            $categories = $dbh->getCategories();
                            foreach ($categories as $category) {
                                $nome = $category["Nome"];
                                echo "<option value='$nome'>$nome</option>";
                            }
                        ?>
                </select>
            </div>
            <div>

            </div>
            <button type="submit" class="btn btn-primary" name="product-btn-insert">Inserisci</button>
        </form>
    </div>
</section>