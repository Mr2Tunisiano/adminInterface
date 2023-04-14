<?php
include_once('assets/php/db_connect.php');
$series = array();
$labels = array();
$req01 = "SELECT id_p, SUM(qte) as total_qte FROM `produit_commande` GROUP BY id_p ORDER BY total_qte DESC LIMIT 5";
$query01 = @mysqli_query($connect, $req01);
while ($res01 = @mysqli_fetch_assoc($query01)) {
  $series[] = $res01['total_qte'];
  $productId = $res01['id_p'];
  $req02 = "SELECT * FROM `produit` WHERE `id_p` = '$productId'";
  $query02 = @mysqli_query($connect, $req02);
  while ($res02 = @mysqli_fetch_assoc($query02)) {
    $labels[] = $res02['nom_p'];
  }
}
$JsonNums = json_encode($series);
$JsonNames = json_encode($labels);
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
  <script>
    var Nums = <?php echo $JsonNums ?>
  </script>
  <script>
    var Names = <?php echo $JsonNames ?>
  </script>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Ventes Par Produit</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_index.php">Home</a></li>
          <li class="breadcrumb-item">Ventes</li>
          <li class="breadcrumb-item active">Ventes Par Produit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ventes Par Produits</h5>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Id Prod</th>
                        <th scope="col">Nom Produit</th>
                        <th scope="col">Total Commande</th>
                        <th scope="col">Total Revenue</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $req03 = "SELECT id_p, SUM(qte) as total_qte FROM `produit_commande` GROUP BY id_p ORDER BY total_qte DESC";
                      $query03 = @mysqli_query($connect, $req03);
                      while ($res03 = @mysqli_fetch_assoc($query03)) {
                        $IdProd = $res03['id_p']; ?>
                        <tr>
                          <?php
                          $req04 = "SELECT * FROM `produit` WHERE `id_p` = '$IdProd'";
                          $query04 = @mysqli_query($connect, $req04);
                          while ($res04 = @mysqli_fetch_assoc($query04)) { ?>
                            <th scope="row"><?php echo $res04['id_p'] ?></th>
                            <td><?php echo $res04['nom_p'] ?></td>
                            <td><?php echo $res03['total_qte'] ?></td>
                            <td><?php echo $res03['total_qte'] * $res04['prix'] . " Dt"?></td>
                          <?php }
                          ?>
                        </tr>
                      <?php }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- Graph Part -->
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Donut Chart</h5>
                      <!-- Donut Chart -->
                      <div id="donutChart"></div>
                      <script>
                        let nums = Nums.map((el) => {
                          return parseInt(el)
                        })
                        document.addEventListener("DOMContentLoaded", () => {
                          new ApexCharts(document.querySelector("#donutChart"), {
                            series: nums,
                            chart: {
                              height: 350,
                              type: 'donut',
                              toolbar: {
                                show: true
                              }
                            },
                            labels: Names,
                          }).render();
                        });
                      </script>
                      <!-- End Donut Chart -->
                    </div>
                  </div>
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