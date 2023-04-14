<?php
include_once('assets/php/db_connect.php');
$req2 = 'Select * from commandes';
$send2 = @mysqli_query($connect, $req2);
while ($row = mysqli_fetch_array($send2)) {
  $count = $row['id_c'];
}
if (!is_numeric($count)) {
  $count = 0;
};
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
      <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#opentables">Voir les commandes ouvertes</button>
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
              <h6 id="user"><?php echo $res['nom'] ?></h6>
              <span>
                <?php
                if ($res['isAdmin'] == 0) {
                  echo "Serveur";
                } else {
                  echo "Admin";
                };
                ?>
              </span> <!--change to profile position -->
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
            <?php
            if (isset($_SESSION['CommandS'])) { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Le Commande Numéro <?php echo $_SESSION['CommandS'] ?> a été enregistée avec succée !
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php }
            unset($_SESSION['CommandS']);
            ?>
            <?php
            if (isset($_SESSION['payS'])) { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Le Commande Numéro <?php echo $_SESSION['payS'] ?> a été facturer avec success !
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php }
            unset($_SESSION['payS']);
            ?>
            <?php
            if (isset($_SESSION['CommandePay'])) { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Le Commande Numéro <?php echo $_SESSION['CommandePay'] ?> a été enregistrée et facturer avec succee !
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php }
            unset($_SESSION['CommandePay']);
            ?>
            <!-- Start Categorie Pills -->
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Tous</button>
              </li>
              <?php
              $req01 = "SELECT * FROM `categorie`";
              $envoi01 = @mysqli_query($connect, $req01);
              while ($res01 = @mysqli_fetch_array($envoi01)) { ?>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#<?php echo $res01['nom_cat'] ?>" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo $res01['nom_cat'] ?></button>
                </li>
              <?php } ?>
            </ul>
            <!-- End Categorie pills -->
          </div>
          <div class="col-lg-12">
            <div class="tab-content pt-2" id="myTabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
                <!-- The Row that hold the products -->
                <div class="row">
                  <?php
                  $req02 = "SELECT * FROM `produit`";
                  $envoi02 = @mysqli_query($connect, $req02);
                  while ($res02 = @mysqli_fetch_array($envoi02)) { ?>
                    <div class="col-lg-3">
                      <div class="card" style="width: 235px; height: 200px;">
                        <img src="<?php if (!($res02['photo'] == "")) {
                                    echo "assets/img/products/" . $res02['photo'];
                                  } else {
                                    echo "assets/img/card.jpg";
                                  } ?>" class="card-img-top" alt="..." style="width: 235px; height: 200px;">
                        <div class="card-img-overlay">
                          <h5 class="card-title"><?php echo $res02['nom_p'] ?></h5>
                          <p class="card-text"><b><?php echo $res02['prix'] ?> Dt.</b></p>
                          <a class="btn btn-primary ziid" href="addticket.php?id=<?php echo $res02['id_p'] ?>" id-prod="<?php echo $res02['id_p'] ?>" onclick="addToCart(event)">Commander</a>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <?php
              $req03 = "SELECT * FROM `categorie`";
              $envoi03 = @mysqli_query($connect, $req03);
              while ($res03 = @mysqli_fetch_array($envoi03)) { ?>
                <div class="tab-pane fade" id="<?php echo $res03['nom_cat'] ?>" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row">
                    <?php
                    $temp = $res03['nom_cat'];
                    $req04 = "SELECT * FROM `produit` WHERE `nom_cat` ='$temp'";
                    $envoi04 = @mysqli_query($connect, $req04);
                    while ($res04 = @mysqli_fetch_array($envoi04)) { ?>
                      <div class="col-lg-3">
                        <div class="card" style="width: 235px; height: 200px;">
                          <img src="<?php if (!($res04['photo'] == "")) {
                                      echo "assets/img/products/" . $res04['photo'];
                                    } else {
                                      echo "assets/img/card.jpg";
                                    } ?>" class="card-img-top" alt="..." style="width: 235px; height: 200px;">
                          <div class="card-img-overlay">
                            <h5 class="card-title"><?php echo $res04['nom_p'] ?> </h5>
                            <p class="card-text"><b><?php echo $res04['prix'] ?> Dt.</b></p>
                            <a class="btn btn-primary ziid" href="addticket.php?id=<?php echo $res04['id_p'] ?>" id-prod="<?php echo $res04['id_p'] ?>" onclick="addToCart(event)">Ajout</a>
                          </div>
                        </div>
                      </div>
                    <?php unset($temp);
                    } ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- end products Side -->

        <!-- Start Ticket Side -->
        <div class="col-lg-4">
          <div class="card" style="height: 90vh">
            <div class="card-header">
              <div class="row">
                <div class="col-lg-5">Nom de produit</div>
                <div class="col-lg-2">Prix</div>
                <div class="col-lg-3">Quantité</div>
                <div class="col-lg-1"></div>
              </div>
            </div>
            <div class="card-body">
              <div id="scrolls">
                <div class="col-lg-12 pt-3">
                  <h4>Commande Numéro : <span id="count"><?php echo $count + 1 ?></span></h4>
                </div>
                <!-- Start command line -->
                <!-- End command line -->
              </div>
              <div class="card-footer">
                <div class="d-grid gap-2 mt-3">
                  <h2>Total : <span id="total"></span> Dt</h2>
                </div>
                <div class="d-grid gap-2 mt-3">
                  <a class="btn btn-primary" type="button" onclick="Commander(event)"><i class="bi bi-cart-plus"></i> Commander</a>
                </div>
                <div class="d-grid gap-2 mt-3">
                  <a class="btn btn-success" type="button" onclick="CommanderPayer(event)"><i class="bi bi-cash-stack"></i> Payer</a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Ticket Side -->
        </div>
    </section>
  </main>
  <div class="modal fade" id="opentables" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Les Commandes Ouvertes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <?php
            $req11 = "SELECT * FROM `commandes` WHERE `isPaid` = 0;";
            $query11 = @mysqli_query($connect, $req11);
            $nom = $res['nom'];
            $req22 = "SELECT * FROM `commandes` WHERE `isPaid` = 0 AND `serveur` = '$nom'";
            $query22 = @mysqli_query($connect, $req22);
            if ($res['isAdmin'] == 1) {
              while ($res11 = @mysqli_fetch_array($query11)) { ?>
                <div class="col-lg-3">
                  <div class="card">
                    <img src="assets/img/table3.jpg" class="card-img-top" alt="..." height="210" width="220">
                    <div class="card-img-overlay">
                      <h5 class="card-title">Commande Numéro: <?php echo $res11['id_c'] ?></h5>
                      <p class="card-text">Total : <?php echo $res11['total'] ?></p>
                      <p class="card-text">Serveur : <?php echo $res11['serveur'] ?></p>
                      <a type="button" class="btn btn-success" id-c="<?php echo $res11['id_c'] ?>" onclick="Payer(event)"><i class="bi bi-cash-stack"></i> Payer</a>
                    </div>
                  </div>
                </div>
              <?php };
            } else {
              while ($res22 = @mysqli_fetch_array($query22)) { ?>
                <div class="col-lg-3">
                  <div class="card">
                    <img src="assets/img/table3.jpg" class="card-img-top" alt="..." height="210" width="220">
                    <div class="card-img-overlay">
                      <h5 class="card-title">Commande Numéro: <?php echo $res22['id_c'] ?></h5>
                      <p class="card-text">Total : <?php echo $res22['total'] ?></p>
                      <p class="card-text">Serveur : <?php echo $res22['serveur'] ?></p>
                      <a type="button" class="btn btn-success" id-c="<?php echo $res22['id_c'] ?>" onclick="Payer(event)"><i class="bi bi-cash-stack"></i> Payer</a>
                    </div>
                  </div>
                </div>
            <?php };
            } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

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
  <script src="assets/js/ajaxwork.js"></script>

</body>

</html>