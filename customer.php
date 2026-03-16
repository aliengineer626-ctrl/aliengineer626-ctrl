<?php
session_start();
if(!$_SESSION['ali']=='yes'){

    header("Location:back.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>كشف حساب: </title>
  <style>
    body {
   
   background-size: cover;
   background-repeat: no-repeat;
   background-image: url('logo/new2.jpg');
   min-width: 100px;
   
color:black;
}
img{
width: 50px;
height: 30px;
}
  h3,h2 {
    text-align: center;
    color:#fff;
    margin-top: 20px;
}

table {
    background-color: burlywood;
    opacity: 0.7;
    
    width: 100%;
    border-collapse: collapse;
   font-size: 22px;
    margin: 20px 0;
}

table, th, td {
    border: 2px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: center;
}
</style>
  
  
  <?php
    include("connect.php");
    mysqli_set_charset($con, "utf8");
    if ($con->connect_error) {
        die("فشل الاتصال: " . $con->connect_error);
    }

    
    if ($_GET['iid']) {
        $id = isset($_GET['iid']) ? $_GET['iid'] : '';
        $sql = "SELECT * FROM  product_customer where idp='$id'";
        $qeury = "SELECT * FROM account where id_ac='$id'";
        $result = mysqli_query($con, $sql);
        
        $test = mysqli_query($con, $qeury);
        if (!$result) {
            die("خطأ في الاستعلام: " . mysqli_error($con));
        }
    }
    $s1=0;
    $s2=0;
    $s3=0;
    ?>
</head>
<body>
    <h2>كشف حساب العميل</h2>
    <table border="1">
        <tr>
            <th>التاريخ</th>
            <th>البيان</th>
            <th>المبلغ</th>
            <th>حاله الدين</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td><?php echo htmlspecialchars($row['product_name_costomer']); ?></td>
                <td><?php echo number_format($row['price_product']); ?> ريال</td>
                <td>
                <?php 
                   if($row['idp']==$id&& $row['type_many']=='dean'){
                    $s1+=$row['price_product'];

                   }  
                   if($row['idp']==$id){
                    $s2+=$row['price_product'];

                   }  
                   if($row['idp']==$id&& $row['type_many']=='nagd'){
                    $s3+=$row['price_product'];

                   }  
                
                ?>
                    <?php 
                      $s=0;
                    if ($row['type_many'] == "dean") {
                     

                        ?>
                        <img src="logo/mm.jpeg" alt="">
                    <?php } else { ?>
                        <img src="logo/ma.png" alt="">
                    <?php } ?>
                </td>

            </tr>
        <?php 
 
    } ?>
    </table>
  <?PHP echo  "<h3>". $s1.":  مجموع الدين</h3>";   
   echo  "<h3>". $s3.":  مجموع البيع ناقدا</h3>";
      echo  "<h3>". $s2.":  المجموع الكلي</h3>";
  ?>
</body>
</html>

<?php
$con->close();
?>
