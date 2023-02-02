<!-- TODO: Inserire configurazione articolo -->
<section class="">
    <div class="container">
        <?php if (isset($error)){
            //echo "<div class='alert alert-warning' role='alert'>";
            // echo  $error;
            // echo "</div> ";
            echo notifyAlert($error, 'danger');
        } ?>
        <form>
            <!-- Variazioni -->
            <div class="mb-3">
                <?php
                    $dbh = new Dbh();
                    $categoryId = $_SESSION[CATEGORIA_ID];
                    $variations = $dbh->getVariationsByCategoryId($categoryId);
                    foreach ($variations as $variation)
                    {
                        echo "<label for='categoriaId'>Categoria</label>";
                        echo "<select class='form-select' id='categoriaId'>";
                        $options = $dbh->getOptionsByVariationId($variation["Id"]);
                        foreach ($options as $option)
                        {
                            $optionId = $option["Id"];
                            $optionValue = $option["Valore"];
                            echo "<option value='$optionId'>$optionValue</option>";
                        }
                        echo "</select>";
                    }
                ?>
            </div>
            <!-- Prezzo articolo -->
            <div class="mb-3">
                <label for="articlePrice" class="form-label">Prezzo dell'articolo</label>
                <input type="text" class="form-control" id="articlePrice" aria-describedby="articlePriceHelp" />
                <div id="articlePriceHelp" class="form-text">Verrà visualizzato come prezzo dell'articolo.</div>
            </div>
            <!-- Magazzino -->
            <div class="mb-3">
                <label for="magazzinoId">Categoria</label>
                <select class="form-select" d="magazzinoId">
                    <option value="">--Seleziona magazzino--</option>
                    <?php
                    $dbh = new Dbh();
                    $warehouses = $dbh->getWarehouses();
                    foreach ($warehouses as $warehouse) {
                        //$nome = $warehouse["Nome"];
                        $warehouseId = $warehouse["Id"];
                        echo "<option value='$warehouseId'>$warehouse</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="article-btn-insert">Inserisci Articolo</button>
        </form>
    </div>