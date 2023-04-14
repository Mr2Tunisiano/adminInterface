<?php
include_once('assets/php/db_connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Utilisateurs - LoungeWhiz</title>
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
      <h1>Utilisateurs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_index.php">Tableau de bord</a></li>
          <li class="breadcrumb-item">Utilisateurs</li>
          <li class="breadcrumb-item active">Voir les utilisateurs</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 pt-5">
          <!-- return message for the user delete -->
          <?php
          if (isset($_SESSION['delS'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle me-1"></i>
              L'utilisateur "<?php echo ($_SESSION['delS']) ?>" a été supprimée avec succès !
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php unset($_SESSION['delS']);
          } ?>

          <!-- Return Message for the name change -->
          <?php
          if (isset($_SESSION['ChangeS'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle me-1"></i>
              Les Modifications sur l'utilisateur "<?php echo $_SESSION['ChangeS'] ?>" ont été bien enregistée !
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php unset($_SESSION['ChangeS']);
          } ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Les Utilisateurs</h5>
              <div class="row">
                <div class="col-lg-12 pt-5">
                  <!-- Table with stripped rows -->
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Nom Utilisateur</th>
                        <th scope="col">Mot de passe</th>
                        <th scope="col">Fonctionnalité</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $req2 = 'select * from utilisateur';
                      $send2 = @mysqli_query($connect, $req2);
                      while ($res2 = @mysqli_fetch_array($send2)) {
                      ?>
                        <tr>
                          <th scope="row"><?php echo $res2['id_uti'] ?></th>
                          <td><?php echo $res2['nom'] ?></td>
                          <td><?php echo $res2['mdp'] ?></td>
                          <td><?php
                              if ($res2['isAdmin'] == 1) {
                                echo 'Admin';
                              } else {
                                echo 'Staff';
                              }
                              ?></td>
                          <td><a href="" style="color: yellow; font-weight: bold;" class="mod" data-bs-toggle="modal" data-bs-target="#testmodal<?php echo $res2['id_uti'] ?>"><i class="ri-edit-box-line"></i>Modifier</a></td>
                          <div class="modal fade" id="testmodal<?php echo $res2['id_uti'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Changer les propriétés de l'utilisateur '<?php echo $res2['nom'] ?>'</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form method="post" action="assets/php/userupdate.php" class="row g-3">
                                    <div class="col-md-12">
                                      <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingName" placeholder="ID Catégorie" name="id" readonly value="<?php echo $res2['id_uti'] ?>">
                                        <label for="floatingName">ID Utilisateur</label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingName" placeholder="Ancien Nom" name="name" value="<?php echo $res2['nom'] ?>">
                                        <label for="floatingName">Nom Utilisateur</label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingName" placeholder="Mot de passe" name="mdp" value="<?php echo $res2['mdp'] ?>">
                                        <label for="floatingName">Mot de passe</label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="State" name="fonc">
                                          <?php
                                          if ($res2['isAdmin'] == 1) {
                                            echo '<option value="admin" selected>Admin</option>';
                                            echo '<option value="staff">Staff</option>';
                                          } else {
                                            echo '<option value="admin">Admin</option>';
                                            echo '<option value="staff" selected>Staff</option>';
                                          }
                                          ?>
                                        </select>
                                        <label for="floatingSelect">Fonctionnalité</label>
                                      </div>
                                    </div>
                                    <!-- End floating Labels Form -->
                                </div>
                                <div class="modal-footer">
                                  <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                  <button type="submit" name="sub" class="btn btn-primary">Enregistrer les changements</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <td><a href="assets/php/deluser.php?id=<?php echo $res2['id_uti']; ?>" style="color: red; font-weight: bold;" onclick="if(confirm('Vous êtes sûr vous voulez effacer cette utilisateur ?')){return true} else {event.preventDefault()}"><i class="bi bi-trash"></i>Supprimer</a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <!-- End Table with stripped rows -->
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