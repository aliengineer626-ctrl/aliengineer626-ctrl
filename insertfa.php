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

include("connect.php");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$id = isset($_GET['iid']) ? $_GET['iid'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST["amount"];
    $details = $_POST["details"];
    $type = $_POST["type"];

    $sql = "INSERT INTO transactions(id,amount, details,type)VALUES('$id','$amount','$details','$type')  ";

    if ($conn->query($sql) === TRUE) {
        echo "تم الاضافه الحركة بنجاح!";
    } else {
        echo "خطأ: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM transactions WHERE id='$id'";
    $result = $conn->query($sql);
if( !$result){
    echo"no qeury";
}
    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        die("لم يتم العثور على البيانات.");
    }
}

$conn->close();
?>

<h2>اضافه حركة (دائن - مدين)</h2>
<form method="post">
    <label>المبلغ:</label>
    <input type="number" name="amount" required><br>

    <label>تفاصيل:</label>
    <input type="text" name="details"  required><br>
    <label>نوع الحركة:</label>
    <select name="type">
        <option value="dain" >دائن</option>
        <option value="madeen" >مدين</option>
    </select><br>

    <button type="submit">ادخال</button>
</form>



</body>
</html>
