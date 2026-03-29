<?php

 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
 
 $name = $_POST['Name'];

 $surname = $_POST['Surname'];

 $middleName = $_POST['MiddleName'];

 $password = $_POST['password_user'];

 $phone = $_POST['phone'];

 $email = $_POST['email'];

 $specialist = $_POST['special'];

 $expWork = $_POST['Exp'];

 $fileWork = $_FILES['fileWork']['tmp_name'];
 $uploude2 = "../sertificate/".$_FILES['fileWork']['name'];

 move_uploaded_file($fileWork, $uploude2);

 $result = mysqli_query($con,'select max(id_user) as maxId from users');
 $row = mysqli_fetch_assoc($result);
 $new_id = ($row['maxId'] + 1);

 mysqli_query($con, "insert into users(id_user, Name, Surname, MiddleName, password_user, phone, email, specialization, experience, img)
 values (
 $new_id, '$name', '$surname', '$middleName', '$password', '$phone', '$email', $specialist, $expWork, '$uploude2')");

 header("Location: /RegisterSpecialist.php");
 exit();
?>