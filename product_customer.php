<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> حركة مالية</title>
    <link rel="stylesheet" href="tt.css">
  
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}


$conn->set_charset("utf8");

$id = isset($_GET['idc']) ? $_GET['idc'] : '';
$sqls = "SELECT name_ac FROM account where id_ac='$id'";
$results = mysqli_query($conn, $sqls); 
$rows = mysqli_fetch_assoc($results);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name_costomer = $_POST["product_name_costomer"];
    $price_product = $_POST["price_product"];
    $type_many = $_POST["type_many"];

   
    $sql = "INSERT INTO product_customer(idp,product_name_costomer, price_product,null)
    VALUES('$id','$product_name_costomer','$price_product','$type_many')  ";

    if ($conn->query($sql) === TRUE) {
        echo "تم الاضافه الحركة بنجاح!";
    } else {
        echo "خطأ: " . $conn->error;
    }
} 


$conn->close();
?>

<h2>اضافه ديون: <?php  echo $rows['name_ac']; ?></h2>
<form method="post">
    <label>اسم المنتاج:</label>
    <input type="text" name="product_name_costomer" required><br>

    <label>السعر:</label>
    <input type="number" name="price_product"  required><br>
    <label>نوع الحركة:</label>
    <select name="type_many">
        <option value="nagd" >نقدا</option>
        <option value="dean" >دينا</option>
    </select><br>

    <button type="submit">ادخال</button>
</form>

<div id="rr">
<form  method="get">
            <button type="submit" name="submi"> الرجوع </button>
        </form>  
    <?php
    if(isset($_GET['submi'])){
        header("location:show.php");
    }
    ?>
    </div>

</body>
</html>
