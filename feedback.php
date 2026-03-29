<?php
 $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'marketplace');
session_start();
$role = $_SESSION['role'];
$id = $_SESSION['user_id'];
$idRequest = $_GET['id_request'];


if ($_SESSION['role'] != 1) {
    header("Location: /index.php");
}

if ($role != 1 ){
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/feedback.css">
</head>

<body>
    <div class="home">
        <div class="homeclient">
            <div class="CancelHome">
                <a href="homeClient.php"><img src="photo/pngegg (1) 1.png"></a>
                <p>Отзыв</p>
            </div>
        </div>

        <form action="php/CreateReviews.php" method="post" class="createApplication">
            <input type="hidden" name="id_request" value="<?=$idRequest?>">
             <div class="labels">
              <label for="grade">Оценка</label>
              </div>
            <input type="number" name="grade" min="1" max="5" required>
            <div class="labels">
            <label for="comm">Описание</label>
            </div>
            <input type="text" id="comm" name="comm" required/>
             <input type="submit" value="Отправить отзыв">
        </form>
    </div>
</body>

</html>