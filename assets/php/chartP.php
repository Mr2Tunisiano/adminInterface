<?php 
  include_once('./db_connect.php');
  $series = array();
  $labels = array();
  $req01 = "SELECT id_p, SUM(qte) as total_qte FROM `produit_commande` GROUP BY id_p ORDER BY total_qte DESC LIMIT 5";
  $query01 = @mysqli_query($connect,$req01);
  while ($res01= @mysqli_fetch_assoc($query01)) {
    $series[] = $res01['total_qte'];
    $productId = $res01['id_p'];
    $req02 = "SELECT * FROM `produit` WHERE `id_p` = '$productId'";
    $query02 = @mysqli_query($connect,$req02);
    while ($res02 = @mysqli_fetch_assoc($query02)) {
      $labels[] = $res02['nom_p'];
    }
  }
  $JsonNums= json_encode($series);
  $JsonNames = json_encode($labels);
?>
<script>
  let Nums = <?php echo $JsonNums ?>
  let Names = <?php echo $JsonNames ?>
</script>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Donut Chart</h5>

    <!-- Donut Chart -->
    <div id="donutChart"></div>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#donutChart"), {
          series: Nums,
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
