<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
            <div class="container text-center">

                <img src="<?php echo IMG; ?>/logo.svg" width="100" height="100" alt="Logo">
                <div class="signin-intro">
                    <h1 id="greeting-msg" class="heading">Take-it</h1>
                    <span id="signin-reg-msg" tabindex="-1" class="sub-heading">Registrati o <a href="login.php" id="create-account-link">Accedi</a>
                    </span>
                </div>

                <div class="switch-account-type-reg">
                    <div hidden="">
                        <svg hidden="" focusable="false" xmlns="http://www.w3.org/2000/svg">
                            <symbol id="icon-radio-checked" viewBox="0 0 18 18">
                                <path d="M9 0a9 9 0 110 18A9 9 0 019 0zm0 1a8 8 0 100 16A8 8 0 009 1zm0 3a5 5 0 110 10A5 5 0 019 4z"></path>
                            </symbol>
                            <symbol id="icon-radio-unchecked" viewBox="0 0 18 18">
                                <path d="M9 18A9 9 0 119 0a9 9 0 010 18zM9 1a8 8 0 100 16A8 8 0 009 1z"></path>
                            </symbol>
                            <symbol viewBox="0 0 18 18" id="icon-close">
                                <path d="M10.41 9l7.294-7.287A1.004 1.004 0 0016.285.294L9 7.59 1.715.294a1.002 1.002 0 10-1.42 1.42l7.296 7.285-7.295 7.286a1 1 0 000 1.42 1 1 0 001.419 0L9 10.407l7.285 7.296a1 1 0 001.42 0 1 1 0 000-1.419l-7.296-7.286z"></path>
                            </symbol>
                            <symbol viewBox="0 0 16 16" id="icon-information-small">
                                <path fill="##707070" d="M8 0a8 8 0 100 16A8 8 0 008 0zm1 11a1 1 0 01-2 0V8a1 1 0 112 0v3zM8 6a1 1 0 110-2 1 1 0 010 2z"></path>
                            </symbol>
                        </svg>
                    </div>
                    <fieldset>
                        <legend class="clipped">Tipo di account</legend>
                        <span class="field option">
                            <span class="field__control radio"><span class="radio" style="align-items:center">
                                    <input type="radio" value="personalaccount" name="accountcreate" id="personalaccount-radio" class="radio__control" checked="">
                                    <span class="radio__icon" hidden="">
                                        <svg height="24px" width="24px" class="radio__checked icon icon--radio-checked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true">
                                            <use xlink:href="#icon-radio-checked"></use>
                                        </svg>
                                        <svg height="24px" width="24px" class="radio__unchecked icon icon--radio-unchecked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true">
                                            <use xlink:href="#icon-radio-unchecked"></use>
                                        </svg></span></span>
                            </span>
                            <span><label class="field__label field__label--end switch-account-type-reg__label" for="personalaccount-radio">Account privato</label>
                            </span>
                        </span>
                        <span class="field option">
                            <span class="field__control radio"><span class="radio" style="align-items:center">
                                    <input type="radio" value="businessaccount" name="accountcreate" id="businessaccount-radio" class="radio__control">
                                    <span class="radio__icon" hidden="">
                                        <svg height="24px" width="24px" class="radio__checked icon icon--radio-checked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true">
                                            <use xlink:href="#icon-radio-checked"></use>
                                        </svg><svg height="24px" width="24px" class="radio__unchecked icon icon--radio-unchecked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true">
                                            <use xlink:href="#icon-radio-unchecked"></use>
                                        </svg></span></span>
                            </span>
                            <span><label class="field__label field__label--end switch-account-type-reg__label margin__right-zero" for="businessaccount-radio">Account professionale</label>
                            </span>
                        </span>
                    </fieldset>
                </div>

                <script>
                    // get the current "value" [personalaccount, businessaccount] from radiobotton 
                    // and show/hide the appropriate value 
                    $(document).ready(function() {
                        $('input[type="radio"]').click(function() {
                            let inputValue = $(this).attr("value");
                            let targetBox = $("." + inputValue);
                            $(".box").not(targetBox).hide();
                            $(targetBox).show();
                        });
                    });
                </script>

                <div class="personalaccount box">
                    <section class="form-signin w-100 m-auto show">
                        <form method="post">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="personal-name-register" placeholder="Mario" required name="personal-name-register">
                                        <label for="personal-name-register">Nome</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="personal-surname-register" placeholder="Rossi" required name="personal-surname-register">
                                        <label for="personal-surname-register">Cognome</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input type="email" class="form-control" id="personal-mail-register" placeholder="mario.rossi@example.com" required name="personal-mail-register">
                                <label for="personal-mail-register">Indirizzo email</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="personal-password-register" placeholder="Password" required name="personal-password-register">
                                <label for="personal-password-register">Password</label>
                            </div>
                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary" type="submit" name="personal-btn-register">Registrati</button required>
                            <p class="mt-5 mb-3 text-muted">© 2022-2023</p>
                        </form>
                    </section>
                </div>

                <div class="businessaccount box" style="display: none">
                    <section class="form-signin w-100 m-auto">
                        <form method="post">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="business-name-register" placeholder="Mario" required name="business-name-register">
                                        <label for="business-name-register">Nome</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="business-name-register" placeholder="Rossi" required name="business-surname-register">
                                        <label for="business-surname-register">Cognome</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input type="email" class="form-control" id="business-mail-register" placeholder="mario.rossi@example.com" required name="business-mail-register">
                                <label for="business-mail-register">Indirizzo email</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="business-password-register" placeholder="Password" required name="business-password-register">
                                <label for="business-password-register">Password</label>
                            </div>
                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary" type="submit" name="business-btn-register">Registrati</button>
                            <p class="mt-5 mb-3 text-muted">© 2022-2023</p>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-sm">
        </div>
    </div>
</div>