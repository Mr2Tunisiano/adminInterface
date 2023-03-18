<?php
include_once('db_connect.php');
$id = $res['id_uti'];
$new = $_POST['newpassword'];
if(isset($_POST['submit'])) {
  $req2 = "UPDATE `utilisateur` SET `mdp` = '$new' WHERE `utilisateur`.`id_uti`='$id';";
  $send2 = @mysqli_query($connect,$req2);
  header('location:../../admin_index.php');
}
?>