<?php

 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
$id = $_GET['id'];
echo $id;
mysqli_query($con, "update users
set status_specialist = 'Подтверждено' where id_role = 2 && id_user = $id");

header("Location: /profilesAdmin.php");
exit();
?>