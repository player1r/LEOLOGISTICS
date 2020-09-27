<?php
    $send = 0;
    /*КЛЮЧИ*/
    define('SITE_KEY', '6Lf2BKkZAAAAAI7LbqpD5i1iGre51ijm9aJ-eCHK');
    define('SECRET_KEY', '6Lf2BKkZAAAAADsETWvWMHcR0R8kNfzUiVhLtHxR');

    /*ОБРАБОТКА ЗАПРОСА*/
    if($_POST){
        /*СОЗДАЕМ ФУНКЦИЮ КОТОРАЯ ДЕЛАЕТ ЗАПРОС НА GOOGLE СЕРВИС*/
        function getCaptcha($SecretKey) {
            $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
            $Return = json_decode($Response);
            return $Return;
        }
    
    /*ПРОИЗВОДИМ ЗАПРОС НА GOOGLE СЕРВИС И ЗАПИСЫВАЕМ ОТВЕТ*/
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    /*ВЫВОДИМ НА ЭКРАН ПОЛУЧЕННЫЙ ОТВЕТ*/
    // var_dump($Return);
    
    /*ЕСЛИ ЗАПРОС УДАЧНО ОТПРАВЛЕН И ЗНАЧЕНИЕ score БОЛЬШЕ 0,5 ВЫПОЛНЯЕМ КОД*/
    if($Return->success == true && $Return->score > 0.5){
        if (isset($_POST['name'])){
            $name = $_POST['name'];	
        }
        
        if (isset($_POST['email'])){
            $email = $_POST['email'];
        }
        
        if (isset($_POST['subject'])){
            $subject = $_POST['subject'];
        }

        if (isset($_POST['message'])){
            $message = $_POST['message'];
        }
        
        if (isset($name) ) {
            $name=stripslashes($name);
            $name=htmlspecialchars($name);
        }

        if (isset($email) ) {
            $email=stripslashes($email);
            $email=htmlspecialchars($email);
        }

        if (isset($subject) ) {
            $subject=stripslashes($subject);
            $subject=htmlspecialchars($subject);
        }

        if (isset($message) ) {
            $message=stripslashes($message);
            $message=htmlspecialchars($message);
        }

        $to="frolov.niki@yandex.ru";
        $text_messege="\r\n Имя :  $name\r\n Email : $email\r\n Тема : $subject\r\n Сообщение : $message";

        mail($to,"Обращение с сайта", $text_messege);
        $send = 1;
    }
    else 
    {
        $send = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="LeoLogistics">
        <meta name="yandex-verification" content="7456ff8c7bf2a5b9" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $('a[href^="#"]').on('click', function(event) {
                    event.preventDefault();
    
                    var sc = $(this).attr("href"),
                        dn = $(sc).offset().top;
                $('html, body').animate({scrollTop: dn}, 700);
                });
            });
        </script>

        

        <link rel="stylesheet" href="assets/theme.min.css">

        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <title>Главная | LeoLogistics</title>

    </head>
    <body>
        
        <!-- Header -->
        <div class="header">
            <div class="container">
                <div class="title">
                    LEOLOGISTICS
                </div>

                <div class="menu">
                    <a href="index.php">Главная</a>
                    <a href="#about">О нас</a>
                    <a href="#service">Услуги</a>
                    <a href="#contacts">Контакты</a>
                    <? if(empty($_COOKIE['user'])) 
                        {?>
                            <a class="enter" href="html/enter.html">Войти</a>
                        <?} 
                        else 
                        {?>
                            <a class="enter" href="html/admin_panel.php">Панель управления</a>
                        <?}?>
                </div>
            </div>
        </div>


        <!-- Content -->
        <div class="main_part">

            <!-- Left border -->
            <div class="border"></div>

            <!-- Center part -->
            <div class="center_part">
                <!-- Image and title -->
                <div class="image_and_title">
                    <h1>LEOLOGISTICS</h1>
                    <a href="#about">Узнать больше</a>
                </div>

                <!-- Якорь -->
                <div class="link" id="about"></div>

                <!-- About -->
                <div class="about">
                    <div class="info">
                        <h1>LEOLOGISTICS:<br class="wrap"/> КТО МЫ</h1>
                        <div class="text">За годы работы нам посчастливилось поработать с 
                            огромным числом клиентов. Качественные услуги 
                            начинаются с опытного и внимательного исполнителя, 
                            вот почему мы отбираем в свою команду только лучших. 
                            Мы эффективно выполняем проекты точно в срок и прилагаем 
                            все усилия для построения долгосрочных отношений.
                        </div>
                    </div>

                    <div class="image"></div>
                </div>

                <!-- Якорь -->
                <div class="link" id="service"></div>

                <!-- Service -->
                <div class="service">
                    <div class="title_service">
                        <h1>ПРОФЕССИОНАЛЬНЫЕ УСЛУГИ</h1>
                        <h2>Услуги для вас</h2>
                    </div>
                
                    <!-- Разделение -->
                    <div class="link"></div>

                    <div class="services">
                        <!-- 1 -->
                        <div class="item_services">
                            <div class="image_i_s_1"></div>

                            <div class="info_i_s_1">
                                <h1>УЧЁТ ТОВАРОВ</h1>
                                <h2>Профессиональный<br class="wrap"/> сервис</h2>
                            </div>
                        </div>

                        <!-- 2 -->
                        <div class="item_services">
                            <div class="image_i_s_2"></div>

                            <div class="info_i_s_2">
                                <h1>ОТСЛЕЖИВАНИЕ<br/> ДОСТАВКИ</h1>
                                <h2>Круглосуточно</h2>
                            </div>
                        </div>

                        <!-- 3 -->
                        <div class="item_services">
                            <div class="image_i_s_3"></div>

                            <div class="info_i_s_3">
                                <h1>ПЛАНИРОВАНИЕ<br/> МАРШРУТА</h1>
                                <h2>Внимание к деталям</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Якорь -->
                <div class="link" id="contacts"></div>

                <!-- Contacts -->
                <div class="contacts">
                    <div class="info_and_form">
                        <div class="info_c">
                            <h1>СВЯЖИТЕСЬ<br class="wrap"/> С НАМИ</h1>
                            <p>г. Тула, пр. Ленина, 125, к. 4</p>
                            <p>info@leologistics.com</p>
                            <p>8 (800) 888-88-88</p>
                        </div>

                        <div class="form">
                            <form action="<? echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                <div class="name_email">
                                    <input type="text" name="name" placeholder="Имя"/>
                                    <input type="email" name="email" placeholder="Эл. почта"/>
                                </div>
                                <input type="text" name="subject" placeholder="Тема"/><br/>
                                <textarea type="text" name="message" placeholder="<?if ($send == 1) {echo 'Сообщение отправлено!';} else {echo 'Текст сообщения';}?>"></textarea><br/>
                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                                <input type="submit" value="Отправить"/>
                            </form>

                            <!-- Для ReCaptcha -->
                            <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY?>"></script>
                            <script>
                                grecaptcha.ready(function() {
                                    grecaptcha.execute('<?php echo SITE_KEY;?>', {action: 'homepage'}).then(function(token) {
                                    //console.log(token);
                                    document.getElementById('g-recaptcha-response').value=token;
                                    });
                                });
                            </script>
        
                        </div>
                    </div>
                    <div class="map">
                        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A92a209a94c7775fdb72086e84d7100147e1360e15f75449f8d41d356527c18b8&amp;source=constructor" width="100%" height="100%" frameborder="0"></iframe>
                    </div>
                </div>

                <!-- Якорь -->
                <div class="link"></div>

                <!-- Footer -->
                <div class="footer">
                    <div class="icons">
                        <!-- Facebook -->
                        <a href="#">
                            <div class="facebook"></div>
                        </a>

                        <!-- Twitter -->
                        <a href="#">
                            <div class="twitter"></div>
                        </a>

                        <!-- VK -->
                        <a href="#">
                            <div class="vk"></div>
                        </a>
                    </div>
                    <div class="text_footer">
                        ©2020 LeoLogistics by Frolov
                    </div>
                </div>

                
            </div>

            <!-- Right border -->
            <div class="border"></div>

        </div>
        

    </body>
</html>
