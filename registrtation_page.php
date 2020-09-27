<?php
    include '../php/config.php';

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
        $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

        //Шифровка пароля MD5
        $password_md5 = md5($password);
    
        //Проверка на корректность введённых значений
        if(mb_strlen($name) < 2 || mb_strlen($name) > 35){
            echo "Недопустимая длина имени</br>";
            echo "<a href='registrtation_page.php'>Назад</a>";
            exit();
        }
        else if(mb_strlen($email) < 5 ){
            echo "Недопустимая длина эл. почты</br>";
            echo "<a href='registrtation_page.php'>Назад</a>";
            exit();
        } 
        else if(mb_strlen($password) < 6 ){
            echo "Недопустимая длина пароля (длина пароля должна составлять 6 символов)</br>";
            echo "<a href='registrtation_page.php'>Назад</a>";
            exit();
        }

        //Подключение к БД
        $mysql = new mysqli($host,$user,$passw,$db);

        //Проверка подключения
        if ($mysql->connect_errno) {
            printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
            exit();
        }

        //Запрос
        $mysql->query("INSERT INTO `users` (`name_user`,`email_user`,`password_user`) VALUES ('$name','$email','$password_md5')");
    
        //Закрытие соединения
        $mysql->close();

        header ("location:/static/html/registration_succes.html");
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

        <link rel="stylesheet" href="../assets/theme.min.css">

        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <title>Регистрация | LeoLogistics</title>

    </head>
    <body>
        
        <div class="main_part_enter">
            <div class="title_and_form">
                <h1><a href="../index.php">LEOLOGISTICS</a></h1>
                <h2>Регистрация</h2>
                <h3>Заполните данные о себе</h3>

                <form action="<? echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <input type="text" name="name" placeholder="Имя" maxlength="35"><br/>
                    <input type="email" name="email" placeholder="Эл. почта" maxlength="35"><br/>
                    <input type="text" name="password" placeholder="Пароль" maxlength="6"><br/>
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                    <input type="submit" value="Зарегистрироваться" name="Sign_in">
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

    </body>
</html>
