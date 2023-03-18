<?php 
include_once('db_connect.php');
if(isset($_POST['sub'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mdp = $_POST['mdp'];
    if ($_POST['fonc'] == 'admin') {
        $fonc = 1;
        echo $fonc;
    } else {
        $fonc = 0;
        echo $fonc;
    }
    $req01 = "UPDATE `utilisateur` SET `id_uti` = '$id', `nom` = '$name', `mdp` = '$mdp', `isAdmin` = '$fonc' WHERE `utilisateur`.`id_uti` = '$id'";
    $send01 = @mysqli_query($connect,$req01);
    $_SESSION['ChangeS'] = $name;
    header('location: ../../user.php');
}
?>