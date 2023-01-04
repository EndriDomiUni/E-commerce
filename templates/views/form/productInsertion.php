<!-- Questa sarà la pagina Dashboard del seller 

Funzionalità richieste:
    .1 : inserimento prodotti
    .2 : modifica dati 
    .3 : elimina account
    .4 : info sulle vendite
    .5 : ...
 -->

<!-- Inserimento prodotti -->
<section class="">
    <div class="container">
        <form>
            <div class="mb-3">
                <label for="productName" class="form-label">Nome del prodotto</label>
                <input type="text" class="form-control" id="productName" aria-describedby="productNameHelp" />
                <div id="productNameHelp" class="form-text">Verrà visualizzato come titolo del prodotto.</div>
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Descrizione</label>
                <input type="text" class="form-control" id="descriptionProductId" />
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Prezzo del prodotto</label>        
                <input type="Number" class="form-control" id="productPrice" aria-describedby="productPriceHelp" />
                <div id="productPriceHelp" class="form-text">Questo è l'importo visualizzato da tutti gli utenti.</div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary" name="product-btn-insert">Inserisci</button>
        </form>
    </div>
</section> 