<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$id_Aplication = $_POST['id_Aplications'];
$type_service = $_POST['typeofService'];
$date_request = $_POST['DateAndTime'];
$dateFormat = date_format(New DateTime($date_request), 'Y-m-d h:i');
$address = $_POST['addreess'];
$description = $_POST['comment'];

mysqli_query($con, "update requests
set type_service = $type_service, date_request = '$dateFormat', address = '$address', description = '$description' where id_request = $id_Aplication");

header('Location: ../homeClient.php');
exit();
?>