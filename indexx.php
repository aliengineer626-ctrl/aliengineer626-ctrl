<?php
include_once("connect.php");
?>

<!DOCTYPE html>
<html lang="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST['log'])){
        $u = strip_tags($_POST['username']);
        $p = strip_tags($_POST['pppp']);
        if(!filter_var($p,FILTER_VALIDATE_INT)){
 
echo "<script>alert('عفون ادخل كلمه السر المطلوبة');</script>";

        }
        if(empty($u)){
            header("location:indexx.php?error=user name is required");
            exit();
        } 
        if(empty($p)){
            header("location:indexx.php?error=password is required");
            exit();
        } else {
            $hash = md5($p);




            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $u);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if($row['password'] === $hash ){
                  
                    echo "<script>alert('تم تسجيل الدخول: ".$row['username']."')</script>";
                    echo "<script>window.location.href='main.php'</script>";
                } 
                else {
                    echo "<script>alert('كلمة المرور غير صحيحة')</script>";
                    echo "<script>window.location.href='indexx.php?username=$u&pas=$p&erroruser=errorpassword'</script>";
                }
            } else {
                echo "<script>alert('لا يوجد مستخدم')</script>";
                echo "<script>window.location.href='indexx.php?username=$u&pas=$p&erroruser=errorpassword'</script>";
            }  
        }
    }
    ?>
</body>
</html>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>
<style>
 body {
    font-family: Arial, sans-serif;
    background-image: url("logo/ddd.jpg");

    
  background-size: cover;
   
   background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
header{
background-image: linear-gradient( rgb(183, 118, 118),hwb(0 94% 4%) ,green);
margin: 20px;
height: 400px;
}
h3 {
    color: #333;
    text-align: center;
}

center {height: 300px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    text-align: center;
   background-image: radial-gradient(#E9E9EB,#42506B);
}

label {
    display: block;
bottom: 5px;    
    color: #555;
}


#a{
    width: 90%;
    padding: 10px;
    margin-bottom: 30px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    background: #007BFF;
    color: #fff;
    border: none;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}

img {
    display: block;
    margin: 0 auto;
    max-width: 100%;
    height: auto;
}


  
</style>
<body>
  <center>   
<div class="cont-box">
<div  class="box">


</div>
<div  class="data"></div>
النظام المحاسبي

</div>
<form action="" method="post">
<h3>ادخل الاسم و كلمه المرور</h3>

<?php if (isset($_GET['erroeu'])){?>

 <p class="erroeu"><?php echo $_GET['erroeu'];?></p>
<?php } ?>

<?php if (isset($_GET['username'])){?>

<input type="text" name="uname" id="a" value="<?php echo $_GET['username']; ?>" placeholder="اسم تسجيل الدخول" >

<p class="error"><?php echo $_GET['erroruser'];?></p>
<input type="password" name="pppp" id="a" value="<?php echo $_GET['pas']; ?>" placeholder="كلمه المرر">
<?php } else { ?>
    <input type="taxt" name="username" id="a"  placeholder="اسم تسجيل الدخول" required>
    <input type="password" name="pppp" id="a"  placeholder="كلمه المرور" required>

    <?php } ?>
<button type="submit" name="log" id="a" >تسجيل الدخول</button>
</form>
</div>

</center> 
</body>
</html>