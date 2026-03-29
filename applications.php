<?php
$con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');

$requests = mysqli_query($con, "SELECT r.id_request, CONCAT(s.Name, ' ', s.Surname, ' ', s.MiddleName) AS specialist_full_name, CONCAT(c.Name, ' ', c.Surname, ' ', c.MiddleName) AS client_full_name, status.name , r.date_request, r.type_service, c.address, name_service FROM requests r JOIN users s ON r.user_specialist = s.id_user JOIN users c ON r.user_client = c.id_user JOIN service ON r.type_service = service.id_service join status on r.status_Request = status.id_status;");


$requestsAll = mysqli_fetch_all($requests, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="applicationsAdmin.css">
   
</head>

<body>
    <div class="home">
        <div class="homeclient">
            <div class="CancelHome">
                <img src="photo/pngegg (1) 1.png">
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
        <td><?= $request['specialist_full_name'] ?></td>
        <td><?= $request['address'] ?></td>
        <td><?= $request['name'] ?></td>
        </tr>
 
    <?php   } ?>
    
    </tbody>
  </table>
</form>
        

    </div>
    </div>
</body>

</html>