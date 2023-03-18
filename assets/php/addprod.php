<?php 
include_once('db_connect.php');
$id = $_POST['id'];
$name = strtolower($_POST['nom']);
$cat = strtolower($_POST['cat']);
$prix = $_POST['prix'];
$desc = strtolower($_POST['desc']);
$imgName = $_FILES['img']['name'];
$imgTemp = $_FILES['img']['tmp_name'];
$imgType = $_FILES['img']['type'];
$imgSize = $_FILES['img']['size'];
$error = $_FILES['img']['error'];
$errors = array();
$allowedExt = array('jpeg', 'gif', 'png','jpg');
$imgExtArr = explode('.' , $imgName);
$imgExt = strtolower(array_pop($imgExtArr));
$req1 = "INSERT INTO `produit` (`id_p`, `nom_cat`, `nom_p`, `prix`, `photo`, `desc`) VALUES ('$id', '$cat', '$name', '$prix', '', '$desc')";
$req11 = "INSERT INTO `produit` (`id_p`, `nom_cat`, `nom_p`, `prix`, `photo`, `desc`) VALUES ('$id', '$cat', '$name', '$prix', '$imgName', '$desc')";

if (! isset($_FILES['img']['name'])) {
  $send1 = @mysqli_query($connect,$req1);
  $_SESSION['prodS'] = $name;
  header('location:../../addproduct.php');
}
else {
  if ($error === 4) {
    $send11 = @mysqli_query($connect,$req11);
    move_uploaded_file($imgTemp, '../img/products/'.$imgName);
    $_SESSION['prodS'] = $name;
    header('location:../../addproduct.php');
  }
  else {
if ($imgSize > 100000) {
  $errors[] = "size";
  $_SESSION['size'] = 'size';
  header('location:../../addproduct.php');
} 
if (! in_array($imgExt, $allowedExt)) {
  $errors[] = "ext";
  $_SESSION['ext'] = 'ext';
  header('location:../../addproduct.php');
}
if(empty($errors)) {
  $send11 = @mysqli_query($connect,$req11);
  move_uploaded_file($imgTemp, '../img/products/'.$imgName);
  $_SESSION['prodS'] = $name;
  header('location:../../addproduct.php');
}}
}
?>