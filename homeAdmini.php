<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();

if ($_SESSION['role'] != 3) {
    header("Location: /index.php");
}

$id = $_SESSION['user_id'];

if (!empty($_FILES['avatarUser']['name'])) {

    $tmp = $_FILES['avatarUser']['tmp_name'];
    $newPath = "photo/" . $_FILES['avatarUser']['name'];
    move_uploaded_file($tmp, $newPath);

    $dowloundAvatar = mysqli_query($con, "update users 
set Photo_user = '$newPath' where id_user = $id;");
}


$user = mysqli_fetch_array(mysqli_query($con, "select * from users where id_user = $id"), MYSQLI_ASSOC);

$specialists = mysqli_fetch_array(mysqli_query($con, "select id_user, users.Name, Surname, specialization.name as name_specialist , phone, img from users join specialization on users.specialization = specialization.id_specialization where status_specialist =  'в подтверждении'"), MYSQLI_ASSOC);

$service = mysqli_fetch_array(mysqli_query($con, "select COUNT(*) as count from service"));

$requests = mysqli_fetch_array(mysqli_query($con, "SELECT r.id_request, CONCAT(s.Name, ' ', s.Surname) AS specialist_full_name, CONCAT(c.Name, ' ', c.Surname, ' ', c.MiddleName) AS client_full_name,description ,status.name , r.date_request, r.type_service, c.address, name_service FROM requests r LEFT JOIN users s ON r.user_specialist = s.id_user JOIN users c ON r.user_client = c.id_user JOIN service ON r.type_service = service.id_service join status on r.status_Request = status.id_status where r.status_Request = 5 order by date_request desc limit 1"), MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/homeAdmin.css">
</head>

<body>
    <div class="home">
        <div class="homeclient">
            <div class="CancelHome">
                <a href="index.php"><img src="photo/pngegg (1) 1.png"></a>
                <p>Личный кабинет</p>
            </div>
        </div>
        <div class="profileData">
            <div class="profileBIO">
                <div class="profile">
                    <p>Профиль</p>
                </div>
                <div class="userPhoto">
                    <img class="photoUser" src="<?= $user['Photo_user'] ?>">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" id="edit" name="avatarUser" hidden>
                        <label for="edit" class="editPhoto">
                            <img id="editPhoto" src="/photo/image_arrow_up_24dp_23B33BD3_FILL0_wght400_GRAD0_opsz24.svg">
                        </label>
                    </form>
                </div>
                <div class="profilename">
                    <p>Марина Романова</p>
                </div>
            </div>
        </div>


        <div class="applicationsAndHistory">
            <div class="applications">
                <div class="applicationsH2">
                    <p>Статистика</p>
                </div>
            <p>Кол-во услуг: <?= $service['count'] ?> </p> 
            <a class="btnAdd" href="addService.php">Добавить услугу</a> 
            </div>



            <div class="applicationHistory">
                <div class="applications">
                    <div class="applicationsH2">
                        <p>Подтверждение профилей</p>
                    </div>
                    <div class="orders">
                         <div class="order">
                            <?php if (empty($specialists)) { ?>
                        
                            <p style="text-align: center;">У вас пока что нет профилей!</p>

                            <?php } else {?>
                            <div class="typeofService">
                                <p>Фамилия и имя: <span><?=$specialists['Name']." ".$specialists['Surname']?></span> </p>
                                <p>Специализация: <span><?= $specialists['name_specialist'] ?></span> </p>
                                <p>Номер телефона: <span><?= $specialists['phone'] ?></span> </p>
                                <p>Документ: <span><a href="<?= $specialists['img'] ?>" download="">Скачать файл</a></span> </p>
                            </div>
                            <div class="statusAndchange">
                                <div class="status">
                                    <a style="color: white;" href="php/acceptSpecialst.php?id=<?= $specialists['id_user'] ?>">Подтвердить</a>
                                </div>
                                <div class="status cancel">
                                    <p>Отказ</p>
                                </div>
                            </div>
                            <a href="profilesAdmin.php"><div class="Moredetails"><p>Подробнее</p></div></a>
                            <?php } ?>
                        </div> 
                        <div class="applicationsеtwo">
                        <p>Заявки</p>
                    </div>
                     <div class="order">
                            <div class="typeofService">

<?php if (empty($requests)) {?>

<p class="empty">У вас пока что нет заявок!</p>

<?php } else { ?> 

                                <p>Тип услуги: <span><?=$requests["name_service"]?></span> </p>
                                <p>Дата и время: <span><?=$requests["date_request"]?></span> </p>
                                <p>Адрес: <span><?=$requests["address"]?></span> </p>
                                <p>Комментарий: <?=$requests["description"]?></p>
                            
                            </div>
                            <a href="applications.php"><div class="Moredetails"><p>Назначить специалиста</p></div></a>
                             <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

</body>
<script>
    const edit = document.getElementById('edit');
   
      
    edit.addEventListener('change', () => {
        edit.form.submit();
    })

</script>
</html>