<?php
    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    //Проверка подключения
    if ($mysql->connect_errno) {
        printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
        $mysql->close();
        exit();
    }

    $mysql->close();
?>