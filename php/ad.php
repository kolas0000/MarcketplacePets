<?php

 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
 
 $name = "kolas";

 $password = password_hash(123123, PASSWORD_BCRYPT);

 $phone = 89874505212;

 $email = strtolower("admin@gmail.com");

 $result = mysqli_query($con,'select max(id_user) as maxId from users');
 $row = mysqli_fetch_assoc($result);
 print_r($row);
 $new_id = ($row['maxId'] + 1);
 echo $new_id;

 mysqli_query($con, "insert into users(id_user, Name, password_user, phone, email, id_role)
 values (
 $new_id, '$name', '$password', '$phone', '$email', 3)");

?>