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

<section id="intro">
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal">
                Take-it
            </h1>
            <p class="lead fw-normal">Benvenuto in take-it, il tuo sportello unico per tutte le tue esigenze di acquisto.</p>
            <p class="lead fw-normal">Con un'ampia selezione di prodotti a prezzi imbattibili, ti aiutiamo a trovare facilmente quello che stai cercando.</p>
            <p class="lead fw-normal">La nostra spedizione veloce e affidabile garantisce che i tuoi ordini arrivino puntuali, ogni volta. Acquista con noi oggi e porta tutto a casa con take-it!</p>
            <a class="btn btn-outline-secondary" href="./login.php">Accedi</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
</section>


<section id="articles">
    <?php
    showAllArticles();
    ?>
</section>

<section id="intro">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo IMG?>/intro01.jpg" class="d-block w-100" alt="image1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Caption 1</h5>
                    <p>Description 1</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image2.jpg" class="d-block w-100" alt="image2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Caption 2</h5>
                    <p>Description 2</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image3.jpg" class="d-block w-100" alt="image3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Caption 3</h5>
                    <p>Description 3</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>


<section id="premium">
    <?php require './templates/views/user/premium.php';?>
</section>

