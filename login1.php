<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>تسجيل الدخول</title>
  <link rel="stylesheet" href="maincss.css">
</head>
<?php

include("connect.php");
if (!$con) {
    die("فشل الاتصال: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

  
if(isset($_POST['submit'])){
  $email =$_POST["email"];
    $password= $_POST["password"];
        
    $query = "SELECT * FROM account WHERE email='$email' AND pasword ='$password'";

      $result = mysqli_query($con, $query);
        
if(mysqli_num_rows($result)==1){



  $user = mysqli_fetch_assoc($result);
        $a=$user['id_ac'];
$_SESSION['ali']='yes';
        header("Location:adsha.php?aa=$a");
}

    } else {
        echo "البريد أو كلمة المرور غير صحيحة!";
    }

  }

mysqli_close($con);
?>


<body>
  <div class="signup-container">
    <h2>تسجيل الدخول</h2>
    <form action="" method="POST">
      <label for="email">البريد الإلكتروني</label>
      <input type="text" id="email" name="email" required>

      <label for="password">كلمة المرور</label>
      <input type="number" id="password" name="password" required>
      <button type="submit" name="submit">دخول</button>

      
    </form>
  </div>
</body>
</html>