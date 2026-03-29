<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$id = $_SESSION['user_id'];
$idRequest = $_POST['id_request'];
$grade = $_POST['grade'];
$comm =$_POST['comm'];
$dateAndTime = date_format(new DateTime(), 'Y-m-d H:i:s');


mysqli_query($con, "insert into reviews(description, grade, id_request, data)
values ('$comm', $grade, $idRequest, '$dateAndTime')
");

header("Location: ../homeClient.php");
?>