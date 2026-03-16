<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "account";
include("connect.php");
if ($con->connect_error) {
    die("فشل الاتصال: " . $con->connect_error);
}
$con->set_charset("utf8");

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id) {
    $sql1 = "DELETE FROM transactions WHERE id='$id'";
    $sql2 = "DELETE FROM account WHERE id_ac='$id'";
    $sql3 = "DELETE FROM product_customer WHERE idp='$id'"; 
    if ($con->query($sql1) === TRUE&&$con->query($sql2) === TRUE&&$con->query($sql3) === TRUE) {
        echo "تم حذف العميل بنجاح!";
    } else {
        echo "خطأ: " . $con->error;
    }
} else {
    echo "لم يتم تحديد العميل للحذف.";
}

$con->close();
header("Location: show.php");
exit;
?>
