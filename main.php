<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<script>
        function openPopup(url) {
            window.open(url, '_blank', 'width=920,height=800');
                }
    </script></center>
<link rel="stylesheet" href="maincss.css">
<br>
<h1>أداره نـــــظــــــــام متجر</h1>
	<center>
    <div class="img1">
     <img src="logo/new3.jpg"></div>
           
         <div class="container">
        <br>
  
	


<a href="tindex.php&ali=<?php echo 'yes'  ?>">
<button class="btn-17">
  <span class="text-container">
    <span class="text">الاستعلام عن حساب شخص</span>
  </span>
</button></a>  
  <a href='product.php'>
<button class="btn-17">
  <span class="text-container">
    <span class="text">اضافه منتج</span>
  </span>
</button></a>
     
      <a href="print.php">
<button class="btn-17">
  <span class="text-container">
    <span class="text"> تسوق</span>
  </span>
</button></a>

     

      

<?php
    if(isset($_POST['submi'])){
        header("location:show.php");
    }
    ?>
    <button   onclick="openPopup('show.php?customer_name')"class="btn-17">
  <span class="text-container">
    <span class="text">عرض العملاء</span>
  </span>
</button>
        </div>
		</center>  

</body>

</html>

