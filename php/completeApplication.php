<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$idRequest = $_GET['id_request'];
if($role == 2) {
mysqli_query($con, "update requests set status_Request = 3 where id_request = $idRequest");

header('Location: ../applicationsSpecialist.php');
exit();
} else {
    mysqli_query($con, "update requests set status_Request = 4 where id_request = $idRequest");

header('Location: ../feedback.php?id_request='.$idRequest);
exit();
}
?>