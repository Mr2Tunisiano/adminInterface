<?php 
include_once('db_connect.php');

$id_uti = $_GET['id'];
$req1 = "select * from utilisateur where `utilisateur`.`id_uti` = '$id_uti'";
$send1 = @mysqli_query($connect,$req1);
$res1 = @mysqli_fetch_array($send1);
$_SESSION['delS'] = $res1['nom'];
echo $_SESSION['delS'] ;
$req3 = "DELETE FROM utilisateur WHERE `utilisateur`.`id_uti` = '$id_uti'";
$send3= @mysqli_query($connect,$req3);
header('location:../../user.php')
?>