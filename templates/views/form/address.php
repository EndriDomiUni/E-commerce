

<div class="container" id="address-container">
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm">
            <section class="form-signin w-100 m-auto">
                <div class="container text-center">
                    <img src="<?php echo IMG; ?>/logo.svg" width="100" height="100" alt="Logo">
                    <div class="signin-intro">
                        <h1 id="greeting-msg" class="heading">Take-it</h1>
                        <span id="signin-reg-msg" tabindex="-1" class="sub-heading">Informazioni indirizzo</a>
                    </span>
                    </div>
                    <div class="signin-intro">
                        <h3 id="greeting-msg" class="heading"></h3>
                        <span id="signin-reg-msg" tabindex="-1" class="sub-heading">Compila le informazioni riguardanti l'indirizzo in cui vorrai farti arrivare i pacchi</a>
                    </span>
                    </div>
                    <form method="post">
                        <div class="row">
                            <div class="col-9">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="via" placeholder="Inserisci via" required name="via">
                                    <label for="personal-surname-register">Via</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="Numero_civico" placeholder="Inserisci civico" required name="Numero_civico">
                                    <label for="Numero_civico">Civico</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="Citta" placeholder="Inserisci città" required name="Citta">
                            <label for="Citta">Città</label>
                        </div>


                        <div class="form-floating">
                            <input type="text" class="form-control" id="CAP" placeholder="Inserisci CAP" required name="CAP">
                            <label for="CAP">CAP</label>
                        </div>

                        <button class="w-100 btn btn-lg btn-primary" type="submit" name="btn-address"">Invio</button>
                        <p class="mt-5 mb-3 text-muted">© 2022–2023</p>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-sm"></div>
    </div>
</div>