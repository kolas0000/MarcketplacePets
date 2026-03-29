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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="reg">
        <div class="register">
        <img src="photo/Vector (1).png">
        <p>Регистрация</p>
        </div>
        <form class="forms" action="php/registerSpecialist.php" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="введите свое имя" name="Name">
            <input type="text" placeholder="Введите свою фамилию" name="Surname">
            <input type="text" placeholder="Введите свое отчество" name="MiddleName"> <?php ?> 
            <input type="password" placeholder="Введите пароль" name="password_user">
            <input type="phone"  pattern="\8\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}-?\d{2}-?\d{2}" placeholder="8 (999) 999-99-99" name="phone">
            <input type="email" placeholder="Введите свою почту" name="email">
            <select name="special">
                <?php foreach ($specializationArr AS $special) { ?>
                <option value="<?=$special['Id_specialization']?>"><?=$special['Name']?></option>
                <?php  } ?>
            </select>
            <input type="number" placeholder="Введите ваш опыт работы" name="Exp">
            <input type="file" placeholder="Прикрепите документ для подтверждения" name="fileWork">
            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
    <a href="/homeAdmini.html"> 123</a>
</body>
</html>
