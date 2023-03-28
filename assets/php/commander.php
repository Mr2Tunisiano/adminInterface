<?php 
$prodsJSON = $_GET['prods'];
$prods = json_decode($prodsJSON);
$paid = $_GET['paid'];
$user = $_GET['user'];
$count = $_GET['count'];
$total = $_GET['total'];

echo '<pre>';
print_r($prods);
echo $paid . "<br>";
echo $user . "<br>";
echo $count . "<br>";
echo $total . "<br>";
echo '</pre>'
// prods=${SendObj}&paid=${paid}&user=${user}&count=${count}&total=${total}
?>