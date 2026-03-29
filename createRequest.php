<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();


$role = $_SESSION['role'];

if ($_SESSION['role'] != 1) {
    header("Location: /index.php");
}

$services = mysqli_fetch_all(mysqli_query($con, "select * from service"),MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/application.css">
</head>

<body>
    <div class="home">
        <div class="homeclient">
            <div class="CancelHome">
               <a href="homeClient.php"><img src="photo/pngegg (1) 1.png"></a>
                <p>Создание заявки</p>
            </div>
        </div>

        <form action="php/CreateRequest.php" method="post" class="createApplication">
            
            <div class="labels">
            <label for="typeofService">Тип услуги</label>
            </div>
            <select id="typeofService" name="typeofService" required>
           
            <?php 
            foreach ($services as $service) { ?>
            <option value="<?= $service['id_service'] ?>"><?= $service['name_service'] ?></option>

          <?php  }
            ?>
            </select>
            <div class="labels">
            <label for="DateAndTime">Дата и время</label>
            </div>
            <input type="datetime-local" id="DateAndTime"  name="DateAndTime" required/>
            <div class="labels">
              <label for="address">Адрес</label required>
              </div>
            <input type="text" name="addreess" required>
            <div class="labels">
             <label for="comment">Комментарий</label>
             </div>
             <input type="text" id="comment" name="comment">
             <input type="submit" value="Отправить заявку">
        </form>
    </div>
</body>

</html>