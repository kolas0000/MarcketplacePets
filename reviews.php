<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$id = $_SESSION['user_id'];
$sort = $_GET['sort']?? false;


$role = $_SESSION['role'];

if ($_SESSION['role'] != 2) {
    header("Location: /index.php");
}

if($con){
    $reviewsAll = "select reviews.description, Photo_user, grade, reviews.id_request, data, CONCAT(c.Name, ' ', c.Surname) AS client_full_name from reviews
left join requests on reviews.id_request = requests.id_request left join users c on requests.user_client = c.id_user where user_specialist = $id";
if($sort == 'week') {
    $sevenDay = (new DateTime())->modify('-7 days')->format('Y-m-d H:i:s');
    $reviewsAll .= " AND data > '$sevenDay'";
} else if ($sort == "month") {
    $month = (new DateTime())->modify('-1 month')->format('Y-m-d H:i:s');
    $reviewsAll .= " AND data > '$month'";
}
$reviews = mysqli_fetch_all( mysqli_query($con, $reviewsAll), MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/reviews.css">
</head>

<body>
    <div class="home">
        <div class="homeclient">
            <div class="CancelHome">
                <a href="homeSpecialist.php"><img src="photo/pngegg (1) 1.png"></a>
                <p>Отзывы</p>
            </div>
        </div>

        <div id="selectRewiews" class="selectionRewiews">
            <a class="<?= $sort == 'week' ? 'Active' : '' ?>" href="/reviews.php?sort=week">Неделя</a>
            <a class="<?= $sort == 'month' ? 'Active' : '' ?>" href="/reviews.php?sort=month">Месяц</a>
            <a class="<?= $sort == false ? 'Active' : '' ?>" href="/reviews.php">Все время</a>
        </div>

        <div class="reviews">
            <?php foreach($reviews as $item) { ?>
            <div class="photoandtext">
                <img src="<?=$item['Photo_user']?>">
                <div class="NameAndComm">
                    <p><?=$item['client_full_name']?></p>
                    <p><?=$item['description']?></p>
                    <p>Номер заявки: <?=$item['id_request']?></p>
                </div>
            </div>
            <div class="starsAndDate">
                 <?php if($item['grade'] == 5 ) { ?>
                <img src="photo/Stars_5.png">
                <?php } else if ($item['grade'] == 4) { ?> 
                 <img src="photo/Stars_4.png">
                <?php } else if ($item['grade'] == 3) { ?> 
                 <img src="photo/Stars_3.png">
                <?php } else if ($item['grade'] == 2) { ?> 
                 <img src="photo/Stars_2.png">
                <?php } else if ($item['grade'] == 1) { ?> 
                 <img src="photo/Stars_1.png">
                <?php } ?>
                <p><?=date('d.m.Y', strtotime($item['data']))?></p>
            </div>
           <?php } ?> 
        </div>
    </div>
</body>
</html>