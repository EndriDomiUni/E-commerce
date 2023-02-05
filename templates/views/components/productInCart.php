

<section>

    <?php
        if (isset($_SESSION["Id"])) {

            $session = new Session($_SESSION["Id"]);
            $cartId = "";
            $articlesInCart = $session->loadArticlesInCart($cartId);

            foreach ($articlesInCart as $value) {


                echo '<div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product Name</h5>
                            <p class="card-text">Product Description: </p>
                            <p class="card-text">Quantity: </p> <!-- da aggiungere due pulsanti -->
                            <p class="card-text">Price: </p>
                        </div>
                    </div>';
            }
        }
    ?>
</section>


