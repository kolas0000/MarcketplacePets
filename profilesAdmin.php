<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();

$role = $_SESSION['role'];

if ($_SESSION['role'] != 3) {
    header("Location: /index.php");
}
$profileQuery = mysqli_query($con, "SELECT id_user, users.Name as name_user, Surname, MiddleName, phone ,specialization.name as name_special, img from users join specialization on users.specialization = Id_specialization where id_role = 2 AND status_specialist = 'в подтверждении' ");


$profiles = mysqli_fetch_all($profileQuery, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/applicationsAdmin.css">
   
</head>

<body>
    <div class="home">
        <div class="homeclient">
            <div class="CancelHome">
                <a href="homeAdmini.php"> <img src="photo/pngegg (1) 1.png"></a>
                <p>Профили</p>
            </div>
        </div>

        <div class="applications">
       <form>
  <table>
    <thead>
      <tr>
        <th>Cпециалист</th>
        <th>Специализация</th>
        <th>Номер телефона</th>
        <th>Документ</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($profiles as $profile) { ?>
        <tr>
        <td><?= $profile['name_user']." ".$profile['Surname']." ".$profile['MiddleName'] ?></td>
        <td><?= $profile['name_special'] ?></td>
        <td><?= $profile['phone'] ?></td>
        <td> <a href="<?= $profile['img'] ?>" download="">Скачать файл</a></td>
        <td><a href="php/acceptSpecialst.php?id=<?= $profile['id_user']?>">Принять</a> <a href="php/CancelSpecialist.php?id=<?= $profile['id_user']?>">Отклонить</a></td>
        </tr>
    <?php   } ?>
    
    </tbody>
  </table>
</form>
        

    </div>
    </div>
</body>

</html>