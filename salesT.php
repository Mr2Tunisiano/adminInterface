<?php
include_once('assets/php/db_connect.php');
function getMonthName($monthNum)
{
  $monthNames = array(
    1 => "Janvier",
    2 => "Fevrier",
    3 => "Mars",
    4 => "Avril",
    5 => "Mai",
    6 => "Juin",
    7 => "Juillet",
    8 => "Aout",
    9 => "Septembre",
    10 => "Octobre",
    11 => "Novembre",
    12 => "Decembre"
  );

  if (isset($monthNames[$monthNum])) {
    return $monthNames[$monthNum];
  } else {
    return "Invalid month number";
  }
}
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
              <h5 class="card-title">Vos Produits</h5>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Année</th>
                        <th scope="col">Mois</th>
                        <th scope="col">Vente</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sales = array();
                      $req01 = "SELECT MONTH(c.date_c) AS month, YEAR(c.date_c) AS year, SUM(p.prix * pc.qte) AS revenue FROM produit_commande pc INNER JOIN produit p ON pc.id_p = p.id_p INNER JOIN commandes c ON pc.id_c = c.id_c GROUP BY YEAR(c.date_c), MONTH(c.date_c)";
                      $query01 = @mysqli_query($connect, $req01);
                      while ($res01 = @mysqli_fetch_assoc($query01)) {
                        $year = $res01['year'];
                        $sales[] = $res01['revenue'];
                      ?>
                        <tr>
                          <th scope="row"><?php echo $res01['year'] ?></th>
                          <td><?php echo getMonthName($res01['month']) ?></td>
                          <td><?php echo $res01['revenue'] . " Dt"?></td>
                        </tr>
                      <?php }
                      $JsonSale = json_encode($sales);
                      ?>
                    </tbody>
                  </table>
                </div>
                <script>
                  var data = <?php echo $JsonSale ?>
                </script>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Ventes de <?php echo $year ?></h5>

                      <!-- Line Chart -->
                      <div id="lineChart"></div>

                      <script>
                        let nums1 = data.map((num) => parseInt(num));
                        document.addEventListener("DOMContentLoaded", () => {
                          new ApexCharts(document.querySelector("#lineChart"), {
                            series: [{
                              name: "Ventes En Dinars",
                              data: nums1
                            }],
                            chart: {
                              height: 350,
                              type: 'line',
                              zoom: {
                                enabled: false
                              }
                            },
                            dataLabels: {
                              enabled: false
                            },
                            stroke: {
                              curve: 'straight'
                            },
                            grid: {
                              row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                              },
                            },
                            xaxis: {
                              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                            }
                          }).render();
                        });
                      </script>
                      <!-- End Line Chart -->

                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Mois</th>
                        <th scope="col">Jour</th>
                        <th scope="col">Vente</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $day = array();
                      $ventes = array();
                      $req02 = "SELECT MONTH(date_c) AS month, DAY(date_c) AS day, SUM(prix*qte) AS total_sales FROM commandes INNER JOIN produit_commande ON commandes.id_c = produit_commande.id_c INNER JOIN produit ON produit_commande.id_p = produit.id_p WHERE MONTH(date_c) = MONTH(CURRENT_DATE()) AND YEAR(date_c) = YEAR(CURRENT_DATE()) GROUP BY DAY(date_c) ORDER BY DAY(date_c) ASC";
                      $query02 = @mysqli_query($connect, $req02);
                      while ($res02 = @mysqli_fetch_assoc($query02)) {
                        $day[] = $res02['day'];
                        $ventes[] = $res02['total_sales'];
                        $month = getMonthName($res02['month']);
                      ?>
                        <tr>
                          <th scope="row"><?php echo getMonthName($res02['month']) ?></th>
                          <td><?php echo $res02['day'] ?></td>
                          <td><?php echo $res02['total_sales'] . " Dt" ?></td>
                        </tr>
                      <?php }
                      $sendDay = json_encode($day);
                      $sendVentes = json_encode($ventes);
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Ventes de <?php echo $month ?></h5>
                      <script>
                        var day = <?php echo $sendDay ?>
                      </script>
                      <script>
                        var ventes = <?php echo $sendVentes ?>
                      </script>
                      <!-- Line Chart -->
                      <div id="HelloPuta"></div>

                      <script>
                        let day1 = day.map((el) => parseInt(el))
                        let ventes1 = ventes.map((el) => parseInt(el))
                        document.addEventListener("DOMContentLoaded", () => {
                          new ApexCharts(document.querySelector("#HelloPuta"), {
                            series: [{
                              name: "Ventes en Dinars",
                              data: ventes1
                            }],
                            chart: {
                              height: 350,
                              type: 'line',
                              zoom: {
                                enabled: false
                              }
                            },
                            dataLabels: {
                              enabled: false
                            },
                            stroke: {
                              curve: 'straight'
                            },
                            grid: {
                              row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                              },
                            },
                            xaxis: {
                              categories: day1,
                            }
                          }).render();
                        });
                      </script>
                      <!-- End Line Chart -->
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