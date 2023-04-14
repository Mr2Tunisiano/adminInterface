<?php
include_once('assets/php/db_connect.php');
$req2 = 'Select * from utilisateur';
$send2 = @mysqli_query($connect, $req2);
while ($row = mysqli_fetch_array($send2)) {
  $count = $row['id_uti'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ajouter un utilisateur - LoungeWhiz</title>
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
      <h1>Ajouter Un Nouveau Utilisateur</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_index.php">Tableau de bord</a></li>
          <li class="breadcrumb-item">Utilisateurs</li>
          <li class="breadcrumb-item active">Ajout</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-2"> </div>
        <div class="col-lg-8 pt-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter Un Utilisateur</h5>
              <div class="row">
                <div class="col-lg-12">
                  <?php
                  if (isset($_SESSION['Success'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="bi bi-check-circle me-1"></i>
                      L'utilisateur <?php echo ($_SESSION['Success']) ?> a été crée avec succès !
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php unset($_SESSION['Success']);
                  } ?>
                  <form class="row g-3" method="post" action="assets/php/adduser1.php">
                    <div class="col-md-3">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingName" placeholder="Id d'utilisateur" value="<?php echo $count + 1 ?>" readonly name="id">
                        <label for="floatingName">Id d'utilisateur</label>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingEmail" placeholder="Nom d'utilisateur" name="nom">
                        <label for="floatingEmail">Nom d'utilisateur</label>
                      </div>
                    </div>
                    <div class="col-md-6 pt-3">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Mot de passe" name="mdp">
                        <label for="floatingPassword">Mot de passe</label>
                      </div>
                    </div>
                    <div class="col-md-6 pt-3">
                      <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="State" name='fonc'>
                          <option selected value="0">Staff</option>
                          <option value="1">Admin</option>
                        </select>
                        <label for="floatingSelect">Fonctionnalité</label>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Enregistrer</button>
                      <button type="reset" class="btn btn-secondary">Annuler</button>
                    </div>
                  </form><!-- End floating Labels Form -->
                </div>
              </div>
            </div>
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