<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$id = $_SESSION['user_id'];

$type = $_POST['typeofService'];
$dateAndTime =$_POST['DateAndTime'];
$address =$_POST['addreess'];
$comment =$_POST['comment'];

mysqli_query($con, "insert into requests(user_client, description, status_Request, date_request, type_service, address)
values ($id, '$comment', 5, '$dateAndTime', $type, '$address')
");

header("Location: ../homeClient.php");
?>