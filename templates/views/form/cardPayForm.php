
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <section class="form-signin w-100 m-auto">
                <div class="container text-center my-3 rounded" style="background: white;">

                    <img src="<?php echo IMG; ?>/logo.svg" width="100" height="100" alt="Logo">
                    <div class="signin-intro">
                        <h1 id="greeting-msg" class="heading">Take-it</h1>
                        <span id="signin-reg-msg" tabindex="-1" class="sub-heading">Informazioni pagamento</a>
                    </span>
                    </div>
                    <div class="signin-intro">
                        <h3 id="greeting-msg" class="heading"></h3>
                        <span id="signin-reg-msg" tabindex="-1" class="sub-heading">Compila le informazioni riguardanti la forma di pagamento</a>
                    </span>
                    </div>

                    <form method="post">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="Numero_carta" placeholder="name@example.com" name="Numero_carta" required>
                                <label for="Numero_carta">Numero carta</label>
                            </div>

                            <div class="form-floating">
                                <input type="date" class="form-control" id="Data_scadenza" placeholder="name@example.com" name="Data_scadenza" required>
                                <label for="Data_scadenza">Data scadenza</label>
                            </div>

                            <div class="form-floating">
                                <input type="text" class="form-control" id="CVV" placeholder="name@example.com" name="CVV" required>
                                <label for="CV2">CVV</label>
                            </div>

                            <div class="form-floating">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="Tipo_di_pagamento">
                                    <option selected>Tipo di pagamento</option>
                                    <option value="1">Una volta</option>
                                    <option value="2">PayPal</option>
                                    <option value="3">Ricorrente</option>
                                </select>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary" name="btn-card-pay">Submit</button>
                    </form>
                </div>
            </section>
        </div>
        <div class="col"></div>
    </div>
</div>

