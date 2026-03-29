<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$role = $_SESSION['role'];
$id = $_SESSION['user_id'];



if ($_SESSION['role'] != 3) {
    header("Location: /index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/feedback.css">
</head>

<body>
    <div class="home">
        <div class="homeclient">
            <div class="CancelHome">
                <a href="homeClient.php"><img src="photo/pngegg (1) 1.png"></a>
                <p>Создание услуги</p>
            </div>
        </div>

        <form action="php/createService.php" method="post" class="createApplication">
            <input type="hidden" name="id_request" value="<?=$idRequest?>">
             <div class="labels">
              <label for="service">Название услуги</label>
              </div>
            <input type="text" name="service" required>
             <input type="submit" value="Создать услугу">
        </form>
    </div>
</body>

</html>