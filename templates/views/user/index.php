<!-- Questa sarà la pagina home del user / guest

Funzionalità richieste:
    .1 : cose varie 
    .2 : (se sei guest in invito a registrarti oppure loggare) -> (che poi scompare)
    .3 : Abbonati a premium
    .4 : query varie 
 -->

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

<!--
<section id="second">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo IMG?>/intro01.jpg" class="d-block h-100" alt="intro01">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo IMG?>/intro01.jpg" class="d-block h-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo IMG?>/intro01.jpg" class="d-block h-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
</section> -->

<section id="">
    <div class="row">

        <div class="col"><?php require './templates/views/components/productCard.php'; ?></div>
    </div>
</section>

<section id="articles">

</section>

<section id="">
    <?php require './templates/views/user/premium.php';?>
</section>

