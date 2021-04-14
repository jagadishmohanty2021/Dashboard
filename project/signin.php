<?php
session_start();
$conn=new mysqli('localhost','root','','project');
$_SESSION['message']='';
if(!$conn){
  die('Could not Connect My Sql:' .mysql_error());
}
if($_SERVER['REQUEST_METHOD']=='POST'){

  $email=$_POST['email'];
  $pass=md5($_POST['password']);
  $stmt=$conn->prepare("select * from signup where email= ? and password= ?");
  $stmt->bind_param("ss",$email,$pass);
  $stmt->execute();
  $stmt_result = $stmt->get_result();
  if($stmt_result->num_rows > 0){
      $data = $stmt_result->fetch_assoc();

      $_SESSION['firstname']=$data['firstname'];
      $_SESSION['lastname']=$data['lastname'];
      $_SESSION['fathername']=$data['fathername'];
      $_SESSION['mothername']=$data['mothername'];
      $_SESSION['gender']=$data['gender'];
      $_SESSION['education']=$data['education'];
      $_SESSION['city']=$data['city'];
      $_SESSION['email']=$data['email'];
      $_SESSION['phone']=$data['mobile'];
      $_SESSION['dob']=$data['dob'];
      $_SESSION['picture']=$data['picture'];
     
    if($email==$data['email'] && $pass==$data['password']){
      
       echo '<script>alert("Login Successfully");window.location="welcome.php";</script>';

    }else{
     $_SESSION['message']="Invalid Emailid or Password!!";
    }
  }else{
    $_SESSION['message']="Invalid Emailid or Password!!";
   } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/popper.min.js"></script>
    <script src="javascript/bootstrap.min.js"></script>
   <style>

body{
    background-color: cornflowerblue;
  }

  form{
    margin-top: 200px;
  }
  a{
    text-decoration: none;
    color: black;
    font-size: 20px;
  }
  p{
    background: red;
    color:white;
    font-size:17px;
    border-radius: 5px;
  }
  #submit{
    background:green;
    color:white;
  }
  .form-control{
    border: 2px solid black;
  }
   </style>
    <title>SignIn Page</title>
</head>
<body>
  <div class="container mt-3">
    <center>
    <form style="width:400px" action="signin.php" method="post" enctype="multipart/form-data" autocomplete="off">  
      <h2><b>Login</b></h2>
      <p><?= $_SESSION['message'];?></p>
      <input type="email" class="form-control" placeholder="Email" name="email"><br>
      <input type="password" class="form-control" placeholder="Password" name="password"><br>
      
        
      <input type="submit"  name="SignIn" value="SignIn" id="submit" class="form-control" style="font-size:larger;">
        
      <a href="index.php">Create an account? Click Here!</a>
    </form>
    </center>
  </div>


</body>
</html>