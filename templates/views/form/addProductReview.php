<section id="review-form">
    <div class="container">

        <div class="row">
            <div class="col-md-4 my-1">

                <?php
                    if (isset($_GET['id'])) {
                        $dbh = new Dbh();
                        $product = $dbh->getRecord(PRODOTTO, "Id = " . $_GET['id']);
                        echo '
                       <div class="card">
                          <img src="' . UPLOADS . '/' . $product[IMMAGINE] . '" class="card-img-top img-fluid" alt="Product Image">
                          <div class="card-body">
                            <h5 class="card-title">' . $product[NOME] . '</h5>
                            <p class="card-text">' . $product[DESCRIZIONE] . '</p>
                          </div>
                        </div> 
                        ';
                    }
                ?>
            </div>
            <div class="col-md-4 my-1">
                <h2 class="text-center mb-4"><strong>Inserisci una recensione</strong></h2>
                <form method="post">
                    <div class="form-group">
                        <label for="review-description">Descrizione</label>
                        <textarea class="form-control" id="review-description" rows="3" name="comment"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="review-rating">Valutazione</label>
                        <select class="form-control" id="review-rating" name="evaluation">
                            <option value="1">1 stella</option>
                            <option value="2">2 stelle</option>
                            <option value="3">3 stelle</option>
                            <option value="4">4 stelle</option>
                            <option value="5">5 stelle</option>
                        </select>
                    </div>
                    <div class="text-end my-2">
                        <button type="submit" class="btn btn-primary btn-lg" name="btn-send-reviews">Invia recensione</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



