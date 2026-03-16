<?php
session_start();
if(!$_SESSION['ali']=='yes'){

    header("Location:back.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="dash.css">
</head>
<link rel="stylesheet" href="maincss.css">
<body><center>
    <div class="dashboard">
        <h1>مرحبًا بك في لوحة التحكم</h1>
        <h1>أداره نـــــظـــــام متجر</h1>
	<center>
    <div class="img1">
     <img src="logo/aaaa.webp"></div>
          <br>
    <?php
     
    $sf=$_GET['aa'];
    $email="";
$password="";
    ?>


      <a href="print.php?ab=<?php echo $sf;?>"><button class="btn-17"><span class="text-container">
      <span class="text">تسوق</span></span></button></a>

      <a href="tindex.php"><button class="btn-17"><span class="text-container">
      <span class="text">  الفواتير</span></span></button></a>


      <a href="logout.php"><button class="btn-17"><span class="text-container">
      <span class="text"> تسجيل الخروج</span></span></button></a>


    </div>
    </center>
</body>
</html>
