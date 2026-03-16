<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

include("connnect.php");

if ($con->connect_error) {
    die("فشل الاتصال: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST["product_id"]);
    $product_name = mysqli_real_escape_string($con, $_POST["product_name"]);
    $price = floatval($_POST["price"]);

    // إدخال الطلب في جدول product_customer
    $sql = "INSERT INTO product_customer (type_many, product_name_costomer, price_product) VALUES ('nagd', '$product_name', '$price')";
   
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('✅ تم شراء المنتج بنجاح!'); window.location.href='products.php';</script>";
    } else {
        echo "<script>alert('❌ فشل الشراء!'); window.location.href='products.php';</script>";
    }
}

$con->close();
?>

    
</body>
</html>