<?php

session_start();

$conn=new mysqli('localhost','root','','project');
$result = mysqli_query($conn,"SELECT * FROM signup");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
<title>Welcome Page</title>
<style>
a{
    text-decoration: none;
    
    font-size: 20px;
  }
  body{
    background-color: cornflowerblue;
  }
h1{
  color:white;
}
#profile{
  margin-top:30px;
  height:100px;
  width:100px;
  border-radius:50%;
  
}

#pic{
  height:150px;
  width:150px; 
  border: 2px solid black; 
  
}
.user {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    font-size:9px;
}

.user td, .user th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 1px;

}

.user tr:nth-child(odd) {
    background-color: lightblue;
}
.profile{
  height:500px;
  width:600px;
}

p{
  color:red;
}


</style>
</head>
<body>
    <div id="container-fluid">
        <center><h1 style="text-shadow: 2px 2px black;"><b>WELCOME TO ADMIN PAGE</b></h1></center>
        
        <div id="row"class="row" >
        <div class="col-sm-1" ></div>
          <div class="col-sm-2" style="background-color:blue;height:650px;border: 2px solid black;">
          <center><img id="profile"src="<?= $_SESSION['picture'];?>"><br>
          <h4 style="color:white;"><?= $_SESSION['firstname'];?>
          <?= $_SESSION['lastname'];?></h4>
          <a href="signout.php" style="color:white;">SignOut</a> </center>
        </div>
          <div class="col-sm-8" style="background-color:white;border: 2px solid black;">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">Manage Users</a></li>
                  <li><a data-toggle="tab" href="#menu1">Profile</a></li>
                  <li><a href="signout.php">SignOut</a></li>
                </ul>
                <div class="tab-content">
                   <div id="home" class="tab-pane fade in active">
                  <center> <h3>List of user added</h3></center>
                    <p><b><?= $_SESSION['message'];?></b></p>
              <?php
            
              if (mysqli_num_rows($result) > 0) {
              ?>
                <table class="user">
                
                <tr>
                   
                    <th>FIRSTNAME</th>
                    <th>LASTNAME</th>
                    <th>FATHERNAME</th>
                    <th>MOTHERNAME</th>
                    <th>CURRENTCITY</th>
                    <th>DOB</th>
                    <th>GENDER</th>
                    <th>EDUCATION</th>
                    <th> EMAIL</th>
                    <th> PHONE</th>
                    <th> PASSWORD</th>
                    <th> PICTURE</th>
                    <th> ACTION</th>
                </tr>
              <?php
                $i=0;
                while($row = mysqli_fetch_array($result)){
                 
                ?>
                <tr>
                    
                    <td><?php echo $row["firstname"]; ?></td>
                    <td><?php echo $row["lastname"]; ?></td>
                    <td><?php echo $row["fathername"]; ?></td>
                    <td><?php echo $row["mothername"]; ?></td>
                    <td><?php echo $row["city"]; ?></td>
                    <td><?php echo $row["dob"]; ?></td>
                    <td><?php echo $row["gender"]; ?></td>
                    <td><?php echo $row["education"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["mobile"]; ?></td>
                    <td><?php echo $row["password"]; ?></td>
                    <td><?php echo $row["picture"]; ?></td>
                    
                    <td>
                   <a href="delete.php? id=<?php if($row["email"]!=$_SESSION["email"]){ echo $row["id"];}?>"><i class="large material-icons">delete</i></a></span></td>
                </tr>
                <?php
                   
                $i++; 
                }
               ?>
                </table><br>
                <button class="btn btn-success"  data-toggle="modal" data-target="#myModal">Add User</button>

                <div class="modal fade" id="myModal">
                   <div class="modal-dialog">
                      <div class="modal-content">
                      
                          <div class="modal-header">
                           <h4 class="modal-title"><b>ADD USER</b></h4>
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                          <iframe src="adduser.php" height="750px" width="450px" title="Iframe Example"></iframe>
                          </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                         </div>
                      </div>
                  </div>
                
                
                
                <?php
                }
                else{
                    echo "No result found";
                }
                ?>

              </div>

               <div id="menu1" class="tab-pane fade" style="background-color:">
                   
                     <div class="card" style="margin-top:5px;">
                         <div class="card-header"><center> <h3><b><u>Profile Section</b></u></h3></center><br>
                             <div id="row"class="row" >
                                <div class="col-sm-2" ></div>
                                <div class="col-sm-6" >
                                  <table class="profile">
                                  <tr>
                                    <th>Name:</th><td><?= $_SESSION['firstname'];?>
                                     <?= $_SESSION['lastname'];?></td></tr>
                                    <tr>
                                    <th>Father's Name:</th><td><?= $_SESSION['fathername'];?></td>
                                    </tr>
                                    <tr>
                                      <th>Mother's Name:</th><td><?= $_SESSION['mothername'];?></td>
                                    </tr>
                                    <tr>
                                      <th>Current City Name:</th><td><?= $_SESSION['city'];?></td>
                                    </tr>
                                    <tr>
                                      <th>Date Of Birth</th><td><?= $_SESSION['dob'];?></td>
                                    </tr>
                                    <tr>
                                      <th>Gender:</th><td><?= $_SESSION['gender'];?></td>
                                    </tr>
                                    <tr>
                                      <th>Highest Qualification:</th><td><?= $_SESSION['education'];?></td>
                                    </tr>
                                    <tr>
                                      <th>Email Id:</th><td><?= $_SESSION['email'];?></td>
                                    </tr>
                                    <tr>
                                      <th>Mobile No:</th><td><?= $_SESSION['phone'];?></td>
                                    </tr>
                                    </table>
                                </div>
                                 <div class="col-sm-2" ><img id="pic" src="<?= $_SESSION['picture'];?>"></div>
                               </div>
                             </div>
                            </div>
                        </div>
                </div>
              </div>
        </div>
      </div>
</body>
</html>