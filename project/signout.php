<?php
session_start();
session_destroy();
echo '<script>alert("You have successfully SignOut.");window.location="signin.php";</script>';
?>