<?php
session_start();

$conn=new mysqli('localhost','root','','project');
$sql = "DELETE FROM signup WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($conn, $sql)) {
    if($_GET["id"]!=" "){
    $_SESSION['message']="Record delete sucessfully.";
    echo '<script>window.location="welcome.php";</script>';
    }else{
        $_SESSION['messege']="Can not delete own data.";
        echo '<script>window.location="welcome.php";</script>';
    }
} 

?>