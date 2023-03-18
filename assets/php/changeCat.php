<?php 
require_once('db_connect.php');
$new = $_POST['nName'];
$id = $_POST['id'];
$idCat = $_SESSION['id_cat'];
$req5 = "UPDATE `categorie` SET `nom_cat` = '$new' WHERE `categorie`.`id_cat` = '$id'";
$send5 = @mysqli_query($connect,$req5);
unset($_SESSION['id_cat']);
$_SESSION['ChangeS'] = $new;
header('location:../../cat.php')
?>