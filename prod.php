<?php
include_once('assets/php/db_connect.php');
include('assets/php/search.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Produits - LoungeWhiz</title>
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
      <h1>Produits</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_index.php">Tableau de bord</a></li>
          <li class="breadcrumb-item">Produits</li>
          <li class="breadcrumb-item active">Voir Les Produits</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 pt-5">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-3">
                  <h5 class="card-title">Vos Produits</h5>
                </div>
                <div class="col-lg-9 pt-3">
                  <form class="form-control" style="border: none;" method="post" action="assets/php/search.php">
                    <div class="row">
                      <div class="col-lg-3">
                        <button type="button" class="btn btn-outline-primary" style="display: flex; align-items: center;">
                          <span class="ri-filter-2-fill" style="margin-right: 5px;"></span> Recherche Avancée
                        </button>
                      </div>
                      <div class="col-lg-6">
                        <input class="form-control" type="text" placeholder="Cherche par Nom" aria-label="Search" name="crit" required>
                      </div>
                      <div class="col-lg-3">
                        <button class="btn btn-outline-primary" type="submit" name="search">Rechercher</button>
                      </div>
                    </div>

                  </form>
                </div>
                <div class="col-lg-12 pt-5">
                  <!-- Delete Sucess Messages -->
                  <?php
                  if (isset($_SESSION['delS'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="bi bi-check-circle me-1"></i>
                      La Produit <?php echo ($_SESSION['delS']) ?> a été supprimée avec succès !
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php unset($_SESSION['delS']);
                  }
                  ?>
                  <!-- Found result for normal search -->
                  <?php
                  if (isset($_SESSION['found'])) { ?>
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                      <i class="bi bi-check-circle me-1"></i>
                      montrant les résultats pour : <?php echo $_SESSION['found'] ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php } ?>
                  <!-- Didnt Find result for normal search -->
                  <?php
                  if (isset($_SESSION['notfound'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      Trouvé aucune correspondance du mot-clé <b>'<?php echo $_SESSION['notfound'] ?>'</b>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php unset($_SESSION['notfound']);
                  }
                  ?>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Nom Produit</th>
                        <th scope="col">Nom Catégorie</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Description</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($_SESSION['found'])) {
                        $crit = $_SESSION['found'];
                        $req02 = "select * from produit where nom_p='$crit'";
                        $query = @mysqli_query($connect, $req02);
                        while ($res22 = @mysqli_fetch_array($query)) { ?>
                          <tr>
                            <th scope="row"><?php echo $res22['id_p'] ?></th>
                            <td><?php echo $res22['nom_p'] ?></td>
                            <td><?php echo $res22['nom_cat'] ?></td>
                            <td><?php echo $res22['prix'] ?></td>
                            <td><?php echo $res22['desc'] ?></td>
                            <td><a href="assets/php/delprod.php?id=<?php echo $res22['id_p'] ?>" style="color: red; font-weight: bold;" onclick="if(confirm('Vous êtes sûr vous voulez effacer ce produit ?')){return true} else {event.preventDefault()}"><i class="bi bi-trash"></i>Supprimer</a></td>
                          </tr>
                        <?php }
                        unset($_SESSION['found']);
                      } else { ?>
                        <?php
                        $req2 = 'select * from produit';
                        $send2 = @mysqli_query($connect, $req2);
                        while ($res2 = @mysqli_fetch_array($send2)) {
                        ?>
                          <tr>
                            <th scope="row"><?php echo $res2['id_p'] ?></th>
                            <td><?php echo $res2['nom_p'] ?></td>
                            <td><?php echo $res2['nom_cat'] ?></td>
                            <td><?php echo $res2['prix'] ?></td>
                            <td><?php echo $res2['desc'] ?></td>
                            <td><a href="assets/php/delprod.php?id=<?php echo $res2['id_p'] ?>" style="color: red; font-weight: bold;" onclick="if(confirm('Vous êtes sûr vous voulez effacer ce produit ?')){return true} else {event.preventDefault()}"><i class="bi bi-trash"></i>Supprimer</a></td>
                          </tr>
                        <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2"></div>
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