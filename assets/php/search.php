<?php 
include_once('db_connect.php');
if (isset($_POST['search']) and isset($_POST['crit'])) {
    $crit = strtolower($_POST['crit']);
    $req22 = "select * from produit where nom_p='$crit'";
    $send22 = @mysqli_query($connect,$req22);
    $ras22 = @mysqli_fetch_array($send22);
    if ($ras22['nom_p']) {
        $_SESSION['found'] = $crit;
        header('location: ../../prod.php');
    } else {
        $_SESSION['notfound'] = $crit;
        header('location: ../../prod.php');
    }
};
