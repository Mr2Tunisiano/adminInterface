<?php 
include_once('./db_connect.php');
$qte = 0;
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $qte = $qte + 1;
  $req01 = "SELECT * FROM produit WHERE id_p='$id'";
  $envoi01 = @mysqli_query($connect,$req01);
  $res01 = @mysqli_fetch_array($envoi01);
  if($res01 != null) {
    $_SESSION['qte'] = $qte;
    $id = $res01['id_p'];
    $nom = $res01['nom_p'];
    $prix = $res01['prix'];
    echo json_encode(array(
      "id" => $id,
      "nom" => $nom,
      "prix" => $prix,
      "qte" => $qte
    ));}
}
?>