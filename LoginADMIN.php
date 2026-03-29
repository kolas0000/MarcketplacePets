<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();

if(isset($_POST['login']) && isset($_POST['password'])){
    $user_login = htmlspecialchars($_POST['login']);
    $user_password = htmlspecialchars($_POST['password']);

    $sql = "select * from users where Name = '$user_login'";
    if($result = mysqli_query($con ,$sql)){
        $t=mysqli_num_rows($result);
        if($t > 0){
            foreach($result as $item){
            // print_r($item);
            if($item['Name'] == $user_login && password_verify($user_password, $item['password_user'])){
            $_SESSION['user_id'] = $item['id_user'];
            $_SESSION['role'] = 3;
            $_SESSION['login'] = $item['Name'];
            header('Location: index.php');
        }
      } 
  } 
} else if ($item['Name'] == $user_login && password_verify($user_password, $item['password_user']) != true ) { ?>
       <h1>"Пользователь не найден";</h1> 
    <?php  }
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
    <div class="reg">
         <a href="index.php"><img src="photo/pngegg (1) 1.png"></a>
        <div class="register">
        <img src="photo/Vector (1).png">
        <p>Вход</p>
        </div>
        <form class="forms" action="" method="post">
            <input type="text" name="login" placeholder="Введите свой логин">
            <input type="text" name="password" placeholder="Введите пароль">
            <input type="submit" value="Войти">
        </form>
    </div>
</body>
</html>