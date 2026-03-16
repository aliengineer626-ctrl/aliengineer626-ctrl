<!DOCTYPE html><html dir="rtl" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة مالية</title>
    <link rel="stylesheet" href="style.css">
    <style>
      
      @media print {
          .print-btn {
              display: none;
          }
      }
  </style>
    <style>
       body {
    font-family: Arial, sans-serif;
   background-image: url(logo/m.jpg);
   
   background-size: cover;
    margin: 20px;
    color: #333;
}

        .invoice {
            width: 70%;
            margin: auto;
            background: white;
            opacity: 0.9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: right;
        }
        th {
            background-color:rgb(4, 14, 16);
            color: white;
            font-size: large;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: left;
        }
        .as {
float: left;
}
.ad{
float:right ;
}
h1{
  color: antiquewhite;  
}
        button{
            background: #28a745;
    color: white;
    width: 170px;
    padding: 10px;
    margin-top: 15px;
    cursor: pointer;
    border-radius: 5px;


        }
    </style>
</head>
<body><?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
$s1=0;
$s2=0;
$s3=0;
$conn->set_charset("utf8");
$id = isset($_GET['idp']) ? $_GET['idp'] : '';


$sqls = "SELECT id_ac, name_ac, phone_ac, adderss_ac, gender FROM account WHERE id_ac='$id'";
$results = mysqli_query($conn, $sqls);
if (!$results) {
    die("خطأ في الاستعلام: " . mysqli_error($conn));
}

$sqlp = "SELECT * FROM product_customer WHERE idp='$id'";
$resultp = mysqli_query($conn, $sqlp);
if (!$resultp) {
    die("خطأ في الاستعلام: " . mysqli_error($conn));
}

    $account = mysqli_fetch_assoc($results);
    
    ?>
    <center> <h1>فاتورة مالية</h1></center> 
    <div class="invoice">
  
    <div class="as">
    <p><strong>اسم العميل:</strong> <?php echo $account['name_ac']; ?></p>
    <p><strong>رقم الهاتف:</strong> <?php echo $account['phone_ac']; ?></p></div>

    <div class="ad">
    <p><strong>العنوان:</strong> <?php echo $account['adderss_ac']; ?></p>
    <p><strong>الجنس:</strong> <?php echo $account['gender']; ?></p>
   

    </div>
    <table>
        <tr>
            <th>المنتج</th>
            <th>السعر</th>
            <th>النوع</th>
            <th>ناريخ شرى المنتج</th>
        </tr>
        <?php while ($product = mysqli_fetch_assoc($resultp)) { ?>

            <tr>
                <td><?php echo $product['product_name_costomer']; ?></td>
                <td><?php echo $product['price_product']; ?></td>
                <td><?php echo $product['type_many']; ?></td>
                <td><?php echo $product['date']; ?></td>
            </tr>
            <?php 

if($product['idp']==$id&& $product['type_many']=='dean'){
 $s1+=$product['price_product'];

}  
if($product['idp']==$id){
 $s2+=$product['price_product'];

}  
if($product['idp']==$id&& $product['type_many']=='nagd'){
 $s3+=$product['price_product'];

}  
?>
        <?php } ?>
        
       
    </table>
    <p class="total">المبلغ الإجمالي: <?php echo $s2; ?> ريال</p>
    <p class="total">المبلغ المدفوع: <?php echo $s3; ?> ريال</p>
    <p class="total">المبلغ المدين: <?php echo $s1; ?> ريال</p>
</div>
<button class="print-btn" onclick="window.print()">🖨️ طباعة</button>
<?php


$conn->close();

?>
<div id="rr">
<form  method="get">
            <button type="submit" class="print-btn" name="submi"> الرجوع </button>
        </form>  
    <?php
    if(isset($_GET['submi'])){
        header("location:show.php");
    }
    ?>
    </div>
</body>
</html> 