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

 $new_id = ($row['maxId'] + 1);

if (mysqli_fetch_array(mysqli_query ($con , "select count(phone) from users where phone = $phone"), MYSQLI_ASSOC ) > 0) {
    echo ('Пользователь существует с таким номером телефона!');
} else if (mysqli_fetch_array(mysqli_query ($con , "select count(phone) from users where email = $email"), MYSQLI_ASSOC ) > 0) {
 echo ('Пользователь существует с такой почтой!');
} else {
    mysqli_query($con, "insert into users(id_user, Name, Surname, MiddleName, password_user, phone, email, address, id_role)
 values (
 $new_id, '$name', '$surname', '$middleName', '$password', '$phone', '$email', '$address', 1)");

 header("Location: ../loginCLIENT.php");
 exit();
}
?>