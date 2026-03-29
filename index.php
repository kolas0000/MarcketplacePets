<?php session_start(); 

if ($_SESSION) {
if(($_SESSION['role']) == 3){
    $urlHome = 'homeAdmini.php';
} else if (($_SESSION['role']) == 2) {
    $urlHome = '/homeSpecialist.php';
} else {
    $urlHome = 'homeClient.php';
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <div class="overlay" id="overlay"></div>
    <?php 
    if(!empty($_SESSION)){ ?>
         <div class="header">
        <div class="navigation">
            <img class="logo" src="photo/Group 2.png">
            <ul class="menu">
                <li><a href="php/logout.php">Выйти</li>
                <li><a href="#Project">О проекте</a></li>
                <li><a href="#specialist">Специалисты</a></li>
                <a href=<?= $urlHome ?> id="clickme"><li>Личный кабинет</li></a>
            </ul>

        </div>
            <div class="hero">
            <div class="reliablePartnerAndDog">
                <div class="reliablePartner">
                    <p>Ваш надежный партнёр в заботе <br>
                        о ваших любимых питомцев!</p>
                </div>
                <img class="dog" src="photo/dog.png">
            </div>
        </div>
    </div>
  <?php  } if(!isset($_SESSION["user_id"])) { ?> 
        <div class="header">
        <div class="navigation">
            <img class="logo" src="photo/Group 2.png">
            <ul class="menu">
                <li><a href="#Project">О проекте</a></li>
                <li><a href="#specialist">Специалисты</a></li>
                <li><a href="#" id="clickme">Вход в личный кабинет</a></li>
            </ul>

        </div>
            <div class="hero">
            <div class="reliablePartnerAndDog">
                <div class="reliablePartner">
                    <p>Ваш надежный партнёр в заботе <br>
                        о ваших любимых питомцев!</p>
                </div>
                <img class="dog" src="photo/dog.png">
            </div>
        </div>
    </div>
   <?php }
    ?>
    <?php if(!isset($_SESSION["user_id"])) { ?>
    <div class="center">
    <div class="Whoyou" id="Whoyou">
        
        <h2>Кто вы?</h2>
        <a href="loginCLIENT.php" id="btnClient">Клиент</a>
        <a href="loginSPECIALIST.php" id="btnSpecialist">Специалист</a>
        <a href="LoginADMIN.php" id="btnAdmin">Администратор</a>
        <a id="ExitWhoyou">Отмена</a>
    
         </div>
          </div>
  <?php } ?>
    <div class="information" id="Project">
        <div class="aboutTheProject">
            <p>О проекте</p>
        </div>
        <div class="CatAndProject">
            <div class="CatAndBlock">
                <img class="cat" src="photo/cat.png">
            </div>
            <p>Ваша надежная платформа для заботы о питомцах! Мы создали удобный и безопасный сервис для хозяев
                животных, чтобы вы могли легко найти профессиональных специалистов, готовых помочь с выгулом, уходом и
                другими важными делами, когда у вас нет возможности сделать это самостоятельно.
                Заботьтесь о своих питомцах с уверенностью — мы здесь, чтобы сделать заботу о них проще и приятнее!</p>
        </div>
    </div>

    <div class="specialists" id="specialist">
        <div class="specialistsInfo">
            <p>Специалисты</p>
        </div>
        <div class="specialistsBlock" id="specialistsBlock">
            <div class="specialistOne">
                <img src="photo/Mask group.png">
                <p>Максимова Виктория</p>
                <span>10 лет опыта работы</span>
            </div>
              <div class="specialistOne">
                <img src="photo/Mask group (1).png">
                <p>Таджикистанов Руслан</p>
                <span>7 лет опыта работы</span>
            </div>
              <div class="specialistOne">
                <img src="photo/Mask group (2).png">
                <p>Бигмаков Михаил</p>
                <span>3 года опыта работы</span>
            </div>
              <div class="specialistOne">
                <img src="photo/Mask group (3).png">
                <p>Тиунова Вилена</p>
                <span>9 лет опыта работы</span>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Свяжитесь с нами через нашу почту!</p>
        <span>BypPets@gmail.com</span>
        <p>2022 (с) — Все права защищены.</p>
    </div>
   
   
</body>
<script src="script.js"></script>

</html>
