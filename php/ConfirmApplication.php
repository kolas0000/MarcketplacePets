<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$id = $_SESSION['user_id'];
$idRequest = $_GET['id_request'];

mysqli_query($con, "update requests set status_Request = 1 where id_request = $idRequest");

header('Location: ../applicationsSpecialist.php');
exit();
?>