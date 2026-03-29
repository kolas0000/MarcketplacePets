<?
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();


$id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($_SESSION['role'] != 1) {
    header("Location: /index.php");
}


if (!empty($_POST['address'])) {
    $NewAddress = $_POST['address'];
    $updateAddress = mysqli_query($con, "update users set address = '$NewAddress' where id_user = $id");
}



if (!empty($_FILES['avatarUser']['name'])) {

    $tmp = $_FILES['avatarUser']['tmp_name'];
    $newPath = "photo/" . $_FILES['avatarUser']['name'];
    move_uploaded_file($tmp, $newPath);

    $dowloundAvatar = mysqli_query($con, "update users 
set Photo_user = '$newPath' where id_user = $id;");
}



$user = mysqli_fetch_array(mysqli_query($con, "select * from users where id_user = $id"), MYSQLI_ASSOC);

$requests = mysqli_fetch_array(mysqli_query($con, "SELECT r.id_request, CONCAT(s.Name, ' ', s.Surname) AS specialist_full_name, CONCAT(c.Name, ' ', c.Surname, ' ', c.MiddleName) AS client_full_name, s.Photo_user ,status.name , reviews.grade ,r.date_request, r.type_service, c.address, name_service FROM requests r JOIN users s ON r.user_specialist = s.id_user JOIN users c ON r.user_client = c.id_user JOIN service ON r.type_service = service.id_service join status on r.status_Request = status.id_status left join reviews on r.id_request = reviews.id_request where r.user_client = $id AND r.status_Request = 3 order by r.date_request desc limit 1"), MYSQLI_ASSOC);


print_r($requests);

$limit = 3;

$requestsAll = mysqli_fetch_all(mysqli_query($con, "SELECT r.id_request, CONCAT(s.Name, ' ', s.Surname) AS specialist_full_name, CONCAT(c.Name, ' ', c.Surname, ' ', c.MiddleName) AS client_full_name, status.name , r.date_request, r.type_service, c.address, name_service FROM requests r LEFT JOIN users s ON r.user_specialist = s.id_user JOIN users c ON r.user_client = c.id_user JOIN service ON r.type_service = service.id_service join status on r.status_Request = status.id_status where user_client = $id limit $limit"), MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/home.css">
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
                    <p><?= $user['Name'] . " " . $user['Surname'] ?></p>
                </div>
                <div class="profilephone">
                    <p><?= $user['phone'] ?></p>
                </div>
            </div>
        </div>
        <div class="profileData2">
            <div class="profileBIO">
                <div class="profileAddress">
                    <img src="photo/pngegg (2) 2.png">
                    <p id="addreessInput"><?= $user['address'] ?></p>
                    <form class="headen" id="headen" action="" method="post">
                        <input type="text" id="InputMyAdress" name="address" placeholder="Введите новый адрес">
                    </form>
                </div>

                <button class="edit" id="editAddress">
                    Редактировать
                </button>
            </div>
        </div>

        <div class="applicationsAndHistory">
            <div class="applications">
                <div class="applicationsH2">

                    <p>Заявка</p>
                </div>
                <div class="activeOrder">
                    <div class="ActiveOrderStatus">
                        <?php if (!empty($requests)) { ?>
                            <p>Активная заявка</p>
                            <div class="statusOrder">
                                <?php if ($requests['name'] == "в работе") { ?>
                                    <div style="background-color: 00bfff;" class="status">
                                        <p><?= $requests['name'] ?></p>
                                    </div>
                                <?php } else if ($requests['name'] == "в подтверждение") { ?>

                                    <div style="background-color: FFA500;" class="status">
                                        <p><?= $requests['name'] ?></p>
                                    </div>
                                <?php } else if ($requests['name'] == "отменена") { ?>

                                    <div style="background-color: B22222;" class="status">
                                        <p><?= $requests['name'] ?></p>
                                    </div>
                                <?php } else if ($requests['name'] == "выполнена") { ?>

                                    <div style="background-color: 4CBB17;" class="status">
                                        <p><?= $requests['name'] ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                    </div>
                    <div class="infoOrder">
                        <img src="<?= $requests['Photo_user'] ?>">
                        <div class="all">
                            <div class="infoAboutSpecialist">
                                <p>Специалист</p>
                                <p><?= $requests['specialist_full_name'] ?></p>
                                <div class="grade">
                                    <img src="photo/pngegg 1.png">
                                    <p><?= $requests['grade']?? 0 ?></p>
                                </div>
                            </div>
                            <p><?= date('d.m.Y', strtotime($requests['date_request'])) ?>, <?= date('H:i', strtotime($requests['date_request'])) ?> </p>
                        </div>
                    </div>
                    <a class="completeOrder" href="php/completeApplication.php?id_request=<?=$requests['id_request']?>">Выполнено</a>
                </div>
            <?php } else { ?>
                <p>Активная заявка</p>
            </div>
            <img src="photo/animationDog.gif">
            <p style="text-align: center;">У вас пока нет активных заявок!<br> питомец ждет!</p>
        </div>
    <?php } ?>
    <a href="createRequest.php">Создать заявку</a>
    <div class="digitalLock">
        <div class="digitalLockText">
            <p>Ваш цифровой замок</p>
        </div>
        <div class="CodeLock">
            <p>Код: <span id="code">...</span></p>
            <div class="buttons">
                <button id="new">Обновить</button>
                <button>Скопировать</button>
            </div>
        </div>
    </div>
    </div>



    <div class="applicationHistory">
        <div class="applications">
            <div class="applicationsH2">
                <p>История заявок</p>
            </div>
            <div class="orders">
                <?php foreach ($requestsAll as $request) { ?>
                    <div class="order">
                        <div class="typeofService">
                            <p><?= $request['name_service'] ?></p>
                            <p><?= date('d.m.Y', strtotime($request['date_request']))?></p>
                        </div>
                        <div class="statusAndchange">

                            <?php if ($request['name'] == "в работе") { ?>
                                <div style="background-color: #00bfff;" class="status">
                                    <p><?= $request['name'] ?></p>
                                </div>
                            <?php } else if ($request['name'] == "в подтверждение") { ?>

                                <div style="background-color: #FFA500;" class="status">
                                    <p><?= $request['name'] ?></p>
                                </div>
                            <?php } else if ($request['name'] == "отменена") { ?>

                                <div style="background-color: #B22222;" class="status">
                                    <p><?= $request['name'] ?></p>
                                </div>
                            <?php } else if ($request['name'] == "выполнена") { ?>

                                <div style="background-color: #4CBB17;" class="status">
                                    <p><?= $request['name'] ?></p>
                                </div>
                            <?php } else { ?>
  <div style="background-color: #b27be6;" class="status">
                                    <p><?= $request['name'] ?></p>
                                </div>

                             <?php } ?>
                            <div class="status">
                                <?php if ($request['name'] == "в работе") { ?>
                                <a href="editApplication.php?id_application=<?= $request['id_request']  ?>">Отредактировать</a>
<?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <a href="/applicationsClient.php">Подробнее</a>
            </div>
        </div>
    </div>

</body>
<script>
    const edit = document.getElementById('edit');
    const editAddress = document.getElementById('editAddress');
    let addrress = document.getElementById('addreessInput');
    const FormAddress = document.getElementById('headen');
    const inputAddress = document.getElementById('InputMyAdress');
    const newCode = document.getElementById('new');
    let code = document.getElementById('code');

   newCode.addEventListener('click', () => {
    let rand = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;
    code.innerText =`${rand}`;
   })

    edit.addEventListener('change', () => {
        edit.form.submit();
    })

    editAddress.addEventListener("click", () => {
        addrress.classList.toggle("HeadenP");
        FormAddress.classList.toggle("headenActive");

    })

    inputAddress.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            inputAddress.form.submit();
        }
    })
</script>

</html>