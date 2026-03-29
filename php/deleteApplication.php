<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');

$id = $_GET['id_application'];

mysqli_query($con, "delete from requests where id_request = $id");

header('Location: ../homeClient.php')
?>