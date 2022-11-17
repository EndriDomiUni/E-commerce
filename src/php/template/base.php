<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-commerce</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>
  <main>
    <nav class="navbar navbar-expand-lg bg-light" id="navbar-main">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="toogle-hamburger">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- start menu left -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- start home -->
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-house-door-fill nav-icon-item" viewBox="0 0 16 16">
                  <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
                </svg>
                <div class="nav-caption-item">
                  <p>Home</p>
                </div>
              </a>
            </li>
            <!-- end home -->
  
          <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-inbox-fill nav-icon-item" viewBox="0 0 16 16">
                <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z" />
              </svg>
              <div class="nav-caption-item">
                <p>Inbox</p>
              </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end ">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="btn-dark-mode" onclick="checkForDarkMode(event)">
                    <label class="form-check-label" for="btn-dark-mode">Dark Mode</label>
                  </div>
                </a>
              </li>
              </ul>
            </li>
  

        </ul>
          <!-- end menu left -->

          <!-- start search -->
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <!-- end search -->

          <!-- menu right start -->
          <ul class="navbar-nav flex-row flex-wrap ms-md-auto justify-content-between" id="btn-toogle-navbar">

            <!-- start carrello -->
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart-fill nav-icon-item" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div class="nav-caption-item">
                  <p>Carrello</p>
                </div>
              </a>
            </li>
            <!-- end carrello -->

            <!-- start user -->
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle nav-icon-item" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <div class="nav-caption-item">
                  <p>User</p>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end ">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" id="btn-dark-mode" onclick="checkForDarkMode(event)">
                      <label class="form-check-label" for="btn-dark-mode">Dark Mode</label>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- end user -->
          </ul>
          <!-- menu right end -->

        </div>
      </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="../assets/js/base.js"></script>
  </main>
  <!-- Footer START -->
	<footer class="bg-light pt-5">
		<div class="container">
			<!-- Row START -->
			<div class="row g-4">

				<!-- Widget 1 START 
				<div class="col-lg-3">
					 #logo -> this is a comment
					<a href="index.html">

          </a>
					<p class="my-3 text-muted">Departure defective arranging rapturous did believe him all had supported.</p>
					<p class="mb-2"><a href="#" class="text-muted text-primary-hover"><i class="bi bi-telephone me-2"></i>+1234 568 963</a> </p>
					<p class="mb-0"><a href="#" class="text-muted text-primary-hover"><i class="bi bi-envelope me-2"></i>example@gmail.com</a></p>
				</div>
				 Widget 1 END -->

				<!-- Widget 2 START -->
				<div class="col-lg-8 ms-auto">
					<div class="row g-4">
						<!-- Link block -->
						<div class="col-6 col-md-3">
							<h5 class="mb-2 mb-md-4">Page</h5>
							<ul class="nav flex-column text-primary-hover">
								<li class="nav-item"><a class="nav-link nav-footer-link" fill="" href="#">About us</a></li>
								<li class="nav-item"><a class="nav-link nav-footer-link" href="#">Contact us</a></li>
								<li class="nav-item"><a class="nav-link nav-footer-link" href="#">News and Blog</a></li>
								<li class="nav-item"><a class="nav-link tnav-footer-link" href="#">Meet a Team</a></li>
							</ul>
						</div>

						<!-- Link block -->
						<div class="col-6 col-md-3">
							<h5 class="text-white mb-2 mb-md-4">Link</h5>
							<ul class="nav flex-column text-primary-hover">
								<li class="nav-item"><a class="nav-link nav-footer-link" href="signup-view.php">Sign up</a></li>
								<li class="nav-item"><a class="nav-link nav-footer-link" href="login-view.php">Sign in</a></li>
								<li class="nav-item"><a class="nav-link nav-footer-link" href="#">Privacy Policy</a></li>
								<li class="nav-item"><a class="nav-link nav-footer-link" href="#">Terms</a></li>
								<li class="nav-item"><a class="nav-link nav-footer-link" href="#">Cookie</a></li>
								<li class="nav-item"><a class="nav-link nav-footer-link" href="#">Support</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Widget 2 END -->

			</div><!-- Row END -->

			<!-- Tops Links 
			<div class="row mt-5">
				<h5 class="mb-2 text-white">Top Links</h5>
				<ul class="list-inline text-primary-hover lh-lg">
					<li class="list-inline-item"><a href="#" class="text-muted">Flights</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Hotels</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Tours</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Cabs</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">About</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Contact us</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Blogs</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Services</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Detail page</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Services</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Policy</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Testimonials</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Newsletters</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Podcasts</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Protests</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">NewsCyber</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Education</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Sports</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Tech and Auto</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Opinion</a></li>
					<li class="list-inline-item"><a href="#" class="text-muted">Share Market</a></li>
				</ul>
			</div>
      -->
			<!-- Payment and card -->
			<div class="row g-4 justify-content-between mt-0 mt-md-2">

				<!-- Payment card 
				<div class="col-sm-7 col-md-6 col-lg-4">
					<h5 class="text-white mb-2">Payment & Security</h5>
					<ul class="list-inline mb-0 mt-3">
						<li class="list-inline-item"> <a href="#"><img src="../assets/images/element/paypal.svg" class="h-30px" alt=""></a></li>
						<li class="list-inline-item"> <a href="#"><img src="../assets/images/element/visa.svg" class="h-30px" alt=""></a></li>
						<li class="list-inline-item"> <a href="#"><img src="../assets/images/element/mastercard.svg" class="h-30px" alt=""></a></li>
						<li class="list-inline-item"> <a href="#"><img src="../assets/images/element/expresscard.svg" class="h-30px" alt=""></a></li>
					</ul>
				</div>
        -->
				<!-- Social media icon 
				<div class="col-sm-5 col-md-6 col-lg-3 text-sm-end">
					<h5 class="text-white mb-2">Follow us on</h5>
					<ul class="list-inline mb-0 mt-3">
						<li class="list-inline-item"> <a class="btn btn-sm px-2 bg-facebook mb-0" href="#"><i class="fab fa-fw fa-facebook-f"></i></a> </li>
						<li class="list-inline-item"> <a class="btn btn-sm shadow px-2 bg-instagram mb-0" href="#"><i class="fab fa-fw fa-instagram"></i></a> </li>
						<li class="list-inline-item"> <a class="btn btn-sm shadow px-2 bg-twitter mb-0" href="#"><i class="fab fa-fw fa-twitter"></i></a> </li>
						<li class="list-inline-item"> <a class="btn btn-sm shadow px-2 bg-linkedin mb-0" href="#"><i class="fab fa-fw fa-linkedin-in"></i></a> </li>
					</ul>
				</div>
			</div>
      -->

			<!-- Divider -->
			<hr class="mt-4 mb-0">

			<!-- Bottom footer -->
			<div class="row">
				<div class="container">
					<div class="d-lg-flex justify-content-between align-items-center py-3 text-center text-lg-start">
						<!-- copyright text -->
						<div class="text-muted text-primary-hover"> Copyrights <a href="#" class="text-muted">©2022 Take-it</a>. All rights reserved. </div>
						<!-- copyright links-->
						<div class="nav mt-2 mt-lg-0">
							<ul class="list-inline text-primary-hover mx-auto mb-0">
								<li class="list-inline-item me-0"><a class="nav-link py-1 nav-footer-link" href="#">Privacy policy</a></li>
								<li class="list-inline-item me-0"><a class="nav-link py-1 nav-footer-link" href="#">Terms and conditions</a></li>
								<li class="list-inline-item me-0"><a class="nav-link py-1 nav-footer-link pe-0" href="#">Refund policy</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- =======================
Footer END -->

	<!-- Back to top -->
</body>

</html>