<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تطبيق حساباتي</title>
  <style>  body {
    font-family: Arial, sans-serif;
    background-image: url('logo/pin.jpg');
    text-align: center;

   
    background-size: cover;
    background-repeat: no-repeat;
}</style>
</head>
<link rel="stylesheet" href="login.css">
<body> 
    <?php
    include("connect.php");
?> 
    

    <div class="header">
        <h1>تطبيق حساباتي</h1>
    </div>

    <div class="container">
        <h2>صفحة إضافة عميل</h2>
       
        <form method="post" action="account.php">
            <label for="name">اسم </label>
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

           
          
<button   type="submit" name="submit"  class="btn-17">
  <span class="text-container">
    <span class="text">اضافه عميل</span>
  </span>
</button>



        </form> 
         


</div>
</body>
</html>

