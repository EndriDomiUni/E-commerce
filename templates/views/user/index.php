<!-- Questa sarà la pagina home del user / guest

Funzionalità richieste:
    .1 : cose varie 
    .2 : (se sei guest in invito a registrarti oppure loggare) -> (che poi scompare)
    .3 : Abbonati a premium
    .4 : query varie 
 -->

<?php
    require_once "UIHelper.php";
?>

<?php
    if (!isset($_SESSION["Id"])) {
        echo '<section id="intro">
                <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
                    <div class="col-md-5 p-lg-5 mx-auto my-5">
                        <h1 class="display-4 fw-normal">
                            Take-it
                        </h1>
                        <p class="lead fw-normal">Benvenuto in take-it, il tuo sportello unico per tutte le tue esigenze di acquisto.</p>
                        <p class="lead fw-normal">Con un ampia selezione di prodotti a prezzi imbattibili, ti aiutiamo a trovare facilmente quello che stai cercando.</p>
                        <p class="lead fw-normal">La nostra spedizione veloce e affidabile garantisce che i tuoi ordini arrivino puntuali, ogni volta. Acquista con noi oggi e porta tutto a casa con take-it!</p>
                        <a class="btn btn-outline-secondary" href="./login.php">Accedi</a>
                    </div>
                    <div class="product-device shadow-sm d-none d-md-block"></div>
                    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
                </div>
            </section>';
    }
?>

<section id="articles">
    <h1 class="text-center">I nostri articoli</h1>

    <div class="container text-end py-2">
        <div class="sort-component">
            <label for="sort-select">Ordina per:</label>
            <select id="sort-select">
                <option value="0" <?php if (!isset($_SESSION['sortingMode'])) { echo "selected";} ?>>Predefinito</option>
                <option value="1" <?php if (isset($_SESSION['sortingMode']) && $_SESSION['sortingMode'] == SORT_MODE_PRICE_ASC) { echo "selected";} ?>>Prezzo: Basso a Alto</option>
                <option value="2" <?php if (isset($_SESSION['sortingMode']) && $_SESSION['sortingMode'] == SORT_MODE_PRICE_DESC) { echo "selected";} ?>>Prezzo: Alto a Basso</option>
                <option value="3" <?php if (isset($_SESSION['sortingMode']) && $_SESSION['sortingMode'] == SORT_MODE_NAME_ASC) { echo "selected";} ?>>Nome: A-Z</option>
                <option value="4" <?php if (isset($_SESSION['sortingMode']) && $_SESSION['sortingMode'] == SORT_MODE_NAME_DESC) { echo "selected";} ?>>Nome: Z-A</option>
            </select>
        </div>
    </div>
    <script>
        const selectElement = document.getElementById('sort-select');
        selectElement.addEventListener('change', (event) => {
            const selectedValue = event.target.value;
            console.log('Ordina per:', selectedValue);
            window.location.href = window.location.href+'?selectedValue='+selectedValue;
        });
    </script>

    <?php
        showAllArticles();
    ?>

    <script>
        let url= document.location.href;
        window.history.pushState({}, "", url.split("?")[0]);
    </script>
</section>

<section id="intro">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo IMG; ?>/intro01.jpg" class="d-block w-50 mx-auto" alt="img-intro01">
            </div>
            <div class="carousel-item">
                <img src="<?php echo IMG; ?>/intro02.jpg" class="d-block w-50 mx-auto" alt="img-intro02">
            </div>
            <div class="carousel-item">
                <img src="<?php echo IMG; ?>/intro03.jpg" class="d-block w-50 mx-auto" alt="img-intro03">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>



<section id="premium">
    <?php require './templates/views/user/premium.php';?>
</section>

<section>
    <style>
        <style>
        .review-section {
            background-color: #f8f9fa;
            padding: 40px 0;
        }

        .review-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .review-card .review-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .review-card .review-rating {
            font-size: 18px;
            color: #ffc107;
            margin-bottom: 10px;
        }

        .review-card .review-content {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .review-card .review-author {
            font-size: 14px;
            color: #888;
        }
    </style>

    <div class="container review-section">
        <h2 class="text-center">Recensioni - TakeIt</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="review-card">
                    <h3 class="review-title">Ottimo servizio!</h3>
                    <div class="review-rating">★★★★★</div>
                    <p class="review-content">Ho acquistato diversi prodotti da TakeIt e sono rimasto molto soddisfatto del servizio. Le consegne sono state puntuali e il supporto clienti è stato molto gentile e disponibile.</p>
                    <p class="review-author">- Mario Rossi</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="review-card">
                    <h3 class="review-title">Prodotti di alta qualità</h3>
                    <div class="review-rating">★★★★★</div>
                    <p class="review-content">TakeIt offre una vasta selezione di prodotti di alta qualità. Ho acquistato un laptop e sono rimasto colpito dalla sua prestazione e design. Consigliato!</p>
                    <p class="review-author">- Laura Bianchi</p>
                </div>
            </div>
        </div>
    </div>

</section>

