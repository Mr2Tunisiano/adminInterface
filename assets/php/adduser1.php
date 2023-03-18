<?php 
require_once('db_connect.php');
$nom = $_POST['nom'];
$id = $_POST['id'];
$mdp = $_POST['mdp'];
$fonc = $_POST['fonc'];
$req55 = "INSERT INTO `utilisateur` (`id_uti`, `nom`, `mdp`, `isAdmin`) VALUES ('$id', '$nom', '$mdp', '$fonc');";
$send55 = @mysqli_query($connect,$req55);
$_SESSION['Success'] = $nom;
header('location: ../../adduser.php')
?>