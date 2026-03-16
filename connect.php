<?php
$localhost="localhost";
$root="root";
$password="";
$database="database";

$con=mysqli_connect($localhost,$root,$password,$database);
mysqli_set_charset($con,"utf8");
if(!$con){
echo "no connect";
}
?>
