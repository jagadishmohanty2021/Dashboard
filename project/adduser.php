<?php
session_start();
$_SESSION['message']=' ';
$conn=new mysqli('localhost','root','','project');
if(!$conn){
  die('Could not Connect My Sql:' .mysql_error());
}

if($_SERVER['REQUEST_METHOD']=='POST'){
  $pass=$_POST['password'];
  if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#",$pass)) {
    $_SESSION['message']="Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
   }
  if($_POST['password']==$_POST['cnfpassword']){

      $first=$_POST['firstname'];
      $last=$_POST['lastname'];
      $fname=$_POST['fathername'];
      $mname=$_POST['mothername'];
      $city=$_POST['currentcity'];
      $email=$_POST['email'];
      $phone=$_POST['phone'];
      $dob=$_POST['dob'];
      $gender=$_POST['gender'];
      $education=$_POST['education'];
      $password=md5($_POST['password']);

      $pic=$conn->real_escape_string('images/'.$_FILES['picture']['name']); 
    if(preg_match("!image!",$_FILES['picture']['type'])){
      if(copy($_FILES['picture']['tmp_name'],$pic)){

          $sql = "INSERT INTO signup (firstname,lastname,fathername,mothername,city,dob,gender,education,email,mobile,password,picture)
          VALUES ('$first', '$last', '$fname', '$mname','$city','$dob','$gender','$education','$email','$phone', '$password', '$pic')";
        
        if($conn->query($sql)){
          echo '<script>alert("Registration Successfully.Please Login");window.location="signin.php";</script>';
            exit;
          
        }else{
            $_SESSION['message']="Data insert error.";	
        }
      }else{
          $_SESSION['message']="File upload failed!";
      }
    }else{
        $_SESSION['message']="Please only upload GIF, JPG, or PNG images!";
    }
  }else{
      $_SESSION['message']="Password and confirm password are not match.";
  }
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/popper.min.js"></script>
    <script src="javascript/bootstrap.min.js"></script>
    <style>
  

 
  a{
    text-decoration: none;
    color: black;
    font-size: 20px;
  }
  #submit{
    background:green;
    color:white;
  }
  p{
    background: red;
    color:white;
    font-size:17px;
    border-radius: 5px;
  }
  .form-control{
    border: 2px solid black;
  }
    </style>
    
    <title>SignUp Page</title>

</head>
<body>
  <div class="container mt-3">
    <center>
    <form style="width:400px;" action="index.php" method="post" enctype="multipart/form-data" autocomplete="off">  
  
  <p><?= $_SESSION['message'];?></p>
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="First Name" name="firstname" required>
    <input type="text" class="form-control" placeholder="Last Name" name="lastname" style="margin-left:10px;" required>
  </div>
  <input type="text" class="form-control" placeholder="Father's Name" name="fathername" required><br>
  <input type="text" class="form-control" placeholder="Mother's Name" name="mothername" required><br>
  <input type="text" class="form-control" placeholder="Current City" name="currentcity" required><br>
  
  <div class="form-check-inline">
  <label class="form-check-label" for="radio1" style="width:150px;height:auto;">
        <b>Date Of Birth:</b>
      </label>
  <label class="form-check-label">
  <input type="date" class="form-control" name="dob" style="width:250px;height:auto" required>
  </label>
</div>
  <div class="form-check-inline">
  
  <label class="form-check-label">
    <b style="margin-right:70px;">Gender :</b><input type="radio" class="form-check-input" name="gender" value="male">Male
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="gender" value="female">Female
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="gender" value="other">Other
  </label>
</div>
<div class="form-group">
     
      <select class="form-control" id="sel1" name="education" required>
      <option value="" disabled selected>-Select_Highest_Qualification-</option>
      <option value="Matriculation">Matriculation</option>
        <option value="ITI">ITI</option>
        <option value="Diploma">Diploma</option>
        <option value="BTech">BTech</option>
        <option value="MTech">MTech</option>
        <option value="Phd">Phd</option>
        <option value="Other">Other</option>
      </select>
  </div>
  <input type="email" class="form-control" placeholder="Email" name="email" required><br>
  <input type="tel" class="form-control" placeholder="Mobile No" name="phone" required><br>
  
  <input type="password" class="form-control" placeholder="Password" name="password" required><br>
  <input type="password" class="form-control" placeholder="Confirm Password" name="cnfpassword" required><br>

  <div class="form-check-inline">
  <label class="form-check-label" for="radio1" style="width:100px;height:40px">
        <b>Select image:</b>
      </label>
  <label class="form-check-label">
  <input type="file" class="picture"name="picture" style="width:300px;height:40px" required>
  </label>
</div>

 
  <br>
  <input type="submit"  name="SignUp" value="Add User" id="submit" class="form-control" style="font-size:larger;">
  
    
  
  

</form>
</center>
</div>

    


  
</body>
</html>