<?php 
include_once('db_connect.php');
if (isset($_POST['sub'])) {
$name = strtolower($_POST['name']);
$id = $_POST['id'];
$req3 = "INSERT INTO `categorie` (`id_cat`, `nom_cat`) VALUES ('$id', '$name')";
$send3 = @mysqli_query($connect,$req3);
$_SESSION['name'] = $name;
header('location:../../addcat.php');
}
?>