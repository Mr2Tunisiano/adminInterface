<?php 
include_once('assets/php/db_connect.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style1.css" rel="stylesheet">
</head>
<body>
    <!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <img src="assets/img/logo.png" alt="">
  </div><!-- End Logo -->
  <div class="d-flex align-items-center justify-content-between" style="margin-left: 100px">
    <button type="button" class="btn btn-info">Voir les commandes ouvertes</button>
  </div>
  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $res['nom'] ?></span>
        </a><!-- End Profile Iamge Icon -->
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $res['nom'] ?></h6>
            <span><?php echo $res['nom'] ?></span> <!--change to profile position -->
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="assets/php/disconnect.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Déconnectez-vous</span>
            </a>
          </li>
        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->
    </ul>
  </nav><!-- End Icons Navigation -->
</header><!-- End Header -->

<main id="main" class="main">
<section class="section">
<div class="row" style="margin-right: 0px;">
<!-- Start Products Side -->
  <div class="col-lg-8">
    <div class="col-lg-12">
      <!-- Start Categorie Pills -->
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
        </li>
      </ul>
      <!-- End Categorie pills -->
    </div>
    <div class="col-lg-12">
      <div class="tab-content pt-2" id="myTabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
          <!-- The Row that hold the products -->
          <div class="row">
            <div class="col-lg-3">
              <div class="card">
                <img src="assets/img/card.jpg" class="card-img-top" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Card with an image overlay</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card">
                <img src="assets/img/card.jpg" class="card-img-top" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Card with an image overlay</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card">
                <img src="assets/img/card.jpg" class="card-img-top" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Card with an image overlay</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card">
                <img src="assets/img/card.jpg" class="card-img-top" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Card with an image overlay</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card">
                <img src="assets/img/card.jpg" class="card-img-top" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Card with an image overlay</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
              </div>
            </div>
          </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">
          
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="contact-tab">
          
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end products Side -->

<!-- Start Ticket Side -->
  <div class="col-lg-4">
    <div class="card" style="height: 90vh">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">Nom de produit</div>
          <div class="col-lg-2">Prix</div>
          <div class="col-lg-3">Quantité</div>
          <div class="col-lg-1"></div>
        </div>
      </div>
      <div class="card-body">
        <div id="scroll">
          <!-- Start command line -->
          <div class="row pt-3">
            <div class="col-lg-6">Nom de produit</div>
            <div class="col-lg-2">Prix</div>
            <div class="col-lg-3">              
              <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="height: 30px;">
                <button type="button" class="btn btn-danger">-</button>
                <button type="button" class="btn">10</button>
                <button type="button" class="btn btn-success">+</button>
              </div>
            </div>
            <div class="col-lg-1"><i class="ri-delete-bin-2-fill" style='color: red;font-size:x-large;'></i></div>
          </div>
          <!-- End command line -->
        </div>
      </div>
      <div class="card-footer">
          <div class="d-grid gap-2 mt-3">
          <h2>Total : 100Dt</h2>
        </div>
        <div class="d-grid gap-2 mt-3">
          <button class="btn btn-success" type="button"><i class="bi bi-cart-plus"></i>   Commander</button>
        </div>
        <div class="d-grid gap-2 mt-3">
          <button class="btn btn-primary" type="button"><i class="bi bi-cash-stack"></i>     Payer</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Ticket Side -->
</div>
</section>
</main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>