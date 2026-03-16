<?php
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $price = floatval($_POST["price"]);
    $RAM = intval($_POST["RAM"]);
    $ROM = intval($_POST["ROM"]);
    $propertie =mysqli_real_escape_string($conn,$_POST["propertie"]);
    if(empty($propertie)){
        $propertie="";
    }
    $image = $_FILES["image"]["name"];
    $target = "images/" . basename($image);

    if (!empty($name) && !empty($price) && !empty($image)&& !empty($RAM) && !empty($ROM) ) {
       
        $sql = "INSERT INTO products (name, price, image,ROM,RAM,propertie)
     VALUES ('$name', '$price', '$image', '$ROM', '$RAM', '$propertie')";
        if ($conn->query($sql) === TRUE) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $target);
            $msg = "تمت إضافة المنتج بنجاح!";
        } else {
            $msg = "خطأ في الإضافة: " . $conn->error;
        }
    } else {
        $msg = "الرجاء ملء جميع الحقول!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج</title>
    <link rel="stylesheet" href="product.css">
</head>
<body>

<h2 class="title">إضافة منتج جديد</h2>

<form action="" method="post" enctype="multipart/form-data">
    <div class="con">
    <div class="as">
    <label for="name">اسم المنتج:</label> <br>
    <input type="text" name="name" id="name" required><br>
    <label for="price">السعر:</label><br>
    <input type="number" name="price" id="price" step="0.01" required><br>
    <label for="image">صورة المنتج:</label><br>
    <input type="file" name="image" id="image" accept="image/*" required>
</div>
<div class="ad">
<label for="ROM">:ROM</label><br>
    <input type="text" name="ROM" id="ROM"  required><br>
<label for="RAM">:RAM</label><br>
    <input type="number" name="RAM" id="RAM"  required><br>
<label for="propertie">:propertie</label><br>
<textarea name="propertie" id="propertie"></textarea><br>
</div>
</div><br>
    <button type="submit">إضافة المنتج</button>
</form>

<p class="message"><?php echo $msg; ?></p>

</body>

</html>