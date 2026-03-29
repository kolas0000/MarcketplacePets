<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
$specializationArr = mysqli_fetch_all( mysqli_query($con, 'select * from specialization'), MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/AuthStyles.css">
</head>
<body>
    <div class="reg">
       <a href="index.php"><img src="photo/pngegg (1) 1.png"></a>
        <div class="register">
        <img src="photo/Vector (1).png">
        <p>Регистрация</p>
        </div>
        <form class="forms" action="php/registerSpecialist.php" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="введите свое имя" name="Name" required>
            <input type="text" placeholder="Введите свою фамилию" name="Surname" required>
            <input type="text" placeholder="Введите свое отчество" name="MiddleName" required> <?php ?> 
            <input type="password" placeholder="Введите пароль" name="password_user" required>
            <input type="phone"  pattern="\8\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}-?\d{2}-?\d{2}" placeholder="8 (999) 999-99-99" name="phone" required>
            <input type="email" placeholder="Введите свою почту" name="email" required>
            <select name="special" required>
                <?php foreach ($specializationArr AS $special) { ?>
                <option value="<?=$special['Id_specialization']?>"><?=$special['Name']?></option>
                <?php  } ?>
            </select>
            <input type="number" placeholder="Введите ваш опыт работы" name="Exp" min="1" max="70" required>
            <input type="file" placeholder="Прикрепите документ для подтверждения" name="fileWork" required>
            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
</body>
</html>