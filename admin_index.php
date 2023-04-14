<?php
include_once('assets/php/db_connect.php');
$req01 = "SELECT COUNT(id_c) as count FROM commandes WHERE DATE(date_c) = CURDATE()";
$query01 = @mysqli_query($connect, $req01);
$res01 = @mysqli_fetch_assoc($query01);
$req02 = "SELECT SUM(`total`) as total FROM commandes WHERE DATE(date_c) = CURDATE()";
$query02 = @mysqli_query($connect, $req02);
$res02 = @mysqli_fetch_assoc($query02);
$req03 = "SELECT SUM(pc.qte) AS count FROM produit_commande pc, commandes c WHERE DATE(c.date_c) = CURDATE() AND pc.id_c = c.id_c";
$query03 = @mysqli_query($connect, $req03);
$res03 = @mysqli_fetch_assoc($query03);
$res04 = "SELECT * FROM `commandes` ORDER BY `date_c` DESC LIMIT 6";
$query04 = @mysqli_query($connect, $res04);
function formatTimeDifference($dateAndTime)
{
  $currentTime = time();
  $dateAndTimeObject = new DateTime($dateAndTime, new DateTimeZone('GMT+1'));
  $dateAndTimeTimestamp = $dateAndTimeObject->getTimestamp();
  $differenceInSeconds = $currentTime - $dateAndTimeTimestamp;

  if ($differenceInSeconds < 60) {
    return $differenceInSeconds . " seconds ago";
  } elseif ($differenceInSeconds < 3600) {
    $differenceInMinutes = round($differenceInSeconds / 60);
    return $differenceInMinutes . " minutes ago";
  } elseif ($differenceInSeconds < 86400) {
    $differenceInHours = round($differenceInSeconds / 3600);
    return $differenceInHours . " hours ago";
  } else {
    $differenceInDays = round($differenceInSeconds / 86400);
    return $differenceInDays . " days ago";
  }
}
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
};
$series = array();
$labels = array();
$req06 = "SELECT p.nom_cat, SUM(pc.qte) AS total_qte FROM produit_commande pc INNER JOIN produit p ON pc.id_p = p.Id_p GROUP BY p.nom_cat ORDER BY SUM(pc.qte) DESC";
$query06 = @mysqli_query($connect, $req06);
while ($res06 = @mysqli_fetch_assoc($query06)) {
  $series[] = $res06['total_qte'];
  $labels[] = $res06['nom_cat'];
}
$JsonNums = json_encode($series);
$JsonNames = json_encode($labels);
$req07 = "SELECT pc.id_p, SUM(pc.qte) as total_qte FROM produit_commande pc, commandes c WHERE DATE(c.date_c) = CURDATE() AND c.id_c = pc.id_c GROUP BY id_p ORDER BY total_qte DESC";
$query07 = @mysqli_query($connect, $req07);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tableau de bord - LoungeWhiz</title>
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
      <h1>Tableau de bord</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_index.php">Tableau de bord</a></li>
          <li class="breadcrumb-item active">Interface</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Produits Vendu </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $res03['count'] ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| Aujourd'hui</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $res02['total'] . " Dt" ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Clients <span>| Aujourd'hui</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $res01['count'] ?></h6>
                    </div>
                  </div>
                </div>
              </div>

            </div><!-- End Customers Card -->

            <div class="col-lg-12">
              <?php
              $day = array();
              $ventes = array();
              $req05 = "SELECT MONTH(date_c) AS month, DAY(date_c) AS day, SUM(prix*qte) AS total_sales FROM commandes INNER JOIN produit_commande ON commandes.id_c = produit_commande.id_c INNER JOIN produit ON produit_commande.id_p = produit.id_p WHERE MONTH(date_c) = MONTH(CURRENT_DATE()) AND YEAR(date_c) = YEAR(CURRENT_DATE()) GROUP BY DAY(date_c) ORDER BY DAY(date_c) ASC";
              $query05 = @mysqli_query($connect, $req05);
              while ($res05 = @mysqli_fetch_assoc($query05)) {
                $day[] = $res05['day'];
                $ventes[] = $res05['total_sales'];
                $month = getMonthName($res05['month']);
              }
              $sendDay = json_encode($day);
              $sendVentes = json_encode($ventes);
              ?>
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
                  <div id="sales"></div>

                  <script>
                    let day1 = day.map((el) => parseInt(el))
                    let ventes1 = ventes.map((el) => parseInt(el))
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#sales"), {
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
            <div class="col-lg-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Meilleur Vente <span>| Aujourd'hui</span></h5>

                  <table class="table table-borderless">
                    <thead>

                      <tr>
                        <th scope="col">Produit</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Qte</th>
                        <th scope="col">Revenue</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($res07 = @mysqli_fetch_assoc($query07)) { ?>
                        <tr>
                          <?php
                          $prod_id = $res07['id_p'];
                          $req08 = "SELECT * FROM produit WHERE id_p='$prod_id'";
                          $query08 = @mysqli_query($connect, $req08);
                          while ($res08 = @mysqli_fetch_assoc($query08)) { ?>
                            <td scope="row" style="color:blue"><b><?php echo $res08['nom_p'] ?></b></td>
                            <td><?php echo $res08['prix'] . " Dt" ?></td>
                            <td class="fw-bold"><?php echo $res07['total_qte'] ?></td>
                            <td><?php echo $res08['prix'] * $res07['total_qte'] . " Dt"  ?></td>
                          <?php } ?>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Left side columns -->
        <!-- Right side columns -->
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Derniére Transactions </h5>
                  <div class="activity">
                    <?php
                    while ($res04 = @mysqli_fetch_assoc($query04)) { ?>
                      <div class="activity-item d-flex">
                        <div class="activite-label"><?php echo formatTimeDifference($res04['date_c']) ?></div>
                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                        <div class="activity-content">
                          Commande : <?php echo $res04['id_c'] ?> <span>| Total : <?php echo $res04['total'] . "Dt" ?></span>
                        </div>
                      </div>
                    <?php }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <script>
                var Nums = <?php echo $JsonNums ?>
              </script>
              <script>
                var Names = <?php echo $JsonNames ?>
              </script>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Quantité vendu par categorie cette année</h5>

                  <!-- Pie Chart -->
                  <div id="pieChart"></div>

                  <script>
                    let nums11 = Nums.map((el) => {
                      return parseInt(el)
                    })
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#pieChart"), {
                        series: nums11,
                        chart: {
                          height: 350,
                          type: 'pie',
                          toolbar: {
                            show: true
                          }
                        },
                        labels: Names
                      }).render();
                    });
                  </script>
                  <!-- End Pie Chart -->
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Right side columns -->
      </div>
    </section>

  </main><!-- End #main -->

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