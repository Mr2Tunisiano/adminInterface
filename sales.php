<?php
include_once('assets/php/db_connect.php');
$req01 = "SELECT * FROM `commandes` ORDER BY `date_c` DESC";
$query01 = @mysqli_query($connect, $req01);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ventes - LoungeWhiz</title>
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
</head>

<body>
  <?php
  include('assets/php/header.php');
  include('assets/php/side.php');
  ?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Ventes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_index.php">Home</a></li>
          <li class="breadcrumb-item">Ventes</li>
          <li class="breadcrumb-item active">Voir tous les ventes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ventes</h5>
              <?php
              if (isset($_SESSION['deleted'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="bi bi-check-circle me-1"></i>
                  La Commande Numéro <?php echo ($_SESSION['deleted']) ?> a été annulé avec succès !
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }
              unset($_SESSION['deleted'])
              ?>
              <form class="form-control" style="border: none;" method="post" action="assets/php/search3.php">
                <div class="row">
                  <div class="col-lg-4" style="margin: 0; padding: 0;">
                    <input class="form-control" type="date" name="crit" required>
                  </div>
                  <div class="col-lg-3" style="margin: 0; padding: 0;">
                    <button class="btn btn-outline-primary" type="submit" name="search">Chercher Par Date</button>
                  </div>
                </div>
              </form>
              <table class="table table-striped mt-5">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Serveur</th>
                    <th scope="col">Total</th>
                    <th scope="col">Payé</th>
                    <th scope="col">Date</th>
                    <th scope="col">action</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <?php
                if (isset($_SESSION['found'])) {
                  if ($_SESSION['found']) { 
                    $date = $_SESSION['found'];
                    $req07 = "SELECT * FROM commandes WHERE DATE(date_c) = DATE('$date')";
                    $send07 = @mysqli_query($connect,$req07);
                    ?>
                    <tbody>
                      <?php
                      while ($res07 = @mysqli_fetch_array($send07)) { ?>
                        <tr>
                          <th scope="row"><?php echo $res07['id_c'] ?></th>
                          <td><?php echo $res07['serveur'] ?></td>
                          <td><?php echo $res07['total'] . "Dt" ?></td>
                          <td><?php echo $res07['isPaid'] ?></td>
                          <td><?php echo $res07['date_c'] ?></td>
                          <td><button class="btn btn-primary sm" data-bs-toggle="modal" data-bs-target="#commande<?php echo $res01['id_c'] ?>">Voir détail</button></td>
                          <td><a href='./assets/php/annuler.php?id_c=<?php echo $res07['id_c'] ?>' onclick="if(confirm('Vous êtes sûr vous voulez annuler cette commande ?')){return true} else {event.preventDefault()}" class=" btn btn-danger sm">Annuler</a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  <?php unset($_SESSION['found']); } else { ?>
                    <tbody>
                      <tr>
                        <th scope="row" class="table-danger" colspan="7">Aucune Commande enregistrée à cette date</th>
                      </tr>
                    </tbody>
                  <?php unset($_SESSION['found']); }
                } else { ?>
                  <tbody>
                    <?php
                    while ($res01 = @mysqli_fetch_array($query01)) { ?>
                      <tr>
                        <th scope="row"><?php echo $res01['id_c'] ?></th>
                        <td><?php echo $res01['serveur'] ?></td>
                        <td><?php echo $res01['total'] . "Dt" ?></td>
                        <td><?php echo $res01['isPaid'] ?></td>
                        <td><?php echo $res01['date_c'] ?></td>
                        <td><button class="btn btn-primary sm" data-bs-toggle="modal" data-bs-target="#commande<?php echo $res01['id_c'] ?>">Voir détail</button></td>
                        <td><a href='./assets/php/annuler.php?id_c=<?php echo $res01['id_c'] ?>' onclick="if(confirm('Vous êtes sûr vous voulez annuler cette commande ?')){return true} else {event.preventDefault()}" class=" btn btn-danger sm">Annuler</a></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                <?php }
                ?>
              </table>
            </div>
          </div>
          <?php
          $req04 = "SELECT * FROM `commandes`";
          $query04 = @mysqli_query($connect, $req04);
          while ($res04 = @mysqli_fetch_array($query04)) { ?>
            <div class="modal fade" id="commande<?php echo $res04['id_c'] ?>" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Détail Commande <?php echo $res04['id_c'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Id P</th>
                          <th scope="col">Nom</th>
                          <th scope="col">Prix</th>
                          <th scope="col">Qte</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $commande = $res04['id_c'];
                        $req02 = "SELECT * FROM `produit_commande` WHERE `id_c` ='$commande'";
                        $query02 = @mysqli_query($connect, $req02);
                        while ($res02 = @mysqli_fetch_array($query02)) { ?>
                          <tr>
                            <?php
                            $product = $res02['id_p'];
                            $req03 = "SELECT * FROM `produit` WHERE `id_p`= '$product'";
                            $query03 = @mysqli_query($connect, $req03);
                            while ($res03 = @mysqli_fetch_array($query03)) { ?>
                              <th scope="row"><?php echo $res03['id_p'] ?></th>
                              <td><?php echo $res03['nom_p'] ?></td>
                              <td><?php echo $res03['prix'] ?></td>
                              <td><?php echo $res02['qte'] ?></td>
                              <td><?php echo $res02['qte'] * $res03['prix'] ?></td>
                            <?php }
                            ?>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          <?php }
          ?>
        </div>
      </div>
      </div>
    </section>
  </main>

  <?php
  include('assets/php/footer.php');
  ?>
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