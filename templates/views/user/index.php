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
                <img src="<?php echo IMG; ?>/intro01.jpg" class="d-block w-100" alt="img-intro01">
            </div>
            <div class="carousel-item">
                <img src="<?php echo IMG; ?>/intro02.jpg" class="d-block w-100" alt="img-intro02">
            </div>
            <div class="carousel-item">
                <img src="<?php echo IMG; ?>/intro03.jpg" class="d-block w-100" alt="img-intro03">
            </div>
        </div>
    </div>
</section>


<section id="premium">
    <?php require './templates/views/user/premium.php';?>
</section>

