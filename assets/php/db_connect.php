<?php
session_start();
$connect = @mysqli_connect("localhost","root","","pfe");
$id = $_SESSION['id_uti'];
$req = "select * from utilisateur where id_uti='$id'";
$send = @mysqli_query($connect,$req);
$res = @mysqli_fetch_array($send);
?>