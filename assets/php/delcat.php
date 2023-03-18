<?php 
include_once('db_connect.php');

if (isset($_SESSION['delS'])) {
  unset($_SESSION['delS']);
};
$id_cat = $_GET['id'];
$req1 = "select nom_cat from categorie where `categorie`.`id_cat` = '$id_cat'";
$send1 = @mysqli_query($connect,$req1);
$res1 = @mysqli_fetch_array($send1);
$_SESSION['delS'] = $res1['nom_cat'];
$req3 = "DELETE FROM categorie WHERE `categorie`.`id_cat` = '$id_cat'";
$send3= @mysqli_query($connect,$req3);
header('location:../../cat.php')
?>