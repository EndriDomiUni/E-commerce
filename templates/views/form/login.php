
<div class="container">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
            <div class="container text-center">
                <main class="form-signin w-100 m-auto">

                    <?php if (isset($error)){
                        //echo "<div class='alert alert-warning' role='alert'>";
                        // echo  $error;
                        // echo "</div> ";
                        echo notifyAlert($error, 'danger');
                    } ?>

                    <form method="post">
                        <img src="<?php echo IMG; ?>/logo.svg" width="100" height="100" alt="Logo">
                        <div class="signin-intro">
                            <h1 id="greeting-msg" class="heading">Take-it</h1>
                            <span id="signin-reg-msg" tabindex="-1" class="sub-heading">Accedi o <a href="register.php" id="create-account-link">crea un account</a>
                            </span>
                        </div>

                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                            <label for="password">Password</label>
                        </div>

                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="seller" name="seller"> Sei un venditore?
                            </label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit" name="btn-login"">Sign in</button>
                        <p class="mt-5 mb-3 text-muted">© 2022–2023</p>
                    </form>

                </main>
            </div>
        </div>
        <div class="col-sm">
        </div>
    </div>
</div>