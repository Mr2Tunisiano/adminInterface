<?php 
include_once("./db_connect.php");
$id = $_GET['id'];
$name= $_GET['name'];
$price= $_GET['price'];
$desc= $_GET['desc'];
$cat= $_GET['cat'];
$req01 = "UPDATE `produit` SET `nom_cat`='$cat',`nom_p`='$name',`prix`='$price',`desc`='$desc' WHERE `id_p`= '$id'";
$query01 = @mysqli_query($connect,$req01);
$_SESSION['ProdChange'] = $name;
header('location:../../prod.php');
?>