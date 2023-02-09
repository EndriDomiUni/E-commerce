<!-- TODO: Inserire configurazione articolo -->
<?php
if (isset($error)){
    //echo "<div class='alert alert-warning' role='alert'>";
    // echo  $error;
    // echo "</div> ";
    echo notifyAlert($error, 'danger');

} ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<section class="form-articleConfiguration w-100 m-auto">
    <div class="container">

        <form method="post">
            <!-- Variazioni -->
            <div class="mb-3">
                <?php
                    $dbh = new Dbh();
                    $categoryId = $_SESSION[CATEGORIA_ID];
                    $whereCategoryId = "Id = ".$categoryId;
                    $categoryId = $dbh->selectSpecificField(CATEGORIA, ID, $whereCategoryId);
                    if($categoryId!==null){
                        //echo "categoria id: ".$categoryId."</br>";
                        $variations = $dbh->getVariationsByCategoryId($categoryId);
                        foreach ($variations as $variation){

                            echo "<label for='variation-id-{$variation[ID]}'>Variazione {$variation[NOME]}</label>";
                            echo "<select class='form-select' id='variation-id-{$variation[ID]}' name='variation-id-{$variation[ID]}' required>";
                            $options = $dbh->getOptionsByVariationId($variation[ID]);
                            foreach ($options as $option)
                            {
                                $optionId = $option["Id"];
                                $optionValue = $option["Valore"];
                                echo "<option value='$optionId'>$optionValue</option>";
                            }
                            echo "</select>";
                        }
                    }
                ?>
            </div>
            <!-- Prezzo articolo -->
            <div class="mb-3">
                <label for="article-price" class="form-label">Prezzo dell'articolo</label>
                <input type="text" class="form-control" id="article-price" name="article-price" aria-describedby="articlePriceHelp" required />
                <div id="articlePriceHelp" class="form-text">Verrà visualizzato come prezzo dell'articolo.</div>
            </div>

            <!-- Magazzino -->
            <div class="mb-3">
                <label for="warehouse-id">Magazzino</label>
                <select class="form-select" id="warehouse-id" name="warehouse-id" required>
                    <option value="">--Seleziona magazzino--</option>
                    <?php
                    $warehouses = $dbh->getWarehouses();
                    if(is_array($warehouses)){
                        foreach ($warehouses as $warehouse) {
                            $warehouseId = $warehouse["Id"];
                            $whereAddressId = "Id = " . $warehouse[INDIRIZZO_ID];
                            $addressVia = $dbh->selectSpecificField(INDIRIZZO, VIA, $whereAddressId);
                            echo "<option value='$warehouseId'>$addressVia</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="article-btn-insert">Inserisci Articolo</button>
        </form>
    </div>
</section>