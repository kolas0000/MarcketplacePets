<?php

 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
 
 $name = $_POST['Name'];

 $surname = $_POST['Surname'];

 $middleName = $_POST['MiddleName'];

 $password = password_hash($_POST['password_user'], PASSWORD_BCRYPT);

 $phone = $_POST['phone'];

 $email = strtolower($_POST['email']);

 

 $address = $_POST['address'];
 $role = 1;

 $result = mysqli_query($con,'select max(id_user) as maxId from users');
 $row = mysqli_fetch_assoc($result);
 print_r($row);
 $new_id = ($row['maxId'] + 1);
 echo $new_id;

 mysqli_query($con, "insert into users(id_user, Name, Surname, MiddleName, password_user, phone, email, address, id_role)
 values (
 $new_id, '$name', '$surname', '$middleName', '$password', '$phone', '$email', '$address', 1)");

 header("Location: /loginCLIENT.php");
 exit();
?>