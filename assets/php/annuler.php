<?php
include_once('db_connect.php');
$id_c = $_GET['id_c'];
$req02 = "DELETE FROM `commandes` WHERE `id_c`='$id_c'";
$send02 = @mysqli_query($connect,$req02);
$req03 = "DELETE FROM `produit_commande` WHERE `id_c`='$id_c'";
$send03= @mysqli_query($connect,$req03);
$_SESSION['deleted'] = $id_c;
header('location: ../../sales.php');
?>