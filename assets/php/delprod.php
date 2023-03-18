<?php 
include_once('db_connect.php');
$id_prod = $_GET['id'];
$req1 = "select nom_p from produit where `produit`.`id_p` = '$id_prod'";
$send1 = @mysqli_query($connect,$req1);
$res1 = @mysqli_fetch_array($send1);
$_SESSION['delS'] = $res1['nom_p'];
$req3 = "DELETE FROM produit WHERE `produit`.`id_p` = '$id_prod'";
$send3= @mysqli_query($connect,$req3);
header('location:../../prod.php')
?>