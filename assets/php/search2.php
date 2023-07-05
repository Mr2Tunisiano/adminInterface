<?php
include_once('db_connect.php');
if (isset($_POST['search']) and isset($_POST['crit'])) {
  $crit = strtolower($_POST['crit']);
  $req02 = "SELECT c.id_cat, c.nom_cat, SUM(pc.qte) AS total_qte FROM produit_commande pc INNER JOIN produit p ON pc.id_p = p.Id_p INNER JOIN categorie c ON p.nom_cat = c.nom_cat WHERE c.nom_cat = '$crit' GROUP BY c.nom_cat";
  $send02 = @mysqli_query($connect, $req02);
  $res02 = @mysqli_fetch_array($send02);
  if ($res02) {
    $req03 = "SELECT c.id_cat, c.nom_cat, SUM(pc.qte * p.prix) AS total_gains FROM produit_commande pc INNER JOIN produit p ON pc.id_p = p.Id_p INNER JOIN categorie c ON p.nom_cat = c.nom_cat WHERE c.nom_cat = '$crit' GROUP BY c.id_cat, c.nom_cat";
    $send03 = @mysqli_query($connect, $req03);
    $res03 = @mysqli_fetch_array($send03);
    $_SESSION['found'] = true;
    $_SESSION['id'] = $res02['id_cat'];
    $_SESSION['nom'] = $res02['nom_cat'];
    $_SESSION['qte'] = $res02['total_qte'];
    $_SESSION['gains'] = $res03['total_gains'];
    header('location: ../../salesC.php');
  } else {
    $_SESSION['found'] = false;
    header('location: ../../salesC.php');
  }
  echo "Total Qte : " . $res02['total_qte'] . '<br>';
  echo "Nom Categorie : " . $res02['nom_cat'] . '<br>';
  echo "Id Categorie : " . $res02['id_cat'] . '<br>';
  echo "total_gains : " . $res03['total_gains'] . '<br>';
};
