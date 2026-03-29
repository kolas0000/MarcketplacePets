<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();


$id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($_SESSION['role'] != 2) {
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



$user = mysqli_fetch_array(mysqli_query($con, "select id_user, email, specialization.Name as specializationName, Surname, MiddleName, users.name as UserName, phone, experience, id_role, status_specialist, users.specialization as experienceSpecialization,
Photo_user from users join specialization on users.specialization = specialization.Id_specialization where id_user = $id"), MYSQLI_ASSOC);

$reviews = mysqli_fetch_all(mysqli_query($con, "select * from reviews join requests on reviews.id_request = requests.id_request where user_specialist = $id"), MYSQLI_ASSOC);
if ($reviews) {
$reviewsAll = 0;
$grade = 0;
foreach($reviews as $review) {
 $reviewsAll = $reviewsAll + 1;
 $grade = $grade + $review['grade'];
} 
$grade = $grade / $reviewsAll;
} else {
    $grade = 0;
}

$newOrder = mysqli_fetch_assoc(mysqli_query($con, "select count(id_request) as total from requests where user_specialist = $id and status_Request = 5")) ;
$completedOrders = mysqli_fetch_assoc(mysqli_query($con, "select count(id_request) as total from requests where user_specialist = $id and status_Request = 4")) ;
$inWordOrders = mysqli_fetch_assoc(mysqli_query($con, "select count(id_request) as total from requests where user_specialist = $id and status_Request = 1")) ;
$canceledOrders = mysqli_fetch_assoc(mysqli_query($con, "select count(id_request) as total from requests where user_specialist = $id and status_Request = 2")) ;



if ($user['status_specialist'] == 'В подтверждении') {
 $statusUserColor = '#f59e0b';
} else if ($user['status_specialist'] == 'Отклонено') {
 $statusUserColor = '#991b1b';
} else {
    $statusUserColor = '#4ade80';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/homeSpecialist.css">
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
                <div class="profileandStatus">
                <div class="profile">
                    <p>Профиль</p>
                    <div style="background-color: <?=$statusUserColor?>" class="status">
                        <p><?=$user['status_specialist']?></p>
                    </div>
                </div>
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
                <div class="profilenameAndreview">
                <div class="profilename">
                    <p><?= $user['UserName']." ".$user['Surname'] ?></p>
                    </div>
                     <a href="/reviews.php" style="text-decoration: none;"><div class="grade">
                                    <img src="photo/pngegg 1.png">
                                    <p><?=$grade?></p>
                                </div></a>
                
                </div>
                <div class="profilephone">
                    <p>Опыт работы (в годах): <span><?=$user['experience']?></span></p>
                </div>
            </div>
        </div>
        <div class="profileData2">
            <div class="profileBIO">
                <div class="profileAddress">
                    
                    <p><?=$user['specializationName']?></p>
                </div>
            </div>
        </div>

        <div class="applicationsAndHistory">
            <div class="applications">
                <div class="applicationsH2">
                    <p>Моя статистика</p>
                </div>
                <div class="activeOrder">
                    <div class="ActiveOrderStatus">
                        <p>Активность за месяц</p>
                    </div>
                    <div class="infoOrder">
                        <a href="applicationsSpecialist.php" style="text-decoration: none;"> <div class="NewOrder">
                            <p>Новые заявки: <?=$newOrder['total']?></p>
                        </div> </a>
                       <a href="applicationsSpecialist.php" style="text-decoration: none;"> <div class="completedOrder">
                            <p>Выполнено заявок: <?=$completedOrders['total']?></p>
                        </div> </a>
                       <a href="applicationsSpecialist.php" style="text-decoration: none;">   <div class="atWorkOrder">
                            <p>В работе заявок: <?=$inWordOrders['total']?></p>
                        </div> </a>
                     <a href="applicationsSpecialist.php" style="text-decoration: none;">   <div class="canceledOrder">
                            <p>Отменено заявок: <?=$canceledOrders['total']?></p>
                        </div> </a>
                     
                    </div>
                </div>

            
            </div>


            <div class="applicationHistory">
                <div class="applications">
                    <div class="applicationsH2">
                        <p>Календарь</p>
                    </div>
                   <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FNew_York&showPrint=0&showTz=0&showCalendars=0&showTitle=0&title=%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0&mode=WEEK&src=NzZiMTljNzg3Mzk5OWUzOTI3ZGE5OWUzNjM4MTYwMzg2NGI1YzU3MGJmMjFjNjVjNTVhZDY3NWJmODQ2YjNkYkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%238e24aa" style="border-width:0" width="500" height="500" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>

</body>
<script>
    const edit = document.getElementById('edit');
    const editName = document.getElementById('editAddress');
    let addrress = document.getElementById('addreessInput');
    const FormAddress = document.getElementById('headen');
    const inputAddress = document.getElementById('InputMyAdress');

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