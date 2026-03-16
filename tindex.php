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
    <title>قائمة العملاء</title>
    <style>
* {

    box-sizing: border-box;
    font-family: Arial, sans-serif;

}

body {
   
    background-size: cover;
    background-repeat: no-repeat;
    background-image: url('logo/ddd.jpg');
    color: #333;
}

.header {
    background-color:rgb(101, 152, 223);
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

form label {
    margin-bottom: 5px;
    font-weight: bold;
}

form input, form select, form button {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    background-color:rgb(3, 39, 4);
    color: #fff;
    border: none;
    cursor: pointer;
}

form button:hover {
    background-color:rgb(17, 49, 18);
}

ul {
    list-style: none;
    padding: 0;
}

ul li {
    margin-bottom: 5px;
}/* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color:rgb(202, 212, 59);
}

.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

ul {
    list-style: none;
    padding: 0;
}

ul li {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

ul li:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

ul li a {
    text-decoration: none;
    color: #333;
    display: block;
    font-size: 18px;
}

ul li a:hover {
    color: #4CAF50;
}

p {
    text-align: center;
    font-size: 18px;
    color: #666;
}

</style>
<?php
include('connect.php');
if ($con->connect_error) {
    die("فشل الاتصال: " . $con->connect_error);
}


?>



</head>
<body><center>
    <h2>قائمة العملاء</h2>
    <h2>   جمع الديون وجميع المبيعات للعملاء </h2>
<form method="post">
<h3> للبحث عن اسمك</h3>

    <input type="text" name="roll">
    <button  name="search_by"type="submit">ابحث الان</button>


</form>
<ul>
<?php
if(isset($_POST['search_by']))

				{$ss=$_POST['roll'];
				$query = "select * from  account where name_ac like '%$ss%'";
					$query_run = mysqli_query($con,$query);
					while ($rows = mysqli_fetch_array($query_run))
					{
                        $idd=$rows['id_ac'];
                        ?>
<li><a href="customer.php?iid=<?php echo $idd?>">
<?php  echo htmlspecialchars($rows['name_ac']); ?>


</a></li>
                    <?php
                       
                    }
                }
                        ?>
    <?php 
    
$sql = "SELECT * FROM  account";
if(!$sql){
    echo "no qeuy";
}
$result = $con->query($sql);
    if ($result->num_rows > 0) { ?>
   
        <?php while ($row = $result->fetch_assoc()) { 
            $id=$row['id_ac'];
           
            ?>
            <li><a href="customer.php?iid=<?php echo $id ?>">

                <?php  echo htmlspecialchars($row['name_ac']); ?>
          
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>لم يتم العثور على عملاء.</p>
<?php } ?>

</center>
</body>
</html>

<?php $con->close(); ?>