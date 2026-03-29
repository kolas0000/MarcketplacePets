<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($_SESSION['role'] != 2) {
    header("Location: /index.php");
}
$filter = $_GET['filter']?? false;
if($con) {
$requetss = mysqli_query($con, "SELECT requests.id_request, CONCAT(c.Name, ' ', c.Surname) AS client_full_name, requests.description, status_Request, date_request, type_service, requests.address as Address, grade, name_service, status.name as statusName
 from requests left join reviews on requests.id_request = reviews.id_request left join users c on requests.user_client = c.id_user join service on requests.type_service = service.id_service 
 join status on requests.status_Request = status.id_status
 WHERE requests.user_specialist = $id; ");
 if($filter) {
    $requetss = mysqli_query($con, "SELECT requests.id_request, CONCAT(c.Name, ' ', c.Surname) AS client_full_name, requests.description, status_Request, date_request, type_service, requests.address as Address, grade, name_service, status.name as statusName
 from requests left join reviews on requests.id_request = reviews.id_request left join users c on requests.user_client = c.id_user join service on requests.type_service = service.id_service 
 join status on requests.status_Request = status.id_status
 WHERE requests.user_specialist = $id and status_Request = $filter");
 }

 $requets = mysqli_fetch_all($requetss, MYSQLI_ASSOC);
 }
 $idReqiest = 0;
$status = mysqli_fetch_all(mysqli_query($con, "select * from status"), MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/applicationSpecialist.css">
   
</head>

<body>
    <div class="home">
        <div class="homeclient">
            <div class="CancelHome">
                <a href="homeSpecialist.php"><img src="photo/pngegg (1) 1.png"></a>
                <p>Заявки</p>
            </div>
            <form action="">
            <select name="filter" id="filter">
                 <option > ... </option>
            <?php foreach($status as $item) {  ?>

 <option <?=$filter == $item['id_status'] ? "selected" : "" ?> value="<?=$item['id_status']?>"> <?=$item['name']?> </option>
          
      <?php  }    ?>
</select>
</form>
<a class="deleteFilter" href="applicationsSpecialist.php">Сбросить фильтр</a>
        </div>

        <div class="applications">
  <table>
    <thead>
      <tr>
        <th>Номер заявки</th>
        <th>Клиент</th>
        <th>Тип услуги</th>
        <th>Описание</th>
        <th>Дата и время</th>
        <th>Адрес</th>
        <th>Статус заявки</th>
        <th> </th>
        
      </tr>
    </thead>
    <tbody>
     
 
 <?php foreach($requets as $requet) { ?>
    <tr>
   <td><?=$idReqiest = $idReqiest+ 1?> </td>
<td><?=$requet['client_full_name']?> </td>
<td><?=$requet['name_service']?> </td>
<td><?=$requet['description']?> </td>
<td><?=date('d.m.Y H:i:s', strtotime($requet['date_request']))?> </td>
<td><?=$requet['Address']?> </td>
<td><?=$requet['statusName']?> </td>
<?php if ($requet['status_Request'] == 2 || $requet['status_Request'] == 4 || $requet['status_Request'] == 3) { ?>
<td>   </td>
 <?php } else if ($requet['status_Request'] == 5) { ?>
  <td> <a href="php/ConfirmApplication.php?id_request=<?=$requet['id_request']?>">Подтвердить</a> <a href="php/cancelApplication.php?id_request=<?=$requet['id_request']?>">Отклонить</a> </td>
  <?php } else { ?>
     <td> <a href="php/completeApplication.php?id_request=<?=$requet['id_request']?>">Выполнено</a> </td> 
  <?php } ?>
  </tr>
  <?php } ?>


    
    </tbody>
  </table>

        

    </div>
    </div>
</body>
<script>
 const filter = document.getElementById('filter');

 filter.addEventListener('change', () => {
    filter.parentNode.submit();
 }) 
    </script>
</html>