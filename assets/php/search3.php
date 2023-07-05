<?php
include_once('db_connect.php');
$crit = $_POST['crit'];
if (isset($_POST['search']) and isset($_POST['crit'])) {
  $req22 = "SELECT * FROM commandes WHERE DATE(date_c) = DATE('$crit')";
  $send22 = @mysqli_query($connect, $req22);
  $ras22 = @mysqli_fetch_array($send22);
  if ($ras22) {
    $_SESSION['found'] = $crit;
    header('location: ../../sales.php');
  } else {
    $_SESSION['found'] = false;
    header('location: ../../sales.php');
  }
};
