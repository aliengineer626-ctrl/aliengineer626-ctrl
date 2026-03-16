<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل حركة مالية</title>
   
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

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_ac = $_POST["name_ac"];
    $phone_ac = $_POST["phone_ac"];
    $adderss_ac	 = $_POST["adderss_ac"];
    $type = $_POST["type"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $sql = "UPDATE  account SET name_ac='$name_ac', phone_ac='$phone_ac', adderss_ac='$adderss_ac' ,gender='$type' ,email='$email' WHERE id_ac='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "تم تحديث الحركة بنجاح!";
    } else {
        echo "خطأ: " . $conn->error;
    }
} else {
    
    $sql = "SELECT * FROM account WHERE id_ac='$id'";
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

<h2>تعديل بيانات شخص</h2>
<form method="post">
    <label>الاسم:</label>
    <input type="text" name="name_ac" value="<?php echo isset($row['name_ac']) ? htmlspecialchars($row['name_ac']) : ''; ?>" required><br>
    <label>النوع :</label>
    <select name="type">
        <option value="ذكر" <?php echo (isset($row['gender']) && $row['gender'] == 'ذكر') ? 'selected' : ''; ?>>ذكر</option>
        <option value="انثى" <?php echo (isset($row['gender']) && $row['gender'] == 'انثى') ? 'selected' : ''; ?>>انثى</option>
    </select><br>

    <label>رقم الهاتف:</label>
    <input type="number" name="phone_ac" readonly value="<?php echo isset($row['phone_ac']) ? htmlspecialchars($row['phone_ac']) : ''; ?>" required><br>

    <label>العنوان:</label>
    <textarea name="adderss_ac"><?php echo isset($row['adderss_ac']) ? htmlspecialchars($row['adderss_ac']) : ''; ?></textarea><br>
    <label>الايميل:</label>
    <input type="email" name="email" readonly value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>" required><br>


    <button type="submit">تحديث</button>
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
