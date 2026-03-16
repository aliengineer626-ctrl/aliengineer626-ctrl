<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>كشف حساب العملاء</title>
<link rel="stylesheet" href="showcss.css">
    <?php
    include("connect.php");
    mysqli_set_charset($con, "utf8");
    if ($con->connect_error) {
        die("فشل الاتصال: " . $con->connect_error);
    }




   

    $sqls = "SELECT* FROM account";
    $results = mysqli_query($con, $sqls); 

    if (!$results) {
        die("خطأ في الاستعلام: " . mysqli_error($con));
    }
    ?>
</head>
<a href="login.php">
<button class="btn-17">
  <span class="text-container">
    <span class="text">اضافه عميل</span>
  </span>
</button></a>  
     

<body>
    <h2>كشف حساب العملاء</h2>
    <table>
        <tr>

            <th>رقم العميل</th>
             <th>اسم العميل</th>
             <th> الايميل</th>
            
            <th>الهاتف</th>
            <th> العنوان</th>
            <th>تاريخ الإنشاء</th>
            <th>عرض التفاصيل</th>
            <th>تعديل دين</th>
            <th> الفاتوره</th>
            <th>حذف العميل</th>
        </tr>
        <?php  $x=1;
            while ($rows = $results->fetch_assoc()) {
                if(  $sqls){
              $id=$rows['id_ac'];
             
            ?>
            <tr>
                <td><?php echo $x++;  ?></td>
               
                <td><?php echo htmlspecialchars($rows['name_ac']); ?></td>
                <td><?php echo htmlspecialchars($rows['email']); ?></td>
              
                <td><?php echo htmlspecialchars($rows['phone_ac']); ?></td>
                <td>
                <?php echo htmlspecialchars($rows['adderss_ac']); ?>
                </td>
                <td><?php echo $rows['date_ac']; ?></td>
                <td><a href="tttt.php?id=<?php echo $rows['id_ac']; ?>" class="dital">تعديل البيانات</a></td>
                <td><a href="product_customer.php?idc=<?php echo $rows['id_ac']; ?>" class="dital">اضافه دين</a></td>
                <td><a href="presonal.php?idp=<?php echo $rows['id_ac']; ?>" class="dital">عرض الفاتورة </a></td>
                <td><a href="delete.php?id=<?php echo $rows['id_ac']; ?>" class="detelea" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا العميل؟');">حذف العميل</a></td>
            </tr>
        <?php } else{
echo"window.location.alert('ليس لديه فاتوره')";
header("location.herf('tindex.php')");
        }}?>
    </table>
</body>
</html>

<?php
$con->close();
?>
