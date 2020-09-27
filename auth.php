<?php
    include 'config.php';

    $email = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

    //Шифровка пароля MD5
    $password_md5 = md5($password);

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    //Проверка подключения
    if ($mysql->connect_errno) {
        printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
        exit();
    }

    //Запрос
    $result = $mysql->query("SELECT * FROM `users` WHERE `email_user` = '$email' AND `password_user` = '$password_md5' AND `active_user` = '1'");
    
    $user = $result->fetch_assoc();

    //Проверка на существование записей
    if(count($user) == 0) {
        echo 'Пользователь с указанными данными не существует или заблокирован. Пожалуйтса, проверьте корректность введённых данных.';
        exit();
    } 

    //Установка куки
    setcookie('user', $user['name_user'], time() + 3600 * 24, "/");

    $result = $mysql->query("SELECT `id_user` FROM `users` WHERE `email_user` = '$email' AND `password_user` = '$password_md5' AND `active_user` = '1'");
    $res = $result->fetch_assoc();
    $result = $res['id_user'];

    //Закрытие соединения
    $mysql->close();

    if($result == 1)
    {        
        header ("location:/static/html/admin_panel.php");
    }
    else
    {
        header ("location:/static/html/admin_panel_1.php");
    }
?>