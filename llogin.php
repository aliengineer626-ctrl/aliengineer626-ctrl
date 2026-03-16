<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<style>
img{
	width: 20%; 
	height: 20%	;


}
</style>

<?php

$localhost="localhost";
$root="root";
$password="";
$database="account";

include("conect.php");
mysqli_set_charset($con,"utf8");
if(!$con){
echo "no conect";
}


$type = $_GET['usertype'];

 $sqll = "SELECT * FROM keys";
            
    $query = mysqli_query($con, $sqll); 
          if( !$query ){
            echo 'no conect';

          }else{    echo ' conect';
         
    while ($row = mysqli_fetch_array( $query)){
    //	$image = $row['picture'];
}}
          
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "SELECT * FROM keys where username='$username' 
	and password = '$password' and usertype = '$type'";

	$result	= mysqli_query($con,$query);
   if( !$result ){
      echo 'no data';

    }else{    echo ' data';}
	$rows  = mysqli_fetch_array($result);
//if($row>0){echo"yes";}
	 if(is_array($rows)) {
	 	$_SESSION["id"] = $rows['id'];
	 	if($type == "ADMIN"){
	 		header('location: show.php');
	 	} elseif($type == "te"){
	 		header('location:view.php');
	 	}
	 } 
	else 
	{
		echo "<script>alert('اسم المستخدم او كلمه المرور خاطئه')</script>";
	}
}
?>


<div class="container">
<div class="mb-6 g-3 row justify-content-center">
<div class="col-lg-8">
    <br>
	<center>
	  <strong style="text-align:center">LOGIN FORM</strong>
	
      <div class="container">
         <form role="form" action="" method="post">
		 <strong>(<?php echo $type;?>)</strong>
								<br>
								<?php 
								if($type == "ADMIN"){	           
								?>
			<img src="images/<?php echo $image;?>"
		 </center>
								<?php } ?>
             
            <div class="form-group">
               <label for="Title" >اسم المستخدم</label>
               <div class="co-10">
                <input type="text" class="form-control" name="username"  placeholder="اسم المستخدم"  required>
               </div>
            </div>


            <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">كلمة المرور</label>
               <div class="col-sm-10">
                  <input type="password" class="form-control" name="password"  placeholder="كلمة المرور"  required>
               </div>
            </div>


            
            <br>
            <div class="form-group">
               <div class="col0">
                  <button  name="login" class="b-12" data-toggle="modal">
               دخول
                  </button>
               </div>
             </div>
			 <br>
		

         </form>
		 <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
			   <a href="index.php"><button  name="login" 
            class="btn btn-warning col-lg-12" data-toggle="modal">
               رجوع
                  </button></a>
               </div>
     
          </div>
        </div>
    </center>
    </div>
    </div>
    </div>

	
</body>
