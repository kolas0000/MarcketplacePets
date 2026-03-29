<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$role = $_SESSION['role'];

if ($_SESSION['role'] != 1) {
    header("Location: /index.php");
}
$id_Aplication = $_GET['id_application'];

$application = mysqli_fetch_array(mysqli_query($con, "select date_request, type_service, address, name_service, description  from requests
join service on requests.type_service = service.id_service where id_request = $id_Aplication "), MYSQLI_ASSOC);
print_r($application);
$services = mysqli_fetch_all(mysqli_query($con, "select * from service"),MYSQLI_ASSOC);
print_r($services);
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
                <img src="photo/pngegg (1) 1.png">
                <p>Изменение заявки</p>
            </div>
        </div>

        <form action="php/pushEditApplication.php" method="post" class="createApplication">
            <input hidden value="<?= $id_Aplication ?>" name="id_Aplications">
            <div class="labels">
            <label for="typeofService">Тип услуги</label>
            </div>
            <select id="typeofService" name="typeofService">
                <option value="<?= $application['type_service'] ?>"><?= $application['name_service'] ?></option>
            <?php 
            foreach ($services as $service) { ?>
            <option value="<?= $service['id_service'] ?>"><?= $service['name_service'] ?></option>

          <?php  }
            ?>
            </select>
            <div class="labels">
            <label for="DateAndTime">Дата и время</label>
            </div>
            <input type="datetime-local" id="DateAndTime" value="<?=  date_format(New DateTime($application['date_request']), 'Y-m-d\TH:i')?>" name="DateAndTime"/>
            <div class="labels">
              <label for="address">Адрес</label>
              </div>
            <input type="text" name="addreess" value="<?= $application['address'] ?>">
            <div class="labels">
             <label for="comment">Комментарий</label>
             </div>
             <input type="text" value="<?= $application['description'] ?>" id="comment" name="comment">
             <input type="submit" value="Отправить заявку">
             <a class="deleteApplication" href="php/deleteApplication.php?id_application=<?=$id_Aplication?>">Отменить заявку</a>
        </form>
      
    </div>
</body>

</html>