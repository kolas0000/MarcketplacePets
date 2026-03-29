<?php

 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');

$name = $_POST['Name'];

$surname = $_POST['Surname'];

$middleName = $_POST['MiddleName'];

$password = password_hash($_POST['password_user'], PASSWORD_BCRYPT);

$phone = $_POST['phone'];

$email = $_POST['email'];

$specialist = $_POST['special'];

$expWork = $_POST['Exp'];

$fileWork = $_FILES['fileWork']['tmp_name'];
$uploude2 = "../sertificate/" . $_FILES['fileWork']['name'];

move_uploaded_file($fileWork, $uploude2);

$result = mysqli_query($con, 'select max(id_user) as maxId from users');
$row = mysqli_fetch_assoc($result);
$new_id = ($row['maxId'] + 1);

if (mysqli_fetch_array(mysqli_query ($con , "select count(phone) from users where phone = $phone"), MYSQLI_ASSOC ) > 0) {
    echo ('Пользователь существует с таким номером телефона!');
} else if (mysqli_fetch_array(mysqli_query ($con , "select count(phone) from users where email = $email"), MYSQLI_ASSOC ) > 0) {
 echo ('Пользователь существует с такой почтой!');
} else {

mysqli_query($con, "insert into users(id_user, Name, Surname, MiddleName, password_user, phone, email, specialization, experience, img, id_role, status_specialist)
 values (
 $new_id, '$name', '$surname', '$middleName', '$password', '$phone', '$email', $specialist, $expWork, '$uploude2', 2, 'В подтверждении')");

header("Location: /loginSPECIALIST.php");
exit();
}
?>