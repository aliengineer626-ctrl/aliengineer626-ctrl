

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تطبيق حساباتي</title>
  <style>  body {
    font-family: Arial, sans-serif;
    background-image: url('logo/imag.jpg');
    text-align: center;

   
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
</head>
<link rel="stylesheet" href="login.css">
<body> 
    <?php
    include("connect.php");

if(isset($_POST['submit'])){
     if(empty($_POST['name'])||empty($_POST['phone'])||empty($_POST['cct'])||empty( $_POST['gender'])){
    
         
        }else{
$name= $_POST['name'];
$phone= $_POST['phone'];
$address= $_POST['address'];
 $pass= md5($_POST['pass']);
$cct= $_POST['cct'];
$gender= $_POST['gender'];
$sqlS="select * from account where email='$cct' AND phone_ac='$phone'";
$testS=mysqli_query($con,$sqlS);
$sss= mysqli_fetch_assoc( $testS);
if($sss){
  echo "<script>alert(' لقد تم تسجيلاك من قبل')</script>";
  echo "<script>window.location.href='main1.php'</script>";

}
$sql="INSERT INTO account(name_ac,phone_ac,adderss_ac ,email,pasword,gender ) VALUES('$name','$phone','$address','$cct',' $pass','$gender')";
$test=mysqli_query($con,$sql);


if(!$test){
    echo "no query";
    }else{
        $sqls="SELECT id_ac FROM  account where phone_ac='$phone'";
        $tests=mysqli_query($con,$sqls);
       $ss= mysqli_fetch_assoc( $tests);
      $g= $ss['id_ac'];
      if($g){
        echo "no query";}
      echo $g;
        echo "<script>alert('تمت تسجيلاك ')</script>";
       
        echo "<script>window.location.href='adsha.php?aa=$g'</script>";
    }
}
}   
?>
    <div class="header">
        <h1>تطبيق حساباتي</h1>
    </div>

    <div class="container">
        <h2>صفحة تسجيل عميل</h2>
       
        <form method="post" action="main1.php">
            <label for="name">الاسم: </label>
            <input type="text" id="name" name="name" placeholder="اسم ">

       
            <div class="con">
  
    ذكر <input type="radio" id="male" name="gender" value="ذكر" selected>   
          انثى <input type="radio" id="female" name="gender" value="انثى">

            </div>
   

            <label for="phone">رقم الهاتف</label>
            <input type="text" id="phone" name="phone" placeholder="رقم الهاتف">

            <label for="address">العنوان</label>
            <input type="text" id="address" name="address" placeholder="العنوان">

            <label for="categor">الايميل</label>
            <input type="email" name="cct" id="category"  placeholder="الايميل">
        
            <label for="add">كلمه السر</label>
            <input type="text" id="add" name="pass" placeholder="كلمه السر">

            
      
            <button type="submit" name="submit" class="btn-17"><span class="text-container">
      <span class="text">  تسجيل</span></span></button>
        </form> 
    
        <!-- <div class="ss">
        <a href="indexx.php?usertype=ADMIN"><button class="btn-17"><span class="text-container">
      <span class="text">مسجل منقبل</span></span></button></a>
      
</div> -->
    <!-- <div class="ss">
        <a href="indexx.php?usertype=ADMIN"><button class="btn-17"><span class="text-container">
      <span class="text">  Admin</span></span></button></a>
      
</div> -->
    </div>

   


</body>
</html>

