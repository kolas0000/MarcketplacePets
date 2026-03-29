<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();

if(isset($_POST['phone']) && isset($_POST['password'])){
    $user_phone = htmlspecialchars($_POST['phone']);
    $user_password = htmlspecialchars($_POST['password']);



    $sql = "select * from users where phone = '$user_phone'";
    if($result = mysqli_query($con ,$sql)){
        $t=mysqli_num_rows($result);
        if($t > 0){
            foreach($result as $item){
            if($item['phone'] == $user_phone && password_verify($user_password, $item['password_user'])){
            $_SESSION['user_id'] = $item['id_user'];
            $_SESSION['phone'] = $item['phone'];
            $_SESSION['user_name'] = $item['Name'].$item['Surname'].$item['MiddleName'];
            $_SESSION['role'] = 2;
            header('Location: /index.php');
            exit();
        }
      } 
  } 
} else if ($item['phone'] == $user_phone && password_verify($user_password, $item['password_user']) != true ) { ?>
       <h1>"Пользователь не найден";</h1> 
    <?php  }
}


if(isset($_SESSION['user_id'])){
 echo "123";
}
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
    <div class="overlay" id="overlay"></div>
    <div class="reg">
        <a href="index.php"><img src="photo/pngegg (1) 1.png"></a>
        <div class="register">
            <img src="photo/Vector (1).png">
            <p>Вход</p>
        </div>
        <form class="forms" action="" method="post">
            <input class="login" type="text" name="phone" placeholder="Введите свой номер телефона">
            <input class="login" type="text" name="password" placeholder="Введите пароль">
            <div class="btntwo">
            <input type="submit" class="login1" id="getCode" value="Войти">
            <a class="login2" href="RegisterSpecialist.php">Зарегистрироваться</a>
            </div>
        </form>
       
        <!-- <div class="gettingTheCode" id="gettingTheCode">
            <div class="Code" id="Code">
                <p>На ваше устройство был отправлен
                    шестизначный код для подтверждения</p>
                <form class="getCode">
                    <input type="text" placeholder="Введите код">
                    <input type="submit" value="Войти">
                </form>

            </div>
        </div> -->
    </div>
</body>
<script src="getcodeSpecialis.js"></script>

</html>