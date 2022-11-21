<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <title>Sign in</title>
</head>

<body style="background-color: hsla(0, 0%, 94%);">

  <?php include("../template/header.php"); ?>

  <div class="container my-5">
    <div class="card">
      <form>
        <!-- Card header -->
        <div class="card-header py-4 px-5 bg-light border-0">
          <h4 class="mb-0 fw-bold">Settings</h4>
        </div>

        <!-- Card body -->
        <div class="card-body px-5">
          <!-- Account section -->
          <div class="row gx-xl-5">
            <div class="col-md-4">
              <h5>Account</h5>
              <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam et ducimus velit, facere quaerat debitis modi asperiores aspernatur corrupti, sit aliquam.</p>
            </div>

            <div class="col-md-8">
              <div class="mb-3">
                <label for="exampleInput1" class="form-label">Full name</label>
                <input type="text" class="form-control" id="exampleInput1" style="max-width: 500px;" />
              </div>
              <div class="mb-3">
                <label for="exampleInput2" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInput2" style="max-width: 500px;" />
              </div>
              <div class="mb-3">
                <label for="exampleInput3" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="exampleInput3" style="max-width: 250px;" />
              </div>
            </div>
          </div>

          <hr class="my-5" />

          <!-- Billing section -->
          <div class="row gx-xl-5">
            <div class="col-md-4">
              <h5>Billing</h5>
              <p class="text-muted">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias fugiat cum nihil suscipit!</p>
            </div>

            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInput4" class="form-label">Plan</label>
                    <input type="text" class="form-control" id="exampleInput4" />
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="exampleInput5" class="form-label">Billing</label>
                  <select id="exampleInput5" class="form-select mb-3" aria-label="Default select example">
                    <option selected value="1">Monthly</option>
                    <option value="2">Annually</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <hr class="my-5" />

          <!-- Business address section -->
          <div class="row gx-xl-5">
            <div class="col-md-4">
              <h5>Business address</h5>
              <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis amet magnam voluptas voluptatum.</p>
            </div>

            <div class="col-md-8">
              <div class="mb-3">
                <label for="exampleInput6" class="form-label">Street address</label>
                <input type="text" class="form-control" id="exampleInput6" />
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInput7" class="form-label">City</label>
                    <input type="text" class="form-control" id="exampleInput7" />
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="exampleInput8" class="form-label">State</label>
                  <select id="exampleInput8" class="form-select mb-3" aria-label="Default select example">
                    <option selected value="1">California</option>
                    <option value="2">Texas</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInput9" class="form-label">Postal code</label>
                    <input type="text" class="form-control" id="exampleInput9" />
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="exampleInput10" class="form-label">Country</label>
                  <select id="exampleInput10" class="form-select mb-3" aria-label="Default select example">
                    <option selected value="1">USA</option>
                    <option value="2">Canada</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <hr class="my-5" />

          <!-- Password section -->
          <div class="row gx-xl-5">
            <div class="col-md-4">
              <h5>Change password</h5>
              <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, magnam.</p>
            </div>

            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInput11" class="form-label">Old password</label>
                    <input type="password" class="form-control" id="exampleInput11" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInput12" class="form-label">New password</label>
                    <input type="password" class="form-control" id="exampleInput12" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php include("../template/footer.php"); ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>