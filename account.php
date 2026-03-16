<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head><link rel="stylesheet" href="login.css">
<body>


<?php
function ali(){

    echo "<script>alert('يجب ادخال كافه البيانات')</script>";
    header("Location: login.php");
}
include("connect.php");
$test=0;
if(isset($_POST['submit'])){
     if(empty($_POST['name'])||empty($_POST['phone'])||empty($_POST['cct'])||empty( $_POST['gender'])){
      ali();
      $sql="SELECT * FROM account(name_ac,phone_ac,adderss_ac ,customer,gender ) VALUES('$name','$phone','$address','$cct','$gender')";
      $test=mysqli_query($con,$sql);
      if(!$test){
          echo "no query";
          }
         
        }else{
$name= $_POST['name'];
$phone= $_POST['phone'];
$address= $_POST['address'];
$cct= $_POST['cct'];
$gender= $_POST['gender'];
$pass= md5($_POST['pass']);

$sql="INSERT INTO account(name_ac,phone_ac,adderss_ac ,email,pasword,gender ) VALUES('$name','$phone','$address','$cct','$pass','$gender')";
$test=mysqli_query($con,$sql);
if(!$test){
    echo "no query";
    }else{

        echo "<script>alert('تمت الاضافه')</script>";
        echo "<script>window.location.href='login.php'</script>";
       
    
    }
    
}

}

    
?>

</body>
</html>