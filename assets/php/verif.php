<?php 
session_start();
if(isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $connect = @mysqli_connect("localhost","root","","pfe");
  $req = "SELECT * from utilisateur WHERE nom='$username' AND mdp='$password'";
  $send = @mysqli_query($connect,$req);
  $res = @mysqli_fetch_array($send);
  if (!($res == null)) {
    $_SESSION['id_uti'] = $res['id_uti'];
    $isAdmin = $res['isAdmin'];
    if ($isAdmin == 1) {
      echo json_encode(array("success" => "yes","isAdmin" => "yes"));
    } else {
      echo json_encode(array("success" => "yes","isAdmin" => "no"));
    }
  } else {
    echo json_encode(array("success" => "no","isAdmin" => "no"));
  }
}
