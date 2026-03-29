<?php

 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
if ($_SESSION['role'] != 3){
    header("Location: ../homeAdmini.php");
    exit();
} 
$service = $_POST['service'];



mysqli_query($con, "insert into service(name_service)
values ('$service')
");

header("Location: ../homeAdmini.php");
exit();
?>