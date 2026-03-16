<?php
session_start();
if(!$_SESSION['ali']=='yes'){

    header("Location:back.php");
}

?>

<?php
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST["product_id"]);
    $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $price = floatval($_POST["price"]);
$x=$_GET['ab'];

    $sqla = "INSERT INTO product_customer (type_many, product_name_costomer, price_product,idp)
     VALUES ('nagd', '$product_name', '$price','$x')";
    if ($conn->query($sqla) === TRUE) {
        echo "<script>alert('✅ تم شراء المنتج بنجاح!'); 
    </script>";
    } else {
        echo "<script>alert('❌ فشل الشراء!'); window.location.href='products.php';</script>";
    }
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المنتجات</title>
    <link rel="stylesheet" href="print.css">
</head>
<body>
<h2 class="title">قائمة المنتجات</h2>
<div class="products-container">
    <center>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product-di">
        <div class="product-card">
            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p>السعر: $<?php echo $row['price']; ?></p>


            <p>ROM: <?php echo $row['ROM']; ?></p>
            <p>RAM: <?php echo $row['RAM']; ?></p>
            <p>Propertie: <?php echo $row['propertie']; ?></p>
           
           
          
   
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
    <input type="hidden" name="price" value="<?php  echo $row['price']; $a=$row['id_pr'];?>">
   
    <a href="pay.php?as=<?php echo $a; ?>"> <button type="submit">🛒 شراء</button></a>
</form>

        </div>
        </div>
    <?php endwhile; ?>
    </center>
</div>

</body>
</html>

<?php $conn->close(); ?>
