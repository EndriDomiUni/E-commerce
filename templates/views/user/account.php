
<div class="container mt-5">
    <h1 class="text-center">Account Details</h1>

    <!-- User Data Section -->
    <div class="card mt-5">
        <div class="card-header">
            <h3>User Data</h3>
        </div>
        <div class="card-body">
            <!-- User Data Content Here -->
            <div class="row">
                <div class="col-md-3">
                    <img src="https://via.placeholder.com/150x150" class="rounded-circle mb-3">
                </div>
                <div class="col-md-9">

                    <?php
                    if (isset($_SESSION[ID])) {
                        $session = new Session($_SESSION[ID]);
                        echo
                        '<h3 class="mb-3">' . $session->getCurrentUser()[NOME] . ' ' . $session->getCurrentUser()[COGNOME] . '</h3>
                            <p class="mb-0">Email: ' . $session->getCurrentUser()[EMAIL] . '</p>
                            <p class="mb-0">Type: ' . $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]). '</p>
                            <p class="mb-0">Phone: (123) 456-7890</p>
                        ';
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>

    <!-- User Data Section -->
    <div class="card mt-5">
        <div class="card-header">
            <h3>Change Password</h3>
        </div>
        <form>
            <div class="card-body">
                <!-- User Data Content Here -->
                <div class="form-group">
                    <label for="currentPassword">Password Corrente:</label>
                    <input type="password" class="form-control" id="currentPassword" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">Nuova Password:</label>
                    <input type="password" class="form-control" id="newPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirma Password:</label>
                    <input type="password" class="form-control" id="confirmPassword" required>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary ml-auto">Save Changes</button>
            </div>
        </form>
    </div>

    <!-- Domicile Data Section -->
    <div class="card mt-5">
        <div class="card-header">
            <h3>Domicile Data</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-globe-europe-africa" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM3.668 2.501l-.288.646a.847.847 0 0 0 1.479.815l.245-.368a.809.809 0 0 1 1.034-.275.809.809 0 0 0 .724 0l.261-.13a1 1 0 0 1 .775-.05l.984.34c.078.028.16.044.243.054.784.093.855.377.694.801-.155.41-.616.617-1.035.487l-.01-.003C8.274 4.663 7.748 4.5 6 4.5 4.8 4.5 3.5 5.62 3.5 7c0 1.96.826 2.166 1.696 2.382.46.115.935.233 1.304.618.449.467.393 1.181.339 1.877C6.755 12.96 6.674 14 8.5 14c1.75 0 3-3.5 3-4.5 0-.262.208-.468.444-.7.396-.392.87-.86.556-1.8-.097-.291-.396-.568-.641-.756-.174-.133-.207-.396-.052-.551a.333.333 0 0 1 .42-.042l1.085.724c.11.072.255.058.348-.035.15-.15.415-.083.489.117.16.43.445 1.05.849 1.357L15 8A7 7 0 1 1 3.668 2.501Z"/>
                        </svg>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter address">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter city">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" placeholder="Enter state">
                        </div>
                        <div class="form-group">
                            <label for="zip">Zip Code</label>
                            <input type="text" class="form-control" id="zip" placeholder="Enter zip code">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary ml-auto">Save Changes</button>
            </div>
        </form>
    </div>

    <!-- Banking Data Section -->
    <div class="card mt-5">
        <div class="card-header">
            <h3>Banking Data</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                            <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
                        </svg>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="card-number">Card Number</label>
                            <input type="text" class="form-control" id="card-number" placeholder="Enter card number">
                        </div>
                        <div class="form-group">
                            <label for="card-holder">Card Holder</label>
                            <input type="text" class="form-control" id="card-holder" placeholder="Enter card holder name">
                        </div>
                        <div class="form-group">
                            <label for="expiration-date">Expiration Date</label>
                            <input type="text" class="form-control" id="expiration-date" placeholder="MM/YY">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" placeholder="Enter CVV">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary ml-auto">Save Changes</button>
            </div>
        </form>
    </div>

    <!-- User Data Section -->
    <div class="card mt-5">
        <div class="card-header">
            <h3>Delete Account</h3>
        </div>
        <form>
            <div class="card-body">
                <p class="mb-0">Deleting your account is permanent and cannot be undone.</p>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-danger ml-auto">Delete Account</button>
            </div>
        </form>
    </div>

    </div>
</div>