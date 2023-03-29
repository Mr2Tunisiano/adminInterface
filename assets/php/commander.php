<?php 
include_once('db_connect.php');
$count = $_GET['count'];

$req00 = "SELECT * FROM `commandes` WHERE `id_c`='$count'";
$query00 = @mysqli_query($connect,$req00);
$res00 = @mysqli_fetch_array($query00);

if (!is_numeric($res00['id_c'])) {
  $prodsJSON = $_GET['prods'];
  $prods = json_decode($prodsJSON);
  $paid = $_GET['paid'];
  $user = $_GET['user'];
  $total = $_GET['total'];
  $action = $_GET['action'];
  if ($action == "commande") {
    $req01 = "INSERT INTO `commandes` (`id_c`, `total`, `serveur`, `isPaid`) VALUES ('$count', '$total', '$user', '$paid')";
    $query01 = @mysqli_query($connect,$req01);
    foreach ($prods as $product) {
      $prod_id = $product->id_p;
      $qte = $product->qte_p;
      $req02 = "INSERT INTO `produit_commande` (`id_c`, `id_p`, `qte`) VALUES ('$count', '$prod_id', '$qte')";
      $query02 = @mysqli_query($connect,$req02);
      $_SESSION['CommandS'] = $count;
  };
  } elseif ($action == "pay") {
    $req01 = "INSERT INTO `commandes` (`id_c`, `total`, `serveur`, `isPaid`) VALUES ('$count', '$total', '$user', '1')";
    $query01 = @mysqli_query($connect,$req01);

    foreach ($prods as $product) {
      $prod_id = $product->id_p;
      $qte = $product->qte_p;
      $req02 = "INSERT INTO `produit_commande` (`id_c`, `id_p`, `qte`) VALUES ('$count', '$prod_id', '$qte')";
      $query02 = @mysqli_query($connect,$req02);
  };
  $_SESSION['CommandePay'] = $count;
  }
}else {
  $req03 = "UPDATE `commandes` SET `isPaid`='1' WHERE `id_c` ='$count'";
  $query03 = @mysqli_query($connect,$req03);
  $_SESSION['payS'] = $count;
}


// echo '<pre>';
// print_r($prods);
// echo $paid . "<br>";
// echo $user . "<br>";
// echo $count . "<br>";
// echo $total . "<br>";
// echo "<br>";
// echo $prods[0]->id_p . "<br>";
// echo $prods[0]->qte_p;
// echo '</pre>'
// prods=${SendObj}&paid=${paid}&user=${user}&count=${count}&total=${total}
?>