<?php
include_once('db_connect.php');
if (isset($_POST['search']) and isset($_POST['crit'])) {
  $crit = strtolower($_POST['crit']);
  $req22 = "select * from produit where nom_p='$crit'";
  $send22 = @mysqli_query($connect, $req22);
  $ras22 = @mysqli_fetch_array($send22);
  if ($ras22['nom_p']) {
    $prod_id = $ras22['id_p'];
    $prod_price = $ras22['prix'];
    $req23= "SELECT * from `produit_commande` WHERE id_p='$prod_id'";
    $send23 = @mysqli_query($connect,$req23);
    $product_qte= 0;
    while ($res23= @mysqli_fetch_array($send23)) {
      $product_qte += $res23['qte'];
    }
    $_SESSION['found'] = true;
    $_SESSION['product'] = $ras22;
    $_SESSION['qte'] = $product_qte;
    header('location: ../../salesP.php');
  } else {
    $_SESSION['found'] = false;
    header('location: ../../salesP.php');
  }
};
