<?php
$con = mysqli_connect('localhost', 'root', '', 'marketplace');
session_start();
$role = $_SESSION['role'];

if ($_SESSION['role'] != 3) {
    header("Location: /public/index.php");
}

if (!empty($_GET['specialist'])) {
$idSpecialist = $_GET['specialist'];
$idRequest = $_GET['idRequest'];

mysqli_query($con, "update requests set user_specialist = $idSpecialist where id_request = $idRequest ");
}

if (!empty($_GET['status'])) {
  $status = $_GET['status'];
  $idRequest = $_GET['idRequest'];

  mysqli_query($con, "update requests set status_Request = $status where id_request = $idRequest");
}

$requests = mysqli_query($con, "SELECT r.id_request, CONCAT(s.Name, ' ', s.Surname, ' ', s.MiddleName) AS specialist_full_name, CONCAT(c.Name, ' ', c.Surname, ' ', c.MiddleName) AS client_full_name, status.name AS status_name, r.status_request, r.date_request, r.type_service, c.address, service.name_service AS name_service FROM requests r LEFT JOIN users s ON r.user_specialist = s.id_user LEFT JOIN users c ON r.user_client = c.id_user LEFT JOIN service ON r.type_service = service.id_service LEFT JOIN status ON r.status_Request = status.id_status ORDER BY r.id_request DESC;;");
$specialists = mysqli_fetch_all(mysqli_query($con, "select * from users where id_role = 2 and status_specialist = 'Подтверждено'"), MYSQLI_ASSOC);
$status = mysqli_fetch_all(mysqli_query($con, "select * from status"), MYSQLI_ASSOC);
$requestsAll = mysqli_fetch_all($requests, MYSQLI_ASSOC);



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
                <p>Заявки</p>
            </div>
        </div>

        <div class="applications">
       <form>
  <table>
    <thead>
      <tr>
        <th>Номер заявки</th>
        <th>Клиент</th>
        <th>Тип услуги</th>
        <th>Дата и время</th>
        <th>Специалист</th>
        <th>Адрес</th>
        <th>Статус заявки</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($requestsAll as $request) { ?>

        <tr>
        <td><?= $request['id_request'] ?></td>
        <td><?= $request['client_full_name'] ?></td>
        <td><?= $request['name_service'] ?></td>
        <td><?= date('d.m.Y', strtotime($request['date_request'])) ?></td>
        <?php if (empty($request['specialist_full_name'])) { ?>
        <td> <form action="" method="get"> 
          <input hidden value="<?= $request['id_request']?>" name ="idRequest">
          <select name="specialist">
           <option >...</option>
            <?php foreach($specialists as $specialist) { ?>

            <option value="<?= $specialist['id_user']?>"><?= $specialist['Name']." ".$specialist['Surname']." ".$specialist['MiddleName'] ?></option>

           <?php } ?>
        </select> </td> 
        </form>
         <?php } else { ?>
<td><?= $request['specialist_full_name'] ?></td>
        <?php } ?>
        <td><?= $request['address'] ?></td>
        <td>
          <form action="" method="get">
        <input hidden value="<?= $request['id_request']?>" name ="idRequest">  
        <select name="status" class="status">
            <?php foreach($status as $stat) { ?>

            <option value="<?= $stat['id_status']?>" <?= $request['status_request'] == $stat['id_status'] ? 'selected' : '' ?>><?= $stat['name'] ?></option>

           <?php } ?>
        </select> </td> 
  </form>
        </tr>
 
    <?php   } ?>
    
    </tbody>
  </table>

        

    </div>
    </div>
</body>
 <script>
 document.querySelectorAll('[name="specialist"]').forEach(select => {
  select.addEventListener('change', () => {
    select.closest('form').submit();
  });
});

  document.querySelectorAll('[name="status"]').forEach(select => {
  select.addEventListener('change', () => {
    select.closest('form').submit();
  });
});
  </script>
</html>